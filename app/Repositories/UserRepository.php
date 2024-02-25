<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository extends SolidBaseRepository
{
     protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

   public function getFillable(){
        return ['name','email','password'];
    }


}
