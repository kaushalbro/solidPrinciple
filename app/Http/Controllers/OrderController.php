<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    protected $repository;


    public function __construct()
    {
        $this->repository =  new OrderRepository(new Order());
    }

    public function index()
    {
        $allOrder=$this->repository->getAll();
        return view("",compact('allOrder'));
    }


    public function store(CreateOrderRequest $request)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route('')->with('success', 'Order created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update Order : ".$e->getMessage());
          }

    }


    public function show($id)
    {
         $Order=$this->repository->getById($id);
         return view("",compact('Order'));
    }

    public function update(CreateOrderRequest $request, $id)
    {
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $this->repository->update($id,$attributes);
            DB::commit();
            return redirect()->route('')->with('success','Order updated successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update. Order : " .$e->getMessage());
          }
    }

    public function destroy($id)
    {
      try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->route('')->with('success','Order deleted successfully.');
          } catch (\Exception $e) {
             DB::rollback();
             return redirect()->back()->withInput()->with('failed', 'Failed to delete Order : '.$e->getMessage());
          }
    }
}
