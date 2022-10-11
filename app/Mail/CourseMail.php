<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailMessage;

    /**
     *
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailMessage)
    {
        $this->mailMessage = $mailMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('u.nedbaila@gmail.com', 'U.Nedbaila')
            ->to('catcher_courses@ya.ru')
            ->subject('Exchange rate')
            ->text('emails.course');
    }
}
