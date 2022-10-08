<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
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
        return $this->from('test@ya.ru', 'Volodiya')
            ->to('test2@ya.ru')
            ->cc(['test3@ya.ru'])
            ->bcc(['test4@ya.ru'])
            ->subject('theme_mail')
            ->text('emails.first')
            ->with([
                'message2' => 'HI EVERYONE!!!',
                'mailMessage' => $this->mailMessage
            ]);
    }
}
