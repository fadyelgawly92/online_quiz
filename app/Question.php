<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Quiz;
use App\QuestionsAnswer;

class Question extends Model
{
    use Notifiable,HasRoles;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'quiz_id',
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

    public function questionAnswer()
    {
        return $this->hasMany(QuestionsAnswer::class);
    }

}
