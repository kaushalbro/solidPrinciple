<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeRoute extends Controller
{
    public $routeName;
    public function __construct($routeName)
    {
        $this->routeName=$routeName;
        $this->make();
    }
    public function make(){
        dump(' hello '. $this->routeName);
    }

}
