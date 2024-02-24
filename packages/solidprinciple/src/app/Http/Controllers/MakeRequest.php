<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeRequest extends Controller
{
    public $requestName;
    public function __construct($requestName)
    {
        $this->requestName=$requestName;
        $this->make();
    }
    public function make(){
        dump(' hello '. $this->requestName);
    }

}
