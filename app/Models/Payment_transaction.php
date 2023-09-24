<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nonce', 'type', 'status', 'transation_id', 'amount', 'response', 'paypal_token', 'paypal_payer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
