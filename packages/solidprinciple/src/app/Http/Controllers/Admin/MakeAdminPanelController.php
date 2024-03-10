<?php
namespace Devil\Solidprinciple\app\Http\Controllers\Admin;

use Devil\Solidprinciple\app\Traits\GetPath;
use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;
use ZipArchive;

class MakeAdminPanelController extends Controller
{
    use FileFolderManage, GetStubContents, GetPath;

    protected $model_data,$stub_path,$dir_name,$admin_resources_path ;
    public function __construct($model_data)
    {
        $this->model_data = $model_data;
        $this->stub_path =__DIR__.'/../../../stubs';
        $this->admin_resources_path=__DIR__.'/../../../stubs';
        $this->dir_name=$this->path('controller');
        $this->makeLayout();
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
        $include_files =['header','footer','breadcum','scripts','navbar','sidebar'];
        foreach ($include_files as $file){
            $dest_path= $admin_path.'/includes/';
            $include_sub_path= $this->stub_path.'/admin_view/common/'.$file.'.stub';
            $file_name=$dest_path.$file.'.blade.php';
            $variable = [];
            if ($file=="sidebar"){
                $variable = $this->sideBarLinks($this->model_data);
            }
            $this->makeFile($file_name, $this->getStubContents($include_sub_path,$variable));
        }
        $source_path= $this->admin_resources_path.'/admin_resources.zip';
        $destination_path= base_path('public').'/admin_resources.zip';
        if ($this->copy($source_path,$destination_path)){
            $zip = new ZipArchive();
            if ($zip->open($destination_path) === true) {
                $zip->extractTo(base_path('public'));
                $zip->close();
                unlink($destination_path);
                fopen($destination_path, 'wb');
                error_log(sprintf("\033[32m%s\033[0m",'File Unzipped successfully.'));
            } else {
                error_log(sprintf("\033[31m%s\033[0m", ' Failed to Unzip file.'));
            }
        }
    }
    public function sideBarLinks($data):void{
        $model_data  = json_decode($data);
        dd($model_data);
        foreach ($model_data as $model){
            dd($model);
        }
        $model_icon = "fa-brands fa-product-hunt";
        $model_sub_icon ="fa-brands fa-product-hunt";
            $link_templet=' <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="{{model_icon}}"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="/" class="nav-link">
                                <i class="fa-solid fa-plus mr-2"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link">
                                <i class="fa-solid fa-list mr-2"></i>
                                <p>Lists Products</p>
                            </a>
                        </li>
                    </ul>
                </li>';
            dd(str_replace("{{model_icon}}",$model_icon, $link_templet ));
    }
}
