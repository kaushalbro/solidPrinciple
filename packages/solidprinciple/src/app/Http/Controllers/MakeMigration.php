<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeMigration extends Controller
{
    public $migrationName;
    public function __construct($migrationName)
    {
        $this->migrationName=$migrationName;
        $this->make();
    }
    public function make(){
        dump(' hello '. $this->migrationName);
    }

}
