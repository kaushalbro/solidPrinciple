<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;


class MakeInterface extends BaseController
{
    use FileFolderManage,GetStubContents;
    protected $interfaceName,$stub_path,$dir_name;
    public function __construct($interfaceName)
    {
        parent::__construct();
        $this->interfaceName = $interfaceName;
        $this->stub_path =__DIR__.'/../../stubs/interface.stub';
        $this->dir_name='Interfaces';
        $this->make();
    }

    public function make(): void
    {
             $this->makeDirectory('app/'.$this->dir_name);
             $contents =$this->getStubContents($this->stub_path, ['namespace' => 'App\\'.$this->dir_name,'classname'=> $this->interfaceName]);
             $this->makeFile('app/'.$this->dir_name.'/'.$this->interfaceName.'.php', $contents);
    }

}
