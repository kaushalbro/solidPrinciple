<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeModel extends Controller
{
    public $modelName;
    public function __construct($modelName)
    {
           $this->modelName=$modelName;
           $this->makeModel();
    }
    public function makeModel(){
        dump(' hello '. $this->modelName);
    }

}
