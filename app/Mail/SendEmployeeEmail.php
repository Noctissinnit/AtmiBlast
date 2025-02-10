<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmployeeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $pdf;
    public $fromEmail;
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $pdf = null, $fromEmail = null, $fromName = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->pdf = $pdf;
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
        $email = $this->from($this->fromEmail, $this->fromName)
                      ->subject($this->subject)
                      ->view('emails.employee_email')
                      ->with(['body' => $this->body]);
    
        // Menambahkan attachment PDF jika ada dan dapat diakses
        if ($this->pdf) {
            $email->attach(storage_path('app/'.$this->pdf));
        }
    
        return $email;
    }
}
