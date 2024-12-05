<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;


class MakeComponents extends Controller
{
    use FileFolderManage,GetStubContents;
    protected $componentName;

    protected $stub_path;

    protected $dir_name;

    public function __construct()
    {
        $this->componentName = 'actionButtons.blade.php';
        $this->stub_path =__DIR__.'/../../stubs/components/actionButtons.blade.php';
        $this->dir_name='components';
        $this->make();
    }

    public function make(): void
    {
        $fileDIRPath= 'resources/views/'.$this->dir_name;
        $this->makeDirectory($fileDIRPath);
        $contents =$this->getStubContents($this->stub_path, ['namespace' => 'App\\'.$this->dir_name,'classname'=> $this->componentName]);
        $this->makeFile($fileDIRPath.'/'.$this->componentName, $contents);
    }

}
