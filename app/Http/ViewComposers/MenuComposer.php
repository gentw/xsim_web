<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\Section;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class MenuComposer 
{
	public $menu = [];
  public $permissions = [];
  public $routeName;
  public $title = '';
	/**
     * Create a menu composer.
     *
     * @return void
     */
    public function __construct()
    {
        $roleId= 0;
        $routeName = Route::currentRouteName();
        $this->routeName = $routeName = substr($routeName, 0, strrpos($routeName, '.'));
       	$role = Role::where('route', 'like', $routeName.'%')->first();
        if($role){
          $roleId = $role->id;
          $this->title = $role->title;
        }
        
        $sections = Section::where('active', 1)->orderBy('sequence', 'asc')->with(['roles', 'roles.permissions'=>function($query){
            $query->wherePivot('admin_id', Auth::id());
        }])->get()->toArray();
        
        $perm = '';
      	foreach ($sections as $section) {
      		$temp= [];        
            if(array_has($section, 'roles')){
                $temp['name'] = $section['name'];
                $temp['image'] = $section['image'];
                $temp['roles'] = [];
                $first = true;
                foreach ($section['roles'] as $role) {
                    $li_active = '';
                    if(!empty($role['permissions'][0]['permissions'])){
                        if($role['id'] == $roleId){
                            $perm = $role['permissions'][0]['permissions'];
                        }
                        if(substr($role['route'], 0, strrpos($role['route'], '.')) == $this->routeName){
                          if($first) {
                            $first = false; 
                            $li_active = 'active';
                          }
                        }
                        
                        $temp['roles'][] = array_merge(array('class'=>$li_active), array_except($role, ['sequence' ,'active', 'created_at','updated_at', 'permissions']));
                    } 
                }
                if(count($temp['roles'])>0)
                    $this->menu[]= $temp;
            }
      	}
        if($perm!=''){
          $this->permissions = explode(',', $perm);
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      $data = [
        'menu'=> $this->menu , 
        'permissions'=>$this->permissions,
        'routeName'=>$this->routeName, 
        'title'=> $this->title,
        'mend_sign'=>'<span class="mendatory">*</span>',
      ];
      $view->with($data);
    }
}
