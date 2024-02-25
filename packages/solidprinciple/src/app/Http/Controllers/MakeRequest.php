<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeRequest extends Controller
{
    use FileFolderManage, GetStubContents;

    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data)
    {
        $this->model_data = $model_data;
        $this->stub_path =__DIR__.'/../../stubs/request.stub';
        $this->dir_name='app/Http/Requests';
        $this->make();
    }

    public function make(): void
    {
        $model_data  = json_decode($this->model_data);
        foreach ($model_data as $key => $model){
            $model_name = $model->model_name;
            $request_rules = $model->request_rules;
            $rules_count = count($request_rules);
            $rules = "["."\n\t\t\t";
            if ($rules_count == 0){
                $rules.="]";
            }else{
                foreach ($request_rules as $key_1=>$rule){
                    $fillable_vaiable = explode('-',$rule)[0];
                    $fillable_rule = explode('-',$rule)[1];
                    if ($key_1 == $rules_count-1) {
                        $rules .= "\n\t\t\t'".$fillable_vaiable."' => "."'".$fillable_rule."',\n"."\n\t\t\t]";
                    }else{
                        $rules .= "\n\t\t\t'".$fillable_vaiable."' => "."'".$fillable_rule."',";
                    }
                }
            }
            $contents =$this->getStubContents($this->stub_path,[
                'namespace' => 'App\\Http\\Requests',
                'rootNamespace'=>'App\\',
                'classname'=> ucwords($model_name),
                'rules'=>$rules
            ]);
            $this->makeFile($this->dir_name.'/'.'Create'. ucwords($model->model_name).'Request.php', $contents);
        }
    }
}
