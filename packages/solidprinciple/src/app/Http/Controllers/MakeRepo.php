<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeRepo extends Controller
{
    use FileFolderManage,GetStubContents;
    protected $className,$stub_path,$dir_name;
    public function __construct($className)
    {
        $this->className = $className;
        $this->stub_path =__DIR__.'/../../stubs/repo.stub';
        $this->dir_name='Repositories';
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory('app/'.$this->dir_name);
        $contents =$this->getStubContents($this->stub_path, ['namespace' => 'App\\'.$this->dir_name,'classname'=> $this->className]);
        $this->makeFile('app/'.$this->dir_name.'/'.$this->className.'.php', $contents);
    }
}
