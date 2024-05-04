<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeModelRepo extends Controller
{
    use FileFolderManage, GetStubContents;

    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data_path)
    {
        $data =is_array($model_data_path)?$model_data_path[1]:file_get_contents($model_data_path);
        $this->model_data =$data;
        $this->stub_path =__DIR__.'/../../stubs/model-repo.stub';
        $this->dir_name='Repositories';
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory('app/' . $this->dir_name);
        $model_data = json_decode($this->model_data);
        foreach ($model_data as $key => $model) {
            $model_name = $model->model_name;
            $fillable = $this->removeDoubleQuote($model->fillable);
            $contents = $this->getStubContents($this->stub_path, [
                'namespace' => 'App\\'. $this->dir_name,
                'rootNamespace' => 'App\\',
                'classname' => ucwords($model_name),
                'reponame' => strtolower($model_name),
                'baseRepository'=>config('solid.base_repository_name'),
                'fillable' => $fillable
            ]);
            $this->makeFile('app/' . $this->dir_name . '/' . $model_name . 'Repository.php', $contents);
        }
    }

}
