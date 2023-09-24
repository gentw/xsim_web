<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        $method = substr($routeName, strrpos($routeName, '.') + 1);
        $routeName = substr($routeName, 0, strrpos($routeName, '.'));
        $method = ($method != '' ? $method : $routeName);
        $permission = '';

        $access = ['index', 'listing', 'showSetting', 'card_listing'];
        $add = ['store', 'create', 'import', 'add_balance', 'add_number', 'card_add'];
        $update = ['edit', 'update', 'changesetting', 'add_card_balance', 'add_extra_number', 'add_user_card', 'change_validity', 'update_validity'];
        $view = ['show', 'cards'];
        $delete = ['destroy', 'remove_number','remove_card','remove_number_list'];

        if (in_array($method, $add)) {
            $permission = 'add';
        } elseif (in_array($method, $update)) {
            $permission = 'edit';
        } elseif (in_array($method, $view)) {
            $permission ='view';
        } elseif (in_array($method, $delete)) {
            $permission = 'delete';
        } elseif (in_array($method, $access)) {
            $permission = 'access';
        }

        if ($permission == '' || !$request->user()->hasPermission($routeName, $permission)) {
            return redirect('admin/home');
        }

        $role = Role::where('route', 'like', $routeName.'%')->first();
        $permissions =$role->permissions()->wherePivot('admin_id', Auth::id())->get();

        $request->permissions = [];
        if (!empty($permissions[0]['permissions'])) {
            $request->permissions = $permissions[0]['permissions'];
        }

        return $next($request);
    }
}
