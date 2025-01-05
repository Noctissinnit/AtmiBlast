<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmployeeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $pdfPath;
    public $fromEmail;
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $pdfPath = null, $fromEmail = null, $fromName = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->pdfPath = $pdfPath;
        $this->fromEmail = $fromEmail ?? config('mail.from.address');
        $this->fromName = $fromName ?? config('mail.from.name');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mulai dengan mendefinisikan subjek dan view email
        $email = $this->from($this->fromEmail, $this->fromName)
                      ->subject($this->subject)
                      ->view('emails.employee_email')
                      ->with(['body' => $this->body]);

        if ($this->pdfPath) {
            $email->attach($this->pdfPath);
        }

        return $email;
    }

}
