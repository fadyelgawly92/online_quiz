<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\QuestionsAnswer;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;
use DB;
use DataTables;
use Yajra\DataTables\QueryDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreAnswerRequest;


class QuestionsAnswerController extends Controller
{
    public function index()
    {
        $questions_answers = QuestionsAnswer::all();
        return view('questions_answers.index', compact('questions_answers'));
    }

    public function create()
    {
        $questions = Question::all()->pluck('body','id')->prepend('select from', '');
        return view('questions_answers.create', [
            'questions' => $questions,
        ]);
    }

    public function store(StoreAnswerRequest $request)
    {
       QuestionsAnswer::create($request->all());
       return Redirect(route('questions_answer.index'));
    }

    public function edit()
    {
        
    }

    public function show()
    {

    }

    public function destroy()
    {

    }
}
