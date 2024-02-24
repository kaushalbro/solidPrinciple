<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Illuminate\Routing\Controller;

class MakeInterface extends Controller
{
    public $interfaceName;

    public function __construct($interfaceName)
    {
        $this->interfaceName = $interfaceName;
        $this->make();
    }

    public function make()
    {
        dump( ' hello ' . $this->interfaceName);
    }

}
