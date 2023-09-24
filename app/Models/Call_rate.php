<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call_rate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carrier', 'country', 'operator', 'network_type', 'network', 'abbreviation', 'code', 'link_1', 'link_2', 'link_3', 'gprs', 'net_3g', 'preferred', 'active', 'sms_in_rate', 'sms_out_rate', 'xxsim_sms_rate', 'zone', 'zone_rate', 'gprs_rate', 'call_in_rate', 'call_out_rate', 'extra_rate', 'xxsim_call_rate', 'call_xxsim_to_xxsim', 'sms_xxsim_to_xxsim', 'comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
