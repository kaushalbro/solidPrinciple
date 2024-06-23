Initial Package required: laravel breeze, spatie (for roles, logs, etc,)

Steps: 1): add the below code in app/Providers/AuthServiceProvider.php inside boot function at last</br>  
        Gate::before(function ($user, $ability) {</br>  
            return ($user->super_admin == 1 && $user->status == 1) ? true : null;</br>  
       });
Steps: 2): add following inside app/Kernel inside: protected $routeMiddleware = [] at last, like</br>
protected $routeMiddleware = [</br>
'...'=>'...',</br>
'...'=>'...',</br>
'...'=>'...',</br>
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,</br>
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,</br>
'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,</br>
]</br> 


Steps: 3) add trait 'HasRoles' in User Model;
