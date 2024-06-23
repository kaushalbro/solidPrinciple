<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;


class RoleController extends Controller
{

    protected $repository;
    protected $view_path="backend.admin.role.";


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:role-create|role-view|role-edit|role-delete'], ['only' => ['show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:role-view'], ['only' => ['index']]);
        $this->repository =  new RoleRepository(new Role());
    }

    public function index()
    {
        $roles=$this->repository->getAll();
//        $user= User::find(Auth::id());
//        dd($user->permissions);
//        $user->assignRole(41);
        return view($this->view_path."index",compact('roles'));
    }

    public function getList(Request $request)
    {
        $roles=$this->repository->getAll();
             return Datatables::of($roles)
                    ->addIndexColumn()
                    ->addColumn('action', function($role){
                        return $this->actionButtons($role);
                    })
                    ->addColumn('permissions', function($role){
                        $role=\Spatie\Permission\Models\Role::findByName($role->name);
                        $total_permission=$role->permissions()->get()->count();
                     return '<span href="" class="label label-primary">'.$total_permission.'</span>';
                    })
                    ->rawColumns(['action','permissions'])
                    ->make(true);
    }
        public function actionButtons($role){
            $show_btn=$delete_btn=$edit_btn="";
            $actionBtns='';
                 if (Auth::user()->can('role-view')){
                     $show_btn = '<a href="'.route("roles.show", $role->id).'" class="actions btn btn-sm btn-info" data-tooltip="true" title="Show">
                    <i class="far fa-eye" aria-hidden="true"></i></a>';
                 }
               if (Auth::user()->can('role-edit')){
                $edit_btn= '<a  href="'.route("roles.edit", $role->id).'" class="actions btn btn-sm btn-warning" data-tooltip="true" title="Edit">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
               }
                  if (Auth::user()->can('role-delete')){
                  $delete_btn= '
                    <form style="display:contents" method="get" class="delete_form" action="' .route("roles.destroy",$role->id). '">
                    <button type="submit"  class="btn btn-danger btn-sm actions" title="delete" >
                    <i class="fas fa-trash"></i></button>';
                  }
                $actionBtns = '
                    <nobr>
                        '.$show_btn.' '.$edit_btn.' '.$delete_btn.'
                    </nobr>
                    ';
                return $actionBtns;
        }

    public function show($id)
    {
         $role=\Spatie\Permission\Models\Role::with('users','permissions')->find($id);
         return view($this->view_path."show",compact('role'));
    }

    public function edit($id)
    {
          $role=\Spatie\Permission\Models\Role::with('permissions')->findOrFail($id);
          return view($this->view_path."edit",compact('role'));
    }

    public function create()
    {
         return view($this->view_path."create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
      try {
            DB::beginTransaction();
            $attributes= $request->only($this->repository->getFillable());
            $role=\Spatie\Permission\Models\Role::create(array_merge($attributes,['guard_name'=>'web']));
            $permissions=$request->permissions??[];
            foreach ($permissions as $key=>$permission){
                if (!Permission::where('name',$key)->get()->first()){
                    Permission::create(['name' => $key]);
                }
            }
             $role->syncPermissions(array_keys($permissions));
            DB::commit();
            return redirect()->route('roles.index')->withInput()->with('success', 'Role created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
          return redirect()->back()->withInput()->with('failed', "Failed to update Role : ".$e->getMessage());
          }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);
      try {
          DB::beginTransaction();
          $request->merge(['guard_name'=>'web']);
          $attributes= $request->only($this->repository->getFillable());
          $this->repository->update($id,$attributes);
          $permissions=$request->permissions??[];
          foreach ($permissions as $key=>$permission){
              if (!Permission::where('name',$key)->get()->first()){
                  Permission::create(['name' => $key]);
              }
          }
          \Spatie\Permission\Models\Role::find($id)->syncPermissions(array_keys($permissions));
          \auth()->user()->givePermissionTo(array_keys($permissions));
            DB::commit();
            return redirect()->back()->withInput()->with('success','Role updated successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', "Failed to update. Role : " .$e->getMessage());
          }
    }

    public function destroy($id)
    {
      try {
             DB::beginTransaction();
             DB::table("roles")->where('id', $id)->delete();
              DB::commit();
              return redirect()->route('roles.index')
              ->with('success', 'Role deleted successfully');
          } catch (\Exception $e) {
             DB::rollback();
             return redirect()->back()->withInput()->with('failed', 'Failed to delete Role : '.$e->getMessage());
          }
    }
}
