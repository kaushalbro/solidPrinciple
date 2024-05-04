<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class MakeModel extends Controller
{
    use FileFolderManage,GetStubContents;
    protected $model_data,$stub_path,$dir_name,$model_data_path;
    public function __construct($model_data_path)
    {
        $this->model_data = file_get_contents($model_data_path);
        $this->model_data_path = $model_data_path;
        $this->stub_path =__DIR__.'/../../stubs/model.stub';
        $this->dir_name='Models';
        $this->make();
    }

    public function make(): void
    {
        $json_model_details= $this->model_data;
       $model_data  = json_decode($json_model_details);
      foreach ($model_data as $key => $model){
          $fillable = $this->removeDoubleQuote($model->fillable);
          $hidden = $this->removeDoubleQuote($model->hidden ?? []);
          $casts = $this->removeDoubleQuote($model->casts ?? []);
          $with = $this->removeDoubleQuote($model->with ?? []);
          $contents =$this->getStubContents($this->stub_path,[
            'namespace' => 'App\\'.$this->dir_name,
            'classname'=> $model->model_name,
            'table_name'=> $model->table_name??strtolower(Str::plural($model->model_name)),
            'fillable'=>$fillable,
            'hidden'=>$hidden,
            'casts'=>$casts,
            'with'=>$with
          ]);
        $this->makeFile('app/'.$this->dir_name.'/'.$model->model_name.'.php', $contents);
      }
//      new MakeController(['Admin'], 'Admin');
    }
}
