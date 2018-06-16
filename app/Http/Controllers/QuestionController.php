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
use App\Http\Requests\StoreQusetionRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('questions.index',compact('questions'));
    }

    public function create()
    {
        $quiz = Quiz::all()->pluck('name','id')->prepend('please select','');
        $correct_options = [
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
            'option4' => 'Option 4',
        ];
        return view('questions.create',[
            'quiz' => $quiz,
            'correct_options' => $correct_options
        ]);
    }

    public function store(StoreQusetionRequest $request)
    {
        $question = Question::create($request->all());
        foreach ($request->input() as $key => $value) {
            if(strpos($key, 'option') !== false && $value != '') {
                $status = $request->input('correct') == $key ? 1 : 0;
                QuestionsAnswer::create([
                    'question_id' => $question->id,
                    'option'      => $value,
                    'is_correct'     => $status
                ]);
            }
        }
        return Redirect(route('question.index'));

    }

    public function show($id)
    {
        $relations = [
            'quizzes' => \App\Quiz::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $question = Question::findOrFail($id);
        return view('questions.show', compact('question') + $relations);
    }

    public function edit($id)
    {
        $relations = [
            'quiz' => \App\Quiz::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question') + $relations);
    }

    public function update(Request $request , $id)
    {
        $question = Question::findOrFail($id);
        $question->update([
            'body' => $request->input('body')
        ]);
        return Redirect(route('question.index'));
    }

    public function delete($id)
    {
        DB::table('questions_answers')->where('question_id','=',$id)->delete();
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('question.index');
    }
}
