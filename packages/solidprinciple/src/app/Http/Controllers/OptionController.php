<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Http\Controllers\Admin\MakeAdminPanelController;
use Devil\Solidprinciple\app\Traits\CheckConfigFile;
use Devil\Solidprinciple\app\Traits\GetPath;
use Devil\Solidprinciple\app\Traits\MakeSidebar;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class OptionController extends Controller
{
    use CheckConfigFile,GetPath, MakeSidebar;
    public $options,$arguments;
    public function __construct($options,$arguments)
    {
        $this->options=$options;
        $this->arguments=$arguments;
    }
    public function chooseOption()
    {
        if (!$this->options['config']){
            $this->checkConfig();
        }else{
            new MakeConfig();
        }
        if (!file_exists(config('solid.raw_json_data_path'))){
            error_log(sprintf("\033[31m%s\033[0m", config('solid.raw_json_data_path')." => Raw data file not found in the path "));
            return exit();
        }
        $data_path=config('solid.raw_json_data_path');
        $model_name = $this->arguments['model_name'];
        new MakeComponents();
        switch ($this->options) {
            case $this->options['test']:
                dd('fdfdf');
                break;
            case $this->options['config']:
                new MakeConfig();
                break;
            case $this->options['interface']:
                new MakeInterface(config('solid.base_interface_name'));
                break;
            case $this->options['repo']:
                new MakeRepo(config('solid.base_repository_name'));
                break;
            case $this->options['model']:
                if ($model_name){
                    new MakeModel($this->makeModelRepoCrud($model_name));
                }
                break;
            case $this->options['controller']:
                if ($model_name){
                    new MakeController($this->makeModelRepoCrud($model_name));
                }
                break;
            case $this->options['request']:
                if ($model_name){
                    new MakeRequest($this->makeModelRepoCrud($model_name));
                }
                break;
            case $this->options['migration']:
                if ($model_name){
                    new MakeMigration($this->makeModelRepoCrud($model_name));
                }
                break;
            case $this->options['route']:
                new MakeRoute('route');
                break;
            case $this->options['view']:
                if ($model_name){
                    new MakeView($this->makeModelRepoCrud($model_name), $this->path('view_admin'));
                }
                break;
            case $this->options['layout']:
                new MakeLayout(($model_name=='frontend'||$model_name=='admin')?$model_name:"frontend",$data_path);
                break;
            case $this->options['new-admin-panel']:
                Artisan::call('solid:make --layout');
                new MakeAdminPanelController($data_path);
                break;
            case $this->options['repo-crud']:
                $this->makeRepoCrud($model_name?( $this->makeModelRepoCrud($model_name)):$data_path);
                break;
            default:
                if ($model_name){
                    $this->makeRepoCrud($model_name?( $this->makeModelRepoCrud($model_name)):$data_path);
                }
                 exit();
        }

    }
    public function makeRepoCrud($data_path){
        //Generating Base Interface for Base Repository
        new MakeInterface(config('solid.base_interface_name'));
        //Generating Base Repository for Model Repository
        new MakeRepo(config('solid.base_repository_name'));
        //Generating Models
        new MakeModel($data_path);
        //Generating Model's Repositories
        new MakeModelRepo($data_path);
        //Generating Custom Request
        new MakeRequest($data_path);
        //Generating Controller
        new MakeController($data_path);
        //Generating Migrations
        new MakeMigration($data_path);
        //Generating View
        new MakeView($data_path, $this->path('view_admin'));
//            new MakeView(is_array($data_path)?$data_path:file_get_contents($data_path), $this->path('view_admin'));
        $this->appendToSidebar($data_path);
        //Generating Routes
        //new MakeRoute($data_path);
    }

    public function makeModelRepoCrud($model_name)
    {
        $model_name_formated =ucfirst(Str::singular($model_name));
        $table_name = strtolower(Str::plural($model_name));
        return ['from_param','
                [ {
                    "model_name": "'.$model_name_formated.'",
                    "table_name": "'.$table_name.'",
                    "fillable":[],
                    "hidden": [],
                    "casts": [],
                    "with": [],
                    "sidebar": [false, "", ""],
                    "table_column_name": [],
                    "routes": [],
                    "request_rules":[],
                    "view_input":[]
                   }
                ]'];
    }

}
