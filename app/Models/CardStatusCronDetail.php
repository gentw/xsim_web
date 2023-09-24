<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardStatusCronDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date', 'limit', 'offset', 'status', 'end_date', 'cron_status'
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
