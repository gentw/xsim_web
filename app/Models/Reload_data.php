<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reload_data extends Model
{
	protected $table = 'reload_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'payment_transaction_id', 'number', 'amount', 'validity', 'transaction_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'payment_transaction_id'
    ];
}
