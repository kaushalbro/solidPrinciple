<?php
namespace App\Repositories;
use App\Models\Category;

class CategoryRepository extends SolidBaseRepository
{
     protected $model;
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

   public function getFillable(){
        return ['name','description'];
    }


}
