<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\User;
use App\Quiz;
use App\QuestionsAnswer;
use App\Question;

class Result extends Model
{
    use Notifiable,HasRoles;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_id', 'question_id', 'questions_answer_id','user_id','is_correct',
    ];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionAnswer()
    {
        return $this->belongsTo(QuestionsAnswer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
