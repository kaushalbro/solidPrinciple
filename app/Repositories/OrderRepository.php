<?php
namespace App\Repositories;
use App\Models\Order;

class OrderRepository extends SolidBaseRepository
{
     protected $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

   public function getFillable(){
        return ['name','description'];
    }


}
