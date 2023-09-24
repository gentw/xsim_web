<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temp_payment_data extends Model
{
	protected $table = "Temp_payment_data";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'data',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
