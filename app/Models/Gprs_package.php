<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gprs_package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'zone_id', 'code', 'duration', 'data', 'price'
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
