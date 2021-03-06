<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuestionsAnswer;
use App\Question;
use App\Result;
use App\StudentsScores;
use App\Jobs\RegistrationLink;
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
use Carbon\Carbon;
use jpmurray\LaravelCountdown\Countdown;
use Symfony\Component\HttpFoundation\Session\Session;




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
        $quiz->question = Question::where('quiz_id', $id)->paginate(10) ;
        foreach($quiz->question as $question){
            $question->questionAnswer = QuestionsAnswer::where('question_id',$question->id)->inRandomOrder()->get() ;
        }
        return view('quizzes.show',compact('quiz'));    
    }

    public function edit($id)
    {
        $quiz = Quiz::findorFail($id);
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findorFail($id);
        $quiz->update([
            'name' => $request->name
            ]);
        return Redirect(route('quiz.index'));
    }

    public function destroy($id)
    {
        Result::where('quiz_id',$id)->delete();
        StudentsScores::where('quiz_id',$id)->delete();
        $quiz = Quiz::findorFail($id);
        $questionId = Question::where('quiz_id',$id)->select('id')->get();
        for($i = 0;$i < count($questionId);$i++){
            $answers = QuestionsAnswer::where('question_id',$questionId[$i]['id'])->delete();
        }
        $questionId = Question::where('quiz_id',$id)->delete();
        $quiz->delete();
        return Redirect(route('quiz.index'));
    }

    public function send_quiz(Request $request,$quiz)
    {
        $countDown = $request->input('time');
        $request->session()->put('countDown',$countDown);
        $date = $request->input('date');
        $time = \Carbon\Carbon::parse($date)->timestamp;
        $now = Carbon::now()->timestamp;
        $delay = $time - $now; //this is the difference in seconds between the 2 dates
        $users = User::permission('Approved')->get();
        foreach($users as $user){
            $invoice = new MailQuiz($user , $quiz);
            $user->sendEmailNotification($invoice , $quiz , $delay);
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
        $now = Carbon::now()->timestamp;
        $countDown = $request->session()->get('countDown');
        $countDown = intval($countDown);
        // dd($countDown);
        $then = Carbon::now()->addMinutes($countDown)->timestamp;
        $total = $then - $now;
        $request->session()->forget('countDown');
        // $request->session()->forget('mytime');
        // $time = gmdate("H:i:s", $total); 
        // $request->session()->put('mytime',$total);   
        if(! $request->session()->has('mytime')){
            $request->session()->start();
            $request->session()->put('mytime',$total);
        }
        // dd($newvalue);
        // dd($request->has('page'));
        if(!$email->isEmpty() && !$name->isEmpty()){
            $myquiz = Quiz::findorFail($quiz);
            $myquiz->question = Question::where('quiz_id', $quiz)->get();
            foreach($myquiz->question as $question){
                $question->questionAnswer = QuestionsAnswer::where('question_id',$question->id)->get() ;
            }
            return view('quizzes.resolve',[
                'myquiz' => $myquiz,
                'user' => $user,
                'now' => $now,
                'then' => $then
            ]);
        }else{
            $validator = Validator::make($request->all(), $rules, $customMessages);
            $errors = $validator->errors()->add('email', 'Wrong information added in one of the fields !!');
            // dd($errors);
            return back()->withErrors($errors);
        }
    }

    public function update_session(Request $request)
    {
       $time = $request->newtime; 
       $request->session()->forget('mytime'); 
       $request->session()->put('mytime',$time);
       $setTime = $request->session()->get('mytime'); 
       return response()->json(['status' => true]);
    }

    public function submit_quiz(Request $request , $quiz ,$user)
    {
        // dd($quiz);
        $score = 0 ;
        $total = count($request->input('questions'));
        //  dd($request->input('questions'));
        foreach($request->input('questions',[]) as $key => $question){
            $status = 0;

            if($request->input('answers.'.$question) != null 
            && QuestionsAnswer::find($request->input('answers.'.$question))->is_correct ){
                $status = 1;
                $score++;
            }
            Result::create([
                'quiz_id' => $quiz ,
                'question_id' => $question ,
                'question_answer_id' => $request->input('answers.'.$question),
                'user_id' => $user,
                'is_correct' => $status ,
            ]);
        }

        StudentsScores::create([
            'quiz_id' => $quiz,
            'user_id' => $user,
            'score' => $score,
            'total' => $total,
        ]);
   
        return view('quizzes.finish');
    }

}
