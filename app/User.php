<?php

namespace App;

use App\Notifications\UserResetPassword;
use App\Services\ServiceGraduation;
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function cart()
    {
        return $this->belongsToMany('App\Product', 'carts', 'user_id', 'product_id')
            ->withPivot('product_id', 'user_id', 'price', 'qty', 'id');
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

    public function databank()
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
        return $this->hasMany('App\Graduation', 'user_id');
    }

    public function active()
    {
        return $this->hasMany('App\ActiveUser', 'user_id');
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
        $items = Cart::where('user_id', $this->id)->select('price', 'qty')->get();
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
        $extrabonus = $this->extraBonus()
            ->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->sum('price');
        return $bonus + $extrabonus;
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
            ->where('level_bonus','<>', 6)
            ->sum('price');
        $extrabonus = $this->extraBonus()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->sum('price');
        return $bonus + $extrabonus;
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
        $usersNetwwork = $this->users()->pluck('id')->toArray();

        $activeUsers = \App\ActiveUser::whereIn('user_id', $usersNetwwork)
            ->whereMonth('date_active', $month)
            ->whereYear('date_active', $year)->get();
        return $activeUsers;
    }

    public function getNameGraduation()
    {
        switch ($this->getGraduation()) {
            case 1:
                $graduation = "Bronze";
                break;
            case 2:
                $graduation = "Prata";
                break;
            case 3:
                $graduation = "Ouro";

                break;
            case 4:
                $graduation = "Platina";

                break;
            case 5:
                $graduation = "Diamante";

                break;
            case 6:
                $graduation = "Mestre";

                break;
            case 7:
                $graduation = "Principe/Princesa";

                break;
            case 8:
                $graduation = "Rei/Rainha";

                break;

            default:
                $graduation = "Não Graduado";
                break;
        }
        return $graduation;
    }

    public function getGraduation(): int
    {
        $sv = new ServiceGraduation;
        $date = date('m-Y', strtotime('-1 day'));
        list($month, $year) = explode('-', $date);

        $activeUsers = $this->activeUsers($month, $year)->count();

        $bonusTotal = $this->getTotalBonus($month, $year);

        $graduation = 0;

        $isGraduated = $sv->getBronzeGraduation($activeUsers, $bonusTotal);
        if ($isGraduated) {
            $isGraduated = false;
            $graduation++;
            $isGraduated = $sv->getSilverGraduation($activeUsers, $bonusTotal);

            if ($isGraduated) {
                $isGraduated = false;
                $graduation++;
                $isGraduated = $sv->getGoldGraduation($this, $activeUsers, $bonusTotal);

                if ($isGraduated) {
                    $isGraduated = false;
                    $graduation++;
                    $isGraduated = $sv->getPlatinumGraduation($this, $activeUsers, $bonusTotal);

                    if ($isGraduated) {
                        $isGraduated = false;
                        $graduation++;
                        $isGraduated = $sv->getDiamondGraduation($this, $activeUsers, $bonusTotal);

                        if ($isGraduated) {
                            $isGraduated = false;
                            $graduation++;
                            $isGraduated = $sv->getMasterGraduation($this, $activeUsers, $bonusTotal);

                            if ($isGraduated) {
                                $isGraduated = false;
                                $graduation++;
                                $isGraduated = $sv->getEmperorGraduation($this, $activeUsers, $bonusTotal);

                                if ($isGraduated) {
                                    $isGraduated = false;
                                    $graduation++;
                                    $isGraduated = $sv->getPrinceGraduation($this, $activeUsers, $bonusTotal);

                                    if ($isGraduated) {
                                        $isGraduated = false;
                                        $graduation++;
                                        $isGraduated = $sv->getKingGraduation($this, $activeUsers, $bonusTotal);

                                        if ($isGraduated) {
                                            $isGraduated = false;
                                            $graduation++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $graduation;
    }
}
