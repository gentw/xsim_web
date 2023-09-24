<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class National_number extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country', 'number', 'setup_fee', 'monthly_fee', 'allocated', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'allocated', 'active', 'created_at', 'updated_at'
    ];
}
