<?php
namespace Devil\Solidprinciple\app\Http\Controllers\Admin;

use Devil\Solidprinciple\app\Http\Controllers\MakeController;
use Devil\Solidprinciple\app\Http\Controllers\MakeMigration;
use Devil\Solidprinciple\app\Http\Controllers\MakeModel;
use Devil\Solidprinciple\app\Http\Controllers\MakeModelRepo;
use Devil\Solidprinciple\app\Http\Controllers\MakeRequest;
use Devil\Solidprinciple\app\Http\Controllers\MakeView;
use Devil\Solidprinciple\app\Traits\GetPath;
use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Devil\Solidprinciple\app\Traits\MakeSidebar;
use Illuminate\Routing\Controller;

class MakeAdminPanelController extends Controller
{
    use FileFolderManage, GetStubContents, GetPath, MakeSidebar;

    protected $model_data,$stub_path,$dir_name, $model_data_path,$admin_view_path ;
    public function __construct($model_data)
    {
        $this->model_data = file_get_contents($model_data);
        $this->model_data_path= $model_data;
        $this->stub_path =__DIR__.'/../../../stubs';
        $this->dir_name=$this->path('controller');
        $this->admin_view_path = $this->path('view').'/backend/admin';
          $this->makeLayout(); //Creates all resources like: View, Repo ,Controller,Request, Model
          $this->setUpRole();
          $this->setUpUser();
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
        $admin_path = $this->admin_view_path;
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
                 $this->makeSidebar($this->model_data);
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
        $this->generate('view',["params",$this->model_data]);
        // Make Model folder and files
        $this->generate('model',$this->model_data_path);
        // Make Repository folder and files
        $this->generate('repo',$this->model_data_path);
        // Make Request folder and files
        $this->generate('request',$this->model_data_path);
        // Make Controller folder and files
        $this->generate('controller',$this->model_data_path);
        // Make Migration folder and files
        $this->generate('migration',$this->model_data_path);
    }

    public function generate($action,$data): void
    {
        if ($action == 'view'){
            new MakeView($data, $this->path('view_admin'));
        }
        if ($action == 'request'){
            new MakeRequest($data);
        }
        if ($action == 'controller'){
            new MakeController($data);
        }
        if ($action == 'model'){
            new MakeModel($data);
        }
        if ($action == 'repo'){
            new MakeModelRepo($data);
        }
        if ($action == 'migration'){
            new MakeMigration($data);
        }
    }
    public function setUpUser(){
        $include_files =['create','edit','index','script','show','form'];
        $source_path= __DIR__.'/../../../stubs/admin_view/setupEntities/user';
        $this->makeDirectory($this->admin_view_path);
        $this->makeDirectory($this->admin_view_path.'/user');
        $dest_role__view_path=$this->path('view_admin').'/user';
        $destination_request_path= $this->path('request').'/CreateUserRequest.php';
        $destination_controller_path= $this->path('controller').'/UserController.php';
        $destination_model_path= $this->path('model').'/User.php';
        $this->makeFile($destination_model_path, $this->getStubContents($source_path.'/Model.stub',[]));
        $this->makeFile($destination_request_path, $this->getStubContents($source_path.'/Request.stub',[]));
        $this->makeFile($destination_controller_path, $this->getStubContents($source_path.'/Controller.stub',[]));
        foreach ($include_files as $file) {
             if ($file == 'form') {
                $this->makeDirectory($dest_role__view_path . '/partial');
                $this->makeFile($dest_role__view_path . '/partial/form.blade.php', $this->getStubContents($source_path . '/partial/form.blade.php', []));
            } else {
                $this->makeFile($dest_role__view_path . '/' . $file . '.blade.php', $this->getStubContents($source_path . '/' . $file . '.blade.php', []));
            }
        }
        }
    public function setUpRole()
    {
        $include_files =['create','edit','index','Controller','script','show','form'];
        $source_path= __DIR__.'/../../../stubs/admin_view/setupEntities/role';
        $this->makeDirectory($this->admin_view_path);
        $this->makeDirectory($this->admin_view_path.'/role');
        $dest_role__view_path=$this->path('view_admin').'/role';
        $destination_model_path= $this->path('model').'/Role.php';
        $destination_repo_path= $this->path('repository').'/RoleRepository.php';
        $this->makeFile($destination_model_path, $this->getStubContents($source_path.'/Model.stub',[]));
        $this->makeFile($destination_repo_path, $this->getStubContents($source_path.'/Repository.stub',[]));
        foreach ($include_files as $file){
            $controller__source_path=$source_path.'/Controller.stub';
            $destination_controller_path= $this->path('controller').'/RoleController.php';
            if ($file == 'Controller'){
                $this->makeFile($destination_controller_path, $this->getStubContents($controller__source_path,[]));
            }
            else if($file =='form'){
                $this->makeDirectory($dest_role__view_path.'/partial');
                $this->makeFile($dest_role__view_path.'/partial/form.blade.php', $this->getStubContents($source_path.'/partial/form.blade.php',[]));
            }else{
                $this->makeFile($dest_role__view_path.'/'.$file.'.blade.php', $this->getStubContents($source_path.'/'.$file.'.blade.php',[]));
            }

        }
    }
}
