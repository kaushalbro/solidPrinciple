<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository extends SolidBaseRepository
{
     protected $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }




}
