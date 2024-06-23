<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{

    protected $repository;
    protected $view_path="backend.admin.user.";


    public function __construct()
    {
        $this->middleware(['permission:user-create|user-edit|user-delete'], ['only' => ['show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:user-view'], ['only' => ['index']]);
        $this->repository =  new UserRepository(new User());
    }

    public function index()
    {
        $users=User::with('roles')->get();
        return view($this->view_path."index",compact('users'));
    }

    public function getList(Request $request)
    {
        $users=User::with('roles')->get();
             return Datatables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function($user){
                        return $this->actionButtons($user);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
        public function actionButtons($user){
             $is_auth_id=(Auth::id()==$user->id)?true:false;
            $show_btn=$delete_btn=$edit_btn="";
            $actionBtns='';
            if (Auth::user()->can('user-view')){
                $show_btn = '<a href="'.route("users.show", $user->id).'" class="actions btn btn-sm btn-info" data-tooltip="true" title="Show">
                    <i class="far fa-eye" aria-hidden="true"></i></a>';
            }
            if (Auth::user()->can('user-edit')){
                $edit_btn= '<a  href="'.route("users.edit", $user->id).'" class="actions btn btn-sm btn-warning" data-tooltip="true" title="Edit">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
            }
            if (Auth::user()->can('user-delete')){
                $delete_btn= '
                    <form style="display:contents" method="get" class="delete_form" action="' .route("users.destroy",$user->id). '">
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
         $user=$this->repository->getById($id);
         return view($this->view_path."show",compact('user'));
    }

    public function edit($id)
    {
          $user=$this->repository->getByIdWith($id, ['roles']);
          $role_repo = new RoleRepository(new Role());
          $roles = $role_repo->getAll();
          return view($this->view_path."edit",compact('user','roles'));
    }

    public function create()
    {
        $role_repo = new RoleRepository(new Role());
        $roles = $role_repo->getAll();
        return view($this->view_path."create", compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
      try {
            DB::beginTransaction();
            $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => Hash::make($request->password),
            ]);

           $user->syncRoles((\Spatie\Permission\Models\Role::where('id', (int) $request->role)->first()));
            event(new Registered($user));
            DB::commit();
            return redirect()->route('users.index')->with('success','User Created successfully.');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('users.index')->withInput()->with('failed', "Failed to update User : ".$e->getMessage());
          }

    }



    public function update(CreateUserRequest $request, $id)
    {
      try {
            DB::beginTransaction();
            $attributes= array_filter($request->only($this->repository->getFillable()), function($value, $key)use($request){
                return $key != 'password';
            }, ARRAY_FILTER_USE_BOTH);
            $user=$this->repository->update($id,$attributes);
            $user->syncRoles((\Spatie\Permission\Models\Role::where('id', (int) $request->role)->first()));
            DB::commit();
            return redirect()->route('users.index')->with('success','User updated successfully.');
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
