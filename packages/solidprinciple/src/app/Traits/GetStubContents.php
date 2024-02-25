<?php
namespace Devil\Solidprinciple\app\Traits;

trait GetStubContents
{
    public function getStubContents($stub_path,$stubVariables = [])
    {
        $contents = file_get_contents($stub_path);
        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('{{ '.$search.' }}' , $replace, $contents);
        }
        return $contents;
    }
    public function removeDoubleQuote($array){
        $fillableCount = count($array);
        $newFillable = '[';
        if ($fillableCount == 0){
            $newFillable.="]";
        }else{
            foreach ($array as $key_1=> $fillable){
                $fillable=strtolower($fillable);
                if ($key_1 == $fillableCount-1) {
                    $newFillable.="'".$fillable."']";
                }else{
                    $newFillable.="'".$fillable."',";
                }
            }
        }
        return $newFillable;
    }
}
