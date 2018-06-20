<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\QuestionsAnswer;
use App\Result;
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

    public function show($id)
    {
        $relations = [
            'questions' => \App\Question::get()->pluck('body', 'id')->prepend('Please select', ''),
        ];
        $questions_option = QuestionsAnswer::findOrFail($id);
        return view('questions_answers.show', compact('questions_option') + $relations);
    }

    public function edit($id)
    {
        $relations = [
            'questions' => \App\Question::get()->pluck('body', 'id')->prepend('Please select', ''),
        ];
        $questions_option = QuestionsAnswer::findOrFail($id);
        return view('questions_answers.edit', compact('questions_option') + $relations);
    }

    public function update(Request $request , $id)
    {
        $questionsoption = QuestionsAnswer::findOrFail($id);
        $questionsoption->update($request->all());
        return Redirect(route('questions_answer.index'));
    }

    public function delete($id)
    {
        Result::where('question_answer_id',$id)->delete();
        $questions_option = QuestionsAnswer::findOrFail($id);
        $questions_option->delete();
        return Redirect(route('questions_answer.index'));
    }
}
