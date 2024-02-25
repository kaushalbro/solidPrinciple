<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

    protected $repository;


    public function __construct()
    {
        $this->repository =  new CategoryRepository(new Category());
    }

    public function index()
    {
        $allCategory=$this->repository->getAll();
        return view("",compact('allCategory'));
    }


    public function store(CreateCategoryRequest $request)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route('')->with('success', 'Category created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update Category : ".$e->getMessage());
          }

    }


    public function show($id)
    {
         $Category=$this->repository->getById($id);
         return view("",compact('Category'));
    }

    public function update(CreateCategoryRequest $request, $id)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->update($id,$attributes);
            DB::commit();
            return redirect()->route('')->with('success','Category updated successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update. Category : " .$e->getMessage());
          }
    }

    public function destroy($id)
    {
      try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->route('')->with('success','Category deleted successfully.');
          } catch (\Exception $e) {
             DB::rollback();
             return redirect()->back()->withInput()->with('failed', 'Failed to delete Category : '.$e->getMessage());
          }
    }
}
