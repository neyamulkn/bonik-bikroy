<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class MessageEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $msg)
    {
        $this->subject = $subject;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject .' | '. Config::get('siteSetting.site_name'))->view('emails.message')->with('msg', $this->msg);

    }
}
