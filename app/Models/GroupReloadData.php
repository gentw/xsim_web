<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupReloadData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'payment_transaction_id', 'group_id', 'group_name', 'amount', 'transaction_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
