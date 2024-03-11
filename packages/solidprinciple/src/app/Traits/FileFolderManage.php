<?php
namespace Devil\Solidprinciple\app\Traits;

use ZipArchive;

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
            return $directoryPath;
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
                error_log(sprintf("\033[32m%s\033[0m",$path_array[count($path_array)-2]. ' '.end($path_array).' File Created.'));
                return $filePath;
            }
            error_log(sprintf("\033[33m%s\033[0m",$file_name.' File already Exists.'));
            return $filePath;
        }catch (\Exception $e){
            error_log($e->getMessage());
        }
    }

    public function copy($source_path,$destination_path){
        $path_array = explode('/', $source_path);
        $file_name= end($path_array);
        if (!file_exists($destination_path)) {
            if (copy($source_path, $destination_path)) {
                error_log(sprintf("\033[32m%s\033[0m",$file_name.' File Copied successfully.'));
                return true;
            } else {
                error_log(sprintf("\033[31m%s\033[0m", ' Failed to copy file.'. $file_name));
            }
        }
        error_log(sprintf("\033[33m%s\033[0m",$file_name.' File already Exists.'));
        return false;
    }

    public function unzip($source_file_path,$dest_file_name, $extraction_path){
        if (!file_exists($source_file_path)){
          error_log(sprintf("\033[31m%s\033[0m", ' File No exists.'));
            return false;
        }
            $zip = new ZipArchive();
        if ($zip->open($source_file_path) === true) {
            $zip->extractTo($unzip_destination);
            $zip->close();
            error_log(sprintf("\033[32m%s\033[0m",'File Unzipped successfully.'));
            return true ;
        } else {
            error_log(sprintf("\033[31m%s\033[0m", ' Failed to Unzip file.'));
            return false ;
        }
    }

}
