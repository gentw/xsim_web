<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWidgets extends Model
{
	protected $table = 'user_widgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'dashboard', 'type', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    
}
