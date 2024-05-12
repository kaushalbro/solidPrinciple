<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class MakeLayout extends Controller
{ use FileFolderManage,GetStubContents;

    protected $model_data,$stub_path,$model_data_path,$layout_type;

    public function __construct($layout_type, $model_data_path=null)
    {
        $data =!$model_data_path?"":(is_array($model_data_path)?$model_data_path[1]:file_get_contents($model_data_path));
        $this->model_data = $data;
        $this->layout_type = $layout_type;
        $this->model_data_path = $model_data_path??"";
        $this->stub_path =__DIR__.'/../../stubs/model.stub';
        $this->make();
    }

    public function make(): void
    {
            dd();
    }
}
