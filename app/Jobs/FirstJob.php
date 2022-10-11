<?php

namespace App\Jobs;

use App\Mail\FirstMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class FirstJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    //public $queue = 'myEmails';

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $tries =5; //количество попыток доставки

    public $emailMessage;

    public function __construct($emailMessage)
    {
        $this->queue = 'myEmails';
        $this->emailMessage = $emailMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new FirstMail($this->emailMessage);
        Mail::send($mail);
    }
}
