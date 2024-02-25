<?php
namespace Devil\Solidprinciple\app\Traits;

trait FileFolderManage
{
    public function makeDirectory($path)
    {
        try {
            $directoryPath= base_path($path);
            $path_array = explode('/', $path);
            $is_directory =  is_dir($directoryPath);
            if (!$is_directory){
                mkdir($directoryPath, 0777, true);
                error_log(sprintf("\033[32m%s\033[0m",end($path_array).' Folder Created.'));
                return $directoryPath;
            }
            error_log(sprintf("\033[33m%s\033[0m",end($path_array).' Folder already Exists.'));
        }catch (\Exception $e){
            error_log($e->getMessage());
        }
    }

    public function makeFile($path, $data=null)
    {
        try {
            $filePath= base_path($path);
            $path_array = explode('/', $path);
            $file_name= end($path_array);
            $is_file =  file_exists($filePath);
            if (!$is_file){
                file_put_contents($path, $data);
                error_log(sprintf("\033[32m%s\033[0m",end($path_array).' File Created.'));
                return $filePath;
            }
            error_log(sprintf("\033[33m%s\033[0m",$file_name.' File already Exists.'));
            return $filePath;
        }catch (\Exception $e){
            error_log($e->getMessage());
        }
    }


}
