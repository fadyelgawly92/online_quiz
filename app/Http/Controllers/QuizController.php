<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuestionsAnswer;
use App\Question;
use App\Result;
use Illuminate\Support\Facades\Redirect;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;
use DB;
use DataTables;
use Yajra\DataTables\QueryDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreQuizRequest;
use App\Notifications\MailQuiz;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Validator;


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

    public function send_quiz($quiz)
    {
        $users = User::permission('Approved')->get();
        foreach($users as $user){
            $invoice = new MailQuiz($user , $quiz);
            $user->sendEmailNotification($invoice , $quiz);
        }
        return Redirect(route('quiz.index'));
    }

    public function register($user , $quiz)
    {
        return view('quizzes.register',[
            'user' => $user,
            'quiz' => $quiz,
        ]);
    }

    public function quiz_answer(Request $request ,$quiz , $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];
        $customMessages = [
            'required' => 'The :attribute field can not be blank.'
        ];
        $this->validate($request, $rules, $customMessages);
        $email = User::where('email',$request->email)->get();
        $name = User::where('name',$request->name)->get();
        if(!$email->isEmpty() && !$name->isEmpty()){
            $myquiz = Quiz::findorFail($quiz);
            $myquiz->question = Question::where('quiz_id', $quiz)->inRandomOrder()->get() ;
            foreach($myquiz->question as $question){
                $question->questionAnswer = QuestionsAnswer::where('question_id',$question->id)->inRandomOrder()->get() ;
            }
            return view('quizzes.resolve',[
                'myquiz' => $myquiz,
                'user' => $user,
            ]);
        }else{
            $validator = Validator::make($request->all(), $rules, $customMessages);
            $errors = $validator->errors()->add('email', 'Wrong information added in one of the fields !!');
            // dd($errors);
            return back()->withErrors($errors);
        }

    }

    public function submit_quiz(Request $request , $quiz ,$user)
    {
        //  dd($request->input('questions'));
        foreach($request->input('questions',[]) as $key => $question){
            $status = 0;
            // dd(QuestionsAnswer::find($request->input('answers',$question))->firstWhere('option', 'comment')->is_correct);
            // dd(QuestionsAnswer::find($request->input('answers',$question))->first()->is_correct);
            // dd(QuestionsAnswer::find($request->input('answers',$question))->each(function($item , $key){
            //     return ($item->is_correct);
            // }));
            // dd($request->input('answers.'.$question));

            if($request->input('answers.'.$question) != null 
            && QuestionsAnswer::find($request->input('answers.'.$question))->is_correct ){

                $status = 1;
            }
            Result::create([
                'quiz_id' => $quiz ,
                'question_id' => $question ,
                'question_answer_id' => $request->input('answers.'.$question),
                'user_id' => $user,
                'is_correct' => $status ,
            ]);
        }

        return Redirect(route('quiz.index'));
    }

}
