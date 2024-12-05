<?php
namespace App\Repositories;
use App\Interfaces\SolidInterface;

class SolidBaseRepository implements SolidInterface
{
     protected $model;

     public function create(array $data){
        return $this->model->create($data);
     }

     public function update($id, array $data){
        $model = $this->getById($id);
        $model->update($data);
        return $model;
     }

     public function delete($id)
     {
        return $this->getById($id)->delete();
     }

     public function getAll(){
         return $this->model->all();
     }

     public function getById($id){
        return $this->model->findOrFail($id);
     }

    public function getByIdWith($id, $withs)
    {
        return $this->model->with($withs)->where('id', $id)->first();
    }
    public function getSelectAll()
    {
        return $this->model->all()->sortBy('name')->pluck('name', 'id');
    }
    public function getNext($id)
    {
        return $this->model->where('id', '>', $id)->orderBy('id', 'ASC')->first();
    }
    public function getPrevious($id)
    {
        return $this->model->where('id', '<', $id)->orderBy('id', 'DESC')->first();
    }

    public function storeOrUpdateFile($request, $model){
        if ($request->file('image')){
            $storePath= $model::IMAGE_PATH;
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
    public function deleteFile($image){
        if ($image && file_exists( base_path("public/".$image)))  unlink($image);
    }
}
