<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quiz;
use App\Result;
use App\StudentsScores;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreFormRequest ;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;
use DB;
use Illuminate\Notifications\Messages\NexmoMessage;
use DataTables;
use Yajra\DataTables\QueryDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


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
        $firstQuery = DB::table('permissions')->where('name','=','admin')->select('id')->first();
        // dd($firstQuery->id);
        $query = DB::table('model_has_permissions')->where('permission_id','!=',$firstQuery->id)
        ->leftJoin('users', 'model_has_permissions.model_id', '=', 'users.id')->get();
        // dd($query);
        return DataTables::of($query)->toJson();
    }

    public function create()
    {
        return view('myform');
    }

    public function store(StoreFormRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'passwordConfirmation' => bcrypt($request->passwordConfirmation),
            'phone_number' => $request->phone,
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
        Result::where('user_id',$id)->delete();
        StudentsScores::where('user_id',$id)->delete();
        User::where('id',$id)->delete();
        return response()->json(['status' => true]);
    }

    public function delete_approved($id)
    {
        $user = User::find($id);
        $user->revokePermissionTo('Approved');
        return response()->json(['status' => true]);
    }

    public function signout()
    {
        Auth::logout();
        return Redirect(route('home'));
    }

    public function registered()
    {
        return view('register');
    }

    public function make_admin($id)
    {
        $user = User::find($id);
        $permisionExist = DB::table('permissions')->where('name','=','admin')->get();
        if($permisionExist->isEmpty()){
        $permission = Permission::create(['name' => 'admin']);
        }
        $user->givePermissionTo('admin');
        return redirect(route('users.index'));
    }

    public function chartControl()
    {
        $relations = [
            'quiz' => \App\Quiz::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $quizzes = Quiz::all();
        return view('charts.show', compact('quizzes') + $relations);
    }

    public function chart(Request $request)
    {
        $quizId = $request->input('id');
        $names=[];
        $scores=[];
        $users = User::permission('Approved')->get();
        foreach($users as $user){
            $i = 0;
            array_push($names ,$user->name) ; 
            $score = StudentsScores::where('user_id',$user->id)->where('quiz_id',$quizId)->select('score')->get();
            $total = StudentsScores::where('user_id',$user->id)->where('quiz_id',$quizId)->select('total')->get();
            do{
                if (! $score->isEmpty()){
                    $final = ($score[$i]['score']/$total[$i]['total'])*100 ;
                }else{
                    $final = 0;
                }
                array_push($scores,$final);
                $i++;
            }while($i <count($score));
            
        }
        // dd($scores[6][0]['total']); very important information
        // dd($scores);
        return view('charts.chart',[
            'names' => $names,
            'scores' => $scores,
            'quizId' => $quizId,
        ]);
    }

    public function message($id)
    {
        $users = User::permission('Approved')->get();
        foreach($users as $user){
            $i = 0;
            $score = StudentsScores::where('user_id',$user->id)->where('quiz_id',$id)->select('score')->get();
            $total = StudentsScores::where('user_id',$user->id)->where('quiz_id',$id)->select('total')->get();
            do{
                if (! $score->isEmpty()){
                    $final = ($score[$i]['score']/$total[$i]['total'])*100 ;
                    $nexmo = app('Nexmo\Client');
                    $nexmo->message()->send([
                        'to'   => $user->phone_number,
                        'from' => '201226134748',
                        'text' => 'Your score in our Exam is '.$final.'% Thank you for your participation' 
                    ]);
                }else{
                    $final = 0;
                    $nexmo = app('Nexmo\Client');
                    $nexmo->message()->send([
                        'to'   => $user->phone_number,
                        'from' => '201226134748',
                        'text' => 'Your score in our Exam is '.$final.'% Thank you for your participation' 
                    ]);
                }
                $i++;
            }while($i <count($score));
        }
        return view('charts.message');
    }
}
