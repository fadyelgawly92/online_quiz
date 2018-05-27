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

class QuestionsAnswerController extends Controller
{
    public function index()
    {
        $questions_answers = QuestionsAnswer::all();
        return view('questions_answers.index', compact('questions_answers'));
    }

    public function create()
    {
        
    }

    public function store()
    {

    }
}
