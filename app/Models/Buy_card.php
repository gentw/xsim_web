<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buy_card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'qty_regular', 'qty_32', 'qty_50', 'status', 'payment_transaction_id', 'transaction_id', 'order_number','coupon_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id_user');
    }
    public function coupon(){
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }
}
