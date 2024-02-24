<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeController extends Controller
{
    public $controllerName;
    public function __construct($controllerName)
    {
        $this->controllerName=$controllerName;
        $this->make();
    }
    public function make(){
        dump(' hello '. $this->controllerName);
    }

}
