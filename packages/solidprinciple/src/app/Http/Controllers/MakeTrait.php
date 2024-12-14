<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;

class MakeTrait extends BaseController
{
    use FileFolderManage,GetStubContents;
    protected $traitName,$stub_path,$dir_name;
    public function __construct($traitName)
    {
        parent::__construct();
        $this->traitName = $traitName;
        $this->stub_path =__DIR__.'/../../Traits/'.$traitName.'.stub';
        $this->dir_name='Traits';
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory('app/'.$this->dir_name);
        $contents =$this->getStubContents($this->stub_path, ['namespace' => 'App\\'.$this->dir_name]);
        $this->makeFile('app/'.$this->dir_name.'/'.$this->traitName.'.php', $contents);
    }
}
