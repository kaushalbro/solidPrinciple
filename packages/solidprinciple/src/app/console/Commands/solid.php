<?php

namespace Devil\Solidprinciple\app\console\Commands;

use App\Http\Controllers\Controller;
use Devil\Solidprinciple\app\Http\Controllers\MakeController;
use Devil\Solidprinciple\app\Http\Controllers\MakeInterface;
use Devil\Solidprinciple\app\Http\Controllers\MakeMigration;
use Devil\Solidprinciple\app\Http\Controllers\MakeModel;
use Devil\Solidprinciple\app\Http\Controllers\MakeRepo;
use Devil\Solidprinciple\app\Http\Controllers\MakeRequest;
use Devil\Solidprinciple\app\Http\Controllers\MakeRoute;
use Illuminate\Console\Command;

class solid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //interface-repo-model-migration-request
    //{id? : this is id} here ? means optional while making arguments, after : this is description of argument
    //flag/options {--h|help} here --h also shows help --help also shows help

    protected $signature = 'solid:make {--d|default : Generate model,controller,interface,repository,migration,custom request,route.} {--m|model : Generate model} {--c|controller : Generate Controller } {--i|interface : Generate interface} {--re|repo  : Generate repository} {--mi|migration  : Generate migration} {--r|request : Generate custom request} {--ro|route : Generate routes} {--h|help}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Solid principle make interface repo model migration and custom request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        switch ($this->options()) {
            case $this->option('interface'):
                new MakeInterface('interface');
                break;
            case $this->option('repo'):
                new MakeRepo('repo');
                break;
            case $this->option('model'):
                new MakeModel('model');
                break;
            case $this->option('controller'):
                new MakeController('controller');
                break;
            case $this->option('request'):
                new MakeRequest('request');
                break;
            case $this->option('migration'):
                new MakeMigration('migration');
                break;
            case $this->option('route'):
                new MakeRoute('route');
                break;
            default:
                new MakeInterface('interface');
                new MakeRepo('repo');
                new MakeModel('model');
                new MakeController('controller');
                new MakeRequest('request');
                new MakeMigration('migration');
                new MakeRoute('route');
        }
    }
}
