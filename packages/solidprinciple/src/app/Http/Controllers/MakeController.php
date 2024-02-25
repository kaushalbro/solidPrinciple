<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeController extends Controller
{
    use FileFolderManage, GetStubContents;

    protected $model_data,$stub_path,$dir_name,$controller_name,$folder;
    public function __construct($model_data, $folder=null)
    {
        if (is_array($model_data)){
          $this->controller_name = $model_data[0];
        }else{
            $this->model_data = $model_data;
        }
        $this->folder = $folder;
        $this->stub_path = $folder=='Admin'?(__DIR__.'/../../stubs/admincontroller.stub'):(__DIR__.'/../../stubs/controller.stub');;
        $this->dir_name=$folder?('app/Http/Controllers/'.$folder):'app/Http/Controllers';
        $this->make();
    }

    public function make(): void
    {
//        dd($this->dir_name);
        $this->makeDirectory($this->dir_name);
        if ($this->model_data){
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
        }else{
            $contents =$this->getStubContents($this->stub_path,[
                'namespace' =>$this->folder?('App\\Http\\Controllers\\'.$this->folder):'App\\Http\\Controllers',
                'rootNamespace'=>'App\\',
                'classname'=> ucwords($this->controller_name),
                'reponame'=> ''
            ]);
            $this->makeFile($this->dir_name.'/'.ucwords($this->controller_name).'Controller.php', $contents);
        }

    }
}
