<?php

namespace App;

use App\Notifications\UserResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
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

    public function status()
    {
        $status = $this->status == 0 ? 'Desativado' : 'Ativado';
        return $status;
    }

    public function commission()
    {
        return $this->hasMany('App\OrderCommission', 'user_id');
    }

    public function graduation()
    {
        return $this->hasOne('App\Graduation', 'user_id');
    }

    public function total()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $subtotal = $item->price * $item->pivot->qty;
            $total += $subtotal;
        }
        return $total;
    }

    public function getCommission($month, $year)
    {
        $totalCommission = 0;
        foreach ($this->commission()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->get() as $commission) {
            $orderTotal = ($commission->commission_percentage/100) * $commission->order->total;
            $totalCommission += $orderTotal;
        }
        return $totalCommission;
    }

    public function getBonus($month, $year)
    {
        $bonus = $this->bonus()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->sum('price');
        return $bonus;
    }

    public function getGraduation()
    {
        $activeUsers = $this->users()->where('status', 1)->count();
        $month = date('m');
        $year = date('Y');
        $commission = $this->getCommission($month, $year);
        $graduation = 'no-graduated.png';
        if($commission >= 27 && $activeUsers >= 3){
            $graduation = 'bronze.png';
        }
        if($commission >= 141 && $activeUsers >= 3){
            $graduation = 'prata.png';
        }
        if($commission >= 1250 && $activeUsers >= 3){
            $graduation = 'ouro.png';
        }
        
        return $graduation;
    }

    public function typeOfGraduation($graduation)
    {
        $typeGraduation = 0;
        if($graduation == 'bronze.png'){
            $typeGraduation = 1;
        }elseif($graduation == 'prata.png'){
            $typeGraduation = 2;
        }elseif($graduation == 'ouro.png'){
            $typeGraduation = 3;
        }

        return $typeGraduation;
    }
}
