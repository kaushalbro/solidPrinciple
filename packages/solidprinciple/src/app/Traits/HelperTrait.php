<?php
namespace Devil\Solidprinciple\app\Traits;


trait HelperTrait
{
    public function frontend_request_type()
    {
        return (config('solid.frontend_request_type') == 'API' || config('solid.frontend_request_type') =="api");
    }
}

