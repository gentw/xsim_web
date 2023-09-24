<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Role;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    /**
     * Scope a query to only include active clients.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 'y');
    }

    public function hasPermission($routeName, $permission){
        $isPermitted = Role::where('route', 'like', $routeName.'%')->whereHas('permissions', function($query) use ($permission){
            $query->where('admin_id', Auth::id())->whereRaw('find_in_set("'.$permission.'", permissions)');
        })->first();
        if(!$isPermitted){
            return false;
        }
        else {
            return true;
        }   
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role')->withPivot('permissions');
    }
}
