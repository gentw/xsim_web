<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $table = 'card_types';

    protected $fillable = [
        'type_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function coupons(){
    	return $this->hasMany('App\Models\Coupon')->orderBy('sequence', 'asc');
    }
}