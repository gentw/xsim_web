<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->username;
    }

    /**
     * Get the notification routing information for the given driver mail.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function routeNotificationForMail()
    {
        if ($email = request()->input('email')) {
            return $email;
        }

        return $this->username;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'title', 'name', 'surname', 'email', 'password', 'dob', 'phone', 'mobile', 'company', 'location', 'address', 'country', 'city', 'zip_code', 'currency', 'document', 'document_no', 'profile_image', 'active'
        'key_user_sex', 'key_language', 'username', 'password', 'birthsdate', 'key_user_status', 'remember_token', 'activation_code', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'active', 'created_at', 'updated_at', 'user_type'
    ];

    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthsdate'])->age;
    }

    // public function hasPermission($routeName, $permission){
    //     $isPermitted = Role::where('route', 'like', $routeName.'%')->whereHas('permissions', function($query) use ($permission){
    //         $query->where('user_id', Auth::id())->whereRaw('find_in_set("'.$permission.'", permissions)');
    //     })->first();
    //     if(!$isPermitted){
    //         return false;
    //     }
    //     else {
    //         return true;
    //     }
        
    // }

    // public function roles(){
    //     return $this->belongsToMany('App\Models\Role')->withPivot('permissions');
    // }

    public function cards(){
        return $this->hasMany('App\Models\Card', 'user_id')->where('active', 1);
    }

    public function referrals(){
        return  $this->hasMany('App\Models\Referral', 'user_id');
    }

    public function contact(){
        return  $this->hasOne('App\Models\Contact', 'key_user');
    }

    public function groups(){
        return $this->hasMany('App\Models\Group', 'user_id')->where('active', 1);
    }

    public function widgets(){
        return $this->hasMany('App\Models\UserWidgets', 'user_id');
    }
}
