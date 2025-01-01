<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Http\Controllers\BaseController;
use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;

class MakeApiResources extends BaseController
{
    use FileFolderManage, GetStubContents;

    protected
        $model_data,
        $stub_path,
        $dir_name='app/Http/Resources',
        $resource_name,
        $folder,
        $namespace= 'App\\Http\\Resources',
        $rootNameSpace='App\\',
        $actionsResourceToGenerate=  ['List','Create','Show','Edit'];
    public function __construct($model_data_or_path, $folder=null)
    {
        parent::__construct();
        if (is_array($model_data_or_path) && ($model_data_or_path[0] != 'from_param')){
          $this->resource_name = $model_data_or_path[0];
        } else {
            $data =is_array($model_data_or_path)?$model_data_or_path[1]:file_get_contents($model_data_or_path);
            $this->model_data =$data;
        }
        $this->folder = $folder;
        $this->stub_path = __DIR__.'/../../stubs/api_resources.stub';;
        $this->dir_name=$folder?($this->dir_name.'/'.$folder):$this->dir_name;
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory($this->dir_name);
        if ($this->model_data){
            $model_data  = json_decode($this->model_data);
            foreach ($model_data as $key => $model){
                $model_name = $model->model_name;
                foreach ($this->actionsResourceToGenerate as $action){
                    $contents =$this->getStubContents($this->stub_path,[
                        'namespace' => $this->namespace.'\\'.ucwords($model->model_name),
                        'rootNamespace'=>$this->rootNameSpace,
                        'classname'=> ucwords($model_name),
                        'ResourcesName'=>ucwords($model->model_name).$action,
                        'data'=>'',
                        'stub_conditions'=>[
                            'is_api'=>$this->is_api,
                            'repo_pattern'=>$this->repo_pattern,
                            'laravel_11'=>$this->laravel_11,
                            'laravel_10'=>$this->laravel_10,
                            'is_api_without_api_with_resource_classes'=>$this->is_api_without_api_with_resource_classes,
                        ],
                    ]);
                    $this->makeDirectory($this->dir_name.'/'.ucwords($model->model_name));
                    $this->makeFile($this->dir_name.'/'.ucwords($model->model_name).'/'.ucwords($model->model_name).$action.'Resource.php', $contents);
                };
            }
        }else{
            foreach ($this->actionsResourceToGenerate as $action){
                $contents =$this->getStubContents($this->stub_path,[
                    'namespace' =>$this->folder?($this->namespace.'\\'.$this->folder):$this->namespace,
                    'rootNamespace'=>$this->rootNameSpace,
                    'classname'=> ucwords($this->resource_name),
                    'viewfolder'=>strtolower($this->resource_name),
                    'reponame'=> '',
                    'stub_conditions'=>['is_api'=>$this->is_api, 'repo_pattern'=>$this->repo_pattern]
                ]);
              $this->makeFile($this->dir_name.'/'.ucwords($this->resource_name).$action.'Resource.php', $contents);
//                $this->makeFile($this->dir_name.'/'.ucwords($this->resource_name).'Controller.php', $contents);
            };


        }
    }
}
