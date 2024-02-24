<?php

namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Illuminate\Routing\Controller;


class MakeInterface extends Controller
{
    use FileFolderManage;
    protected $interfaceName,$stub_path,$dir_name;
    public function __construct($interfaceName)
    {
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

    public function getStubContents($stub_path,$stubVariables = [])
    {
        $contents = file_get_contents($stub_path);
        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('{{ '.$search.' }}' , $replace, $contents);
        }
        return $contents;
    }
}
