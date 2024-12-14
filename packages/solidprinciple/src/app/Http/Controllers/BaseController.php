<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\HelperTrait;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use HelperTrait;
    public $laravel_10;
    public $laravel_11;
    public $is_api=false;
    public $repo_pattern=false;
    public $api_with_resource_classes;
    public $is_api_without_api_with_resource_classes;

    public function __construct(){
//        These are stub conditions
        $this->laravel_10 = app()->version()<11;
        $this->laravel_11 = app()->version()>=11;
        $this->is_api = config('solid.is_api');
        $this->repo_pattern = config('solid.design_pattern')=='repository' || config('solid.design_pattern')=='Repository';
        $this->api_with_resource_classes= config('solid.apiWithResourceClasses');
        $this->is_api_without_api_with_resource_classes = $this->is_api && !$this->api_with_resource_classes;
    }
}
