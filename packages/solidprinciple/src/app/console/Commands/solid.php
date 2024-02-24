<?php

namespace Devil\Solidprinciple\app\console\Commands;

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
            case $this->option('model'):
                $this->info('model');
                break;
            case $this->option('controller'):
                $this->info('controller');
                break;
            case $this->option('interface'):
                $this->info('interface');
                break;
            case $this->option('repo'):
                $this->info('repo');
                break;
            case $this->option('migration'):
                $this->info('migration');
                break;
            case $this->option('request'):
                $this->info('request');
                break;
            case $this->option('route'):
                $this->info('route');
                break;
            default:
                $this->info('all');
        }
    }
}
