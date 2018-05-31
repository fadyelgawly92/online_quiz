<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', function () {
    return view('admin_template');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//all about user
Route::get('users/from' , 'UserController@create')->name('users.form');
Route::post('users/create' , 'UserController@store')->name('users.create');


Route::get('users/show','UserController@get_data')->name('users.index.dataTables');
Route::get('users/show/approved','UserController@get_data_approved')->name('users.approvedIndex.dataTables');

Route::get('users/index','UserController@index')->name('users.index');
Route::get('users/approved','UserController@approvedIndex')->name('users.approved');

Route::get('users/{id}/edit','UserController@edit')->name('users.edit');
Route::get('users/{id}/delete','UserController@delete')->name('users.delete');
//end users

//all about quizzes
Route::get('quiz/form', 'QuizController@create')->name('quiz.form');
Route::post('quiz/create', 'QuizController@store')->name('quiz.create');
Route::get('quiz/index', 'QuizController@index')->name('quiz.index');
Route::get('quiz/{id}/show', 'QuizController@show')->name('quiz.show');
Route::post('quiz/send','QuizController@send_quiz')->name('quiz.send');
//end quizzes

//all about questions
Route::get('question/form', 'QuestionController@create')->name('question.form');
Route::post('question/create', 'QuestionController@store')->name('question.create');
Route::get('question/index', 'QuestionController@index')->name('question.index');
Route::delete('question/{id}/delete', 'QuestionController@delete')->name('question.destroy');
//end questions

//all about question answer
Route::get('questionAnswer/form', 'QuestionsAnswerController@create')->name('questions_answer.form');
Route::post('answer/create','QuestionsAnswerController@store')->name('answer.create');


// Route::post('questionAnswer/create', 'QuestionsAnswerController@store')->name('questions_answer.create');
Route::get('questionAnswer/index', 'QuestionsAnswerController@index')->name('questions_answer.index');
Route::get('questionAnswer/{id}/show', 'QuestionsAnswerController@show')->name('questions_answer.show');
Route::get('questionAnswer/{id}/edit', 'QuestionsAnswerController@edit')->name('questions_answer.edit');
Route::delete('questionAnswer/{id}/delete', 'QuestionsAnswerController@destory')->name('questions_answer.delete');
//
