<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    protected $repository;


    public function __construct()
    {
        $this->repository =  new UserRepository(new User());
    }

    public function index()
    {
        $allUser=$this->repository->getAll();
        return view("",compact('allUser'));
    }


    public function store(CreateUserRequest $request)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route('')->with('success', 'User created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update User : ".$e->getMessage());
          }

    }


    public function show($id)
    {
         $User=$this->repository->getById($id);
         return view("",compact('User'));
    }

    public function update(CreateUserRequest $request, $id)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->update($id,$attributes);
            DB::commit();
            return redirect()->route('')->with('success','User updated successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update. User : " .$e->getMessage());
          }
    }

    public function destroy($id)
    {
      try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->route('')->with('success','User deleted successfully.');
          } catch (\Exception $e) {
             DB::rollback();
             return redirect()->back()->withInput()->with('failed', 'Failed to delete User : '.$e->getMessage());
          }
    }
}
