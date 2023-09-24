<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'card_number', 'verification_code', 'card_balance', 'corp_maxlimit', 'corp_minlimit', 'corp_transaction', 'corp_enabled', 'group_id', 'active', 'card_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'verification_code', 'active', 'created_at', 'updated_at'
    ];

    /**
     * Scope a query to only include active clients.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id_user');
    }  

    public function group(){
        return $this->belongsTo('App\Models\Group', 'group_id');
    }
}
