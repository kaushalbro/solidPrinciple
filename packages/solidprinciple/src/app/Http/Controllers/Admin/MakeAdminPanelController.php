<?php
namespace Devil\Solidprinciple\app\Http\Controllers\Admin;

use Devil\Solidprinciple\app\Http\Controllers\MakeView;
use Devil\Solidprinciple\app\Traits\GetPath;
use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class MakeAdminPanelController extends Controller
{
    use FileFolderManage, GetStubContents, GetPath;

    protected $model_data,$stub_path,$dir_name ;
    public function __construct($model_data)
    {
        $default_path=['model_path','controller_path','repo_path','frontend_view_path','backend_view_path'];
        $config_stub = __DIR__."/../../../stubs/config.stub";
        $config_contents =$this->getStubContents($config_stub);
        $this->makeFile("config/solid.php",$config_contents);
        $this->model_data = file_get_contents($model_data);
        $this->stub_path =__DIR__.'/../../../stubs';
        $this->dir_name=$this->path('controller');
//        $this->makeLayout()
        $this->makeUserAndRoleControllerRepoViews();

    }
    public function make(): void
    {
        $model_data  = json_decode($this->model_data);
        foreach ($model_data as $key => $model){
            $model_name = $model->model_name;
            $contents =$this->getStubContents($this->stub_path,[
                'namespace' => 'App\\Http\\Controllers',
                'rootNamespace'=>'App\\',
                'classname'=> ucwords($model_name),
                'reponame'=> strtolower($model_name)
            ]);
            $this->makeFile($this->dir_name.'/'.ucwords($model->model_name).'Controller.php', $contents);
        }
    }
    public function makeLayout(){
        $admin_path = $this->path('view').'/backend/admin';
        $this->makeDirectory($admin_path);
        $this->makeDirectory($admin_path.'/includes');
        $master_sub_path= $this->stub_path.'/admin_view/master.stub';
        $master_contents =$this->getStubContents($master_sub_path);
        $dashboard_sub_path= $this->stub_path.'/admin_view/dashboard.stub';
        $dashboard_contents =$this->getStubContents($dashboard_sub_path);
        $this->makeFile($this->path('view').'/backend/master.blade.php', $master_contents);
        $this->makeFile($this->path('view').'/backend/admin/dashboard.blade.php', $dashboard_contents);
        $include_files =['header','footer','breadcum','scripts','navbar','sidebar','form_footer'];
        foreach ($include_files as $file){
            $dest_path= $admin_path.'/includes/';
            $include_sub_path= $this->stub_path.'/admin_view/common/'.$file.'.stub';
            $file_name=$dest_path.$file.'.blade.php';
            if ($file=="sidebar"){
                 $this->sideBarLinks($this->model_data);
                 $this->makeFile($file_name, $this->getStubContents($include_sub_path,[]));
            }else{
                $this->makeFile($file_name, $this->getStubContents($include_sub_path,[]));
            }
        }
        $source_path= $this->stub_path.'/admin_resources.zip';
        $destination_path= base_path('public').'/admin_resources.zip';
        if ($this->copy($source_path, $destination_path) && $this->unzip($source_path, $destination_path, base_path('public'))) {
            unlink($destination_path);
            fopen($destination_path, 'wb');
        }
        // make view folder and files
            $this->makeView($this->model_data);
    }
    public function sideBarLinks($data)
    {
        $model_data  = json_decode($data);
        $sidebar_config_sub_path= $this->stub_path.'/admin_view/sidebar_config.stub';
        $side_bar_content=[];
        foreach ($model_data as $model){
            $side_bar = $model->sidebar[0];
            $model_name = ucfirst($model->model_name);
            $table_name = $model->table_name;
            $route =strtolower(Str::plural($model->routes[0]));
            $icon=  explode('|', $model->sidebar[1])[1];
            $sub_links = explode(',',explode('=', $model->sidebar[2])[1]);
            if ($side_bar){
                $side_bar_content += [
                    $model_name=>[
                        'icon'=>$icon,
                        'route'=>"",
                        'title'=>$model_name,
                        'class'=>'',
                        'visibility'=>true,
                        'permission'=>'',
                        "sub_link"=>[]
                    ],
                ];
                if (count($sub_links)>0)
                {
                    foreach ($sub_links as $sub_link){
                        $sub_route = "";
                        $sub_icon="";
                        $title= "";
                        if ($sub_link == 'create'){
                            $sub_icon = "fa-solid fa-plus";
                            $sub_route = "/admin/".$route.'/create';
                            $title= "Add ".$model_name;

                        }elseif($sub_link == 'index'){
                            $sub_icon = "fa-solid fa-list";
                            $sub_route = "/admin/".$route;
                            $title= "List ".ucfirst($route);
                        }
                            $side_bar_content[$model_name]['sub_link']+=[
                                    $sub_link=>[
                                        'icon'=>$sub_icon,
                                        'route'=>$sub_route,
                                        'title'=>$title,
                                        'visibility'=>true,
                                        'permission'=>''

                                    ]
                            ];
                    }
                }
            }
        }
        $side_bar_content = str_replace(array("array (", ")"), array("[", "]"), var_export($side_bar_content, true));
        $sidebar_stub_content =$this->getStubContents($sidebar_config_sub_path,
            [
                'sidebar'=> $side_bar_content,
            ]);
        $this->makeFile($this->path('config').'/sidebar.php', $sidebar_stub_content);
    }

    public function makeView($data): void
    {
        new MakeView($data, "resources/views/backend/admin");
    }

    public function makeUserAndRoleControllerRepoViews(){
    $user_data = '{
    "model_name": "User",
    "table_name": "users",
    "fillable": ["name", "email","password"],
    "hidden": [],
    "casts": [],
    "with": []
    }';
     dd(json_decode($user_data));
    }
}
