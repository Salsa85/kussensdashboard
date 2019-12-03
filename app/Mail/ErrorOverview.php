<?php

namespace App\Mail;
use App\Error;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ErrorOverview extends Mailable
{
    use Queueable, SerializesModels;
    public $errors;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email')->with('errors', $this->errors);
    }
}
