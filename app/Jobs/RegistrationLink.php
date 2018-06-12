<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegistrationLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    // public $invoice ;
    // public $quiz ;

    public function __construct()
    {
        // $this->invoice = $invoice;
        // $this->quiz = $quiz;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->invoice->user);
        // Mail::queue('emails.send', ['user'=> $this->invoice->user ,'quiz' => $this->quiz ], function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->to($this->invoice->user->email, $this->invoice->user->name);
        //     $message->subject('Subject');
        // });
    }
}
