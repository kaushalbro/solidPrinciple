<?php
namespace App\Interfaces;

interface SolidInterface
{
     public function create(array $attributes);
     public function update($id, array $attributes);
     public function delete($id);
     public function getAll();
     public function getById($id);
}
