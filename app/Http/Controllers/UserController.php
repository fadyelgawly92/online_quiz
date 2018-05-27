<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreFormRequest ;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;
use DB;
use DataTables;
use Yajra\DataTables\QueryDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('index');
    }

    public function approvedIndex(UsersDataTable $dataTable)
    {
        return $dataTable->render('approved');
    }

    public function get_data()
    {
        $query = DB::table('users')
                    ->whereNotIn('id', DB::table('model_has_permissions')->select('model_id'))
                    ->get();
        return DataTables::of($query)->toJson() ;
    }

    public function get_data_approved()
    {
        $query = DB::table('model_has_permissions')->leftJoin('users', 'model_has_permissions.model_id', '=', 'users.id')->get();
        return DataTables::of($query)->toJson();
    }

    public function create()
    {
        return view('form');
    }

    public function store(StoreFormRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'passwordConfirmation' => $request->passwordConfirmation
        ]);
        return Redirect(route('users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $permisionExist = DB::table('permissions')->where('name','=','Approved')->get();
        if($permisionExist->isEmpty()){
        $permission = Permission::create(['name' => 'Approved']);
        }
        $user->givePermissionTo('Approved');
        return redirect(route('users.index'));
    }

    public function delete($id)
    {
        User::where('id',$id)->delete();
        return response()->json(['status' => true]);
    }
}
