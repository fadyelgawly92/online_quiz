<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\MailQuiz;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendEmailNotification($invoice)
    {
        // dd($invoice->user->id);
        $this->notify(new MailQuiz($invoice->user));
    }

    public function routeNotificationForMail($notification)
    {
        // dd($this->email);
        return $this->email;
    }
}
