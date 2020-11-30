<?php

namespace App;

use App\ActiveUser;
use App\Cart;
use App\Notifications\UserResetPassword;
use App\Services\GraduationService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'rg',
        'cellphone',
        'phone',
        'user_id',
        'status',
        'avatar',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'graduation_name',
        'links',
    ];

    protected $graduationService;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->graduationService = new GraduationService();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function cart()
    {
        return $this->belongsToMany('App\Product', 'carts', 'user_id', 'product_id')
            ->withPivot('product_id', 'user_id', 'price', 'qty', 'id');
    }

    public function pixKeys()
    {
        return $this->hasMany('App\Models\PixKey', 'user_id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'user_id');
    }

    public function dataBank()
    {
        return $this->hasOne('App\Databank', 'user_id');
    }

    public function bonus()
    {
        return $this->hasMany('App\Bonus', 'user_id');
    }
    public function extraBonus()
    {
        return $this->hasMany('App\ExtraBonus', 'user_id');
    }

    public function commission()
    {
        return $this->hasMany('App\OrderCommission', 'user_id');
    }

    public function graduation()
    {
        return $this->hasOne('App\Graduation', 'user_id');
    }

    public function active()
    {
        return $this->hasMany('App\ActiveUser', 'user_id');
    }

    public function getGraduationNameAttribute()
    {
        $graduations = [
            '1' => "Bronze",
            '2' => "Prata",
            '3' => "Ouro",
            '4' => "Platina",
            '5' => "Diamante",
            '6' => "Mestre",
            '7' => "Principe/Princesa",
            '8' => "Rei/Rainha",
        ];
        $g = $this->graduationService->getGraduation($this);
        return array_key_exists($g, $graduations) ? $graduations[$g] : "Não graduado";
    }

    public function status()
    {
        $status = $this->status == 0 ? 'Desativado' : 'Ativado';
        return $status;
    }

    public function getTotalPlatinumGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 4)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 4)->count();
        }
        return $graduated;
    }

    public function getTotalDiamondGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 5)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 5)->count();
        }
        return $graduated;
    }

    public function getTotalMasterGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 6)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 6)->count();
        }
        return $graduated;
    }

    public function getTotalEmperorGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 7)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 7)->count();
        }
        return $graduated;
    }

    public function getTotalPrinceGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 8)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 8)->count();
        }
        return $graduated;
    }

    public function getTotalKingGraduation($year_init = null, $year_final = null)
    {
        if ($year_init != null && $year_final != null) {
            $graduated = $this->graduation()->where('max_graduation', 9)
                ->whereYear('updated_at', '>=', $year_init)
                ->whereYear('updated_at', '<=', $year_final)->count();
        } else {
            $graduated = $this->graduation()->where('max_graduation', 9)->count();
        }
        return $graduated;
    }

    public function getActive($month, $year): bool
    {
        if ($this->status == 1) {
            return true;
        }
        $active = $this->active()->whereMonth('date_active', $month)->whereYear('date_active', $year)->first();
        return $active == null ? false : true;
    }

    public function total()
    {
        $items = Cart::where('user_id', $this->id)
            ->select('price', 'qty')
            ->get();
        $total = 0;
        foreach ($items as $item) {
            $subtotal = $item->price * $item->qty;
            $total += $subtotal;
        }
        return $total;
    }

    public function getTotalMonth()
    {
        $total = 0;
        $date = date('m-Y');

        list($month, $year) = explode('-', $date);
        $totalOrders = $this->orders()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)->sum('subtotal');
        return $totalOrders;
    }

    public function getCommission($month, $year)
    {
        $totalCommission = 0;
        foreach ($this->commission()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->get() as $commission) {
            $orderTotal = ($commission->commission_percentage / 100) * $commission->order->subtotal;
            $totalCommission += $orderTotal;
        }
        return $totalCommission;
    }

    public function getBonus($month, $year)
    {
        $bonus = $this->bonus()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->sum('price');

        $extraBonus = $this->extraBonus()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->sum('price');
        return $bonus + $extraBonus;
    }
    public function getBonusIndication($month, $year)
    {
        return $bonus = $this->bonus()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->where('level_bonus', 6)
            ->sum('price');
    }
    public function getBonusNotIndication($month, $year)
    {
        $bonus = $this->bonus()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->where('level_bonus', '<>', 6)
            ->sum('price');
        $extraBonus = $this->extraBonus()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->sum('price');
        return $bonus + $extraBonus;
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getTotalBonus($month, $year)
    {
        $totalBonus = $this->getCommission($month, $year) + $this->getBonus($month, $year);
        return $totalBonus;
    }


    public function activeUsers($month, $year)
    {
        $usersNetwork = $this->users()->pluck('id')->toArray();

        $activeUsers = \App\ActiveUser::whereIn('user_id', $usersNetwork)
            ->whereMonth('date_active', $month)
            ->whereYear('date_active', $year)->get();
        return $activeUsers;
    }

    public function getMaxGraduation(): int
    {
        if ($this->graduation) {
            return $this->graduation->max_graduation;
        }
        return $this->graduationService->getGraduation($this);
    }
    public function getGraduation(): int
    {
        return $this->graduationService->getGraduation($this);
    }

    public function getLinksAttribute()
    {
        $pix = $this->pixKeys()->first() ? $this->pixKeys()->first() : new \App\Models\PixKey();
        return [
            'pix' => $pix
        ];
    }
}
