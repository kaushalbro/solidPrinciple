<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeRepo extends Controller
{
    public $repoName;
    public function __construct($repoName)
    {
        $this->repoName=$repoName;
        $this->make();
    }
    public function make(){
        dump(' hello '. $this->repoName);
    }

}
