<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialPackage extends Model
{
    //
    protected $fillable = [
        'name', 'code', 'data', 'price','detail'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
