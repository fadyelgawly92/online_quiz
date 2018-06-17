<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\MailQuiz;
use App\Quiz;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendEmailNotification($invoice , $quiz , $delay)
    {
        // dd($invoice->user->id);
        // dd($quiz);
        $when = now()->addSeconds($delay);
        $this->notify((new MailQuiz($invoice->user , $quiz))->delay($when));
    }

    public function routeNotificationForMail($notification)
    {
        // dd($this->email);
        return $this->email;
    }

}
