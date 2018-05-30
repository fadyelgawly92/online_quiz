<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuestionsAnswer;
use App\Question;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;
use DB;
use DataTables;
use Yajra\DataTables\QueryDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreQuizRequest;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index' , compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(StoreQuizRequest $request)
    {
        Quiz::create([
            'name' => $request->name
        ]);   
        return Redirect(route('quiz.index'));
    }

    public function show($id)
    {
        $quiz = Quiz::findorFail($id);
        $quiz->question = Question::where('quiz_id', $id)->inRandomOrder()->get() ;
        foreach($quiz->question as $question){
            $question->questionAnswer = QuestionsAnswer::where('question_id',$question->id)->inRandomOrder()->get() ;
        }
        return view('quizzes.show',compact('quiz'));    
    }

}
