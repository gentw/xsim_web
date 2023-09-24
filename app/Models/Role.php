<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id', 'title', 'route', 'image', 'sequence', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function section(){
        return $this->belongsTo('App\Models\Section');
    }

    public function permissions(){
        return $this->belongsToMany('App\Admin')->select('permissions');
    }
}
