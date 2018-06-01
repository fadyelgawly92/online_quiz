<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class MailQuiz extends Notification implements ShouldQueue
{
    use Queueable;

    public $user ;
    public $quiz ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user , $quiz)
    {
        $this->user = $user;
        $this->quiz = $quiz;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->quiz);
        $url = url('/mail/'.$this->user->id.'/quiz/'.$this->quiz);

        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('This is the link for your online exam.')
                    ->action('Press Here', $url)
                    ->line('Thank you for joining us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
