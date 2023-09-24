<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'user_contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key_user', 'key_user_contact_type', 'business_name', 'business_registration_number', 'kmkr', 'url', 'title', 'firstname', 'lastname', 'key_country', 'state', 'city', 'zip', 'address', 'mobile', 'phone', 'fax', 'email', 'details', 'currency', 'document', 'document_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'url', 'kmkr', 'business_registration_number', 'key_user_contact_type', 'id_user_contact', 'fax', 'state', 'details', 'creation_date', 'key_country'
    ];

    public function country(){
        return  $this->belongsTo('App\Models\Country', 'key_country');
    }
}
