<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class OptionController extends Controller
{
    public $options;
    public function __construct($options)
    {
        $this->options=$options;
    }
    public function chooseOption(): void
    {
        switch ($this->options) {
            case $this->options['interface']:
                new MakeInterface('SolidInterface');
                break;
            case $this->options['repo']:
                new MakeRepo('SolidBaseRepository');
                break;
            case $this->options['model']:
                new MakeModel(base_path('data.json'));
//                new MakeModelRepo('model');
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
            default:
                new MakeInterface('interface');
                new MakeRepo('repo');
                new MakeModel('model');
                new MakeRequest('request');
                new MakeController('controller');
                new MakeMigration('migration');
                new MakeRoute('route');
        }

    }

}
