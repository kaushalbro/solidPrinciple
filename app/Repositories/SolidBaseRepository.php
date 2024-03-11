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
}
