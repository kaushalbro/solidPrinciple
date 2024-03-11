<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    protected $repository;
    protected $view_path="backend.admin.order.";


    public function __construct()
    {
        $this->repository =  new OrderRepository(new Order());
    }

    public function index()
    {
        $orders=$this->repository->getAll();
        return view($this->view_path."index",compact('orders'));
    }


    public function show($id)
    {
         $order=$this->repository->getById($id);
         return view($this->view_path."show",compact('order'));
    }

    public function edit($id)
    {
          $order=$this->repository->getById($id);
          return view($this->view_path."edit",compact('order'));
    }

    public function create()
    {
         return view($this->view_path."create");
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
