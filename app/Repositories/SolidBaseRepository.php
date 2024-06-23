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
}
