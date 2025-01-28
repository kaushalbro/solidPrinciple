<?php
namespace App\Traits;
trait FileManager
{
      public function storeOrUpdateFile($request, $model, $attributes=[]) : string
      {
        if ($request->file('image') && $model::IMAGE_PATH){
            $storePath= $model::IMAGE_PATH??'files';
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $imagePath=$storePath.$imageName;
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs(explode('/',$storePath)[1], $imageName, 'public');
            if ($model->image){
                $array=explode("/",$model->image);
                $last_key=array_key_last($array);
                if (file_exists(public_path($storePath)."/".$array[$last_key])){
                    unlink(public_path($storePath)."/".$array[$last_key]);
                }
            }
        }
        return $imagePath??'';
      }
      public function deleteFile($image): void
      {
        if ($image && file_exists( base_path("public/".$image)))  unlink($image);
      }
}