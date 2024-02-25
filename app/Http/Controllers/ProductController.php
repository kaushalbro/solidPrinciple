<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    protected $repository;


    public function __construct()
    {
        $this->repository =  new ProductRepository(new Product());
    }

    public function index()
    {
        $allProduct=$this->repository->getAll();
        return view("",compact('allProduct'));
    }


    public function store(CreateProductRequest $request)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route('')->with('success', 'Product created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update Product : ".$e->getMessage());
          }

    }


    public function show($id)
    {
         $Product=$this->repository->getById($id);
         return view("",compact('Product'));
    }

    public function update(CreateProductRequest $request, $id)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->update($id,$attributes);
            DB::commit();
            return redirect()->route('')->with('success','Product updated successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update. Product : " .$e->getMessage());
          }
    }

    public function destroy($id)
    {
      try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->route('')->with('success','Product deleted successfully.');
          } catch (\Exception $e) {
             DB::rollback();
             return redirect()->back()->withInput()->with('failed', 'Failed to delete Product : '.$e->getMessage());
          }
    }
}
