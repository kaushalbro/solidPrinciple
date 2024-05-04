<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Http\Controllers\Admin\MakeAdminPanelController;
use Devil\Solidprinciple\app\Traits\CheckConfigFile;
use Illuminate\Routing\Controller;

class OptionController extends Controller
{
    use CheckConfigFile;
    public $options;
    public function __construct($options)
    {
        $this->options=$options;
    }
    public function chooseOption()
    {
        if (!$this->options['config']){
            $this->checkConfig();
        }
        if (!file_exists(config('solid.raw_json_data_path'))){
            error_log(sprintf("\033[31m%s\033[0m", config('solid.raw_json_data_path')." => Raw data file not found in the path "));
            return exit();
        }
        $data_path=config('solid.raw_json_data_path');
        switch ($this->options) {
            case $this->options['config']:
                new MakeConfig();
                break;
            case $this->options['interface']:
                new MakeInterface('SolidInterface');
                break;
            case $this->options['repo']:
                new MakeRepo('SolidBaseRepository');
                break;
            case $this->options['model']:
                new MakeModel($data_path);
                break;
            case $this->options['controller']:
                new MakeController('controller');
                break;
            case $this->options['request']:
                new MakeRequest('request');
                break;
            case $this->options['migration']:
                new MakeMigration('migration');
                break;
            case $this->options['route']:
                new MakeRoute('route');
                break;
            case $this->options['new-admin-panel']:
                new MakeAdminPanelController($data_path);
                break;
            case $this->options['repo-crud']:
                $this->makeRepoCrud($data_path);
                break;
            default:
                 exit();
        }

    }
    public function makeRepoCrud($data_path){
        //Generating Base Interface for Base Repository
        new MakeInterface('SolidInterface');
        //Generating Base Repository for Model Repository
        new MakeRepo('SolidBaseRepository');
        //Generating Models
        new MakeModel($data_path);
        //Generating Model's Repositories
        new MakeModelRepo($data_path);
        //Generating Custom Request
        new MakeRequest($data_path);
        //Generating Controller
        new MakeController($data_path);
        //Generating Routes
           //new MakeRoute($data_path);
        //Generating Migrations
        new MakeMigration($data_path);
    }

}
