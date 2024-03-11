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

   public function getFillable(){
        return ['name','description','price','stock_quantity','category_id'];
    }


}
