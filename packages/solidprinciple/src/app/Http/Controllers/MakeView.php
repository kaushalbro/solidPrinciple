<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;
use function PHPUnit\Framework\fileExists;

class MakeView extends Controller
{
    use FileFolderManage, GetStubContents;

    protected $model_data,$stub_path,$controller_name, $view_path;
    public function __construct($model_data, $view_path)
    {
        $this->model_data = json_decode($model_data);
        $this->view_path = $view_path;
        $this->stub_path =__DIR__.'/../../../stubs/view.stub';
        $this->make();
    }

    public function make(): void
    {
        $model_data  = $this->model_data;
        $view_path = $this->view_path."/";
        foreach ($model_data as $key => $model){
            $model_name = $model->model_name;
            $view_folder_path = $view_path.strtolower($model_name);
            $partial_folder_path = $view_folder_path."/partial";
            $file_path =base_path($view_folder_path);
            $this->makeDirectory($view_folder_path);
            $this->makeDirectory($partial_folder_path);
            $this->makeFile($partial_folder_path."/form.blade.php", []);
            $files=['create','edit','index','show','script'];
            foreach ($files as $file){
                $file_name=$view_folder_path."/".$file.".blade.php";
                if ($file == 'create' ||$file == 'edit'){
                    $model_view_stub= __DIR__.'/../../stubs/admin_view/model_views/'.$file.'.stub';
                    $method= ($file == 'create')?'POST':"PUT" ;
                    $contents =$this->getStubContents($model_view_stub,[
                        'classname'=> ucwords($model_name),
                        'action'=>$file,
                        'routeprefix'=>strtolower($model_name),
                        'method'=> $method,
                    ]);
                    $this->makeFile($file_name,$contents);
                }else{
                    $this->makeFile($file_name,[]);
                }
            }

//            $this->makeFile($this->dir_name.'/'.ucwords($model->model_name).'Controller.php', $contents);
        }

    }
}
