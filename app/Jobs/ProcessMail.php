<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $emails;
    private Mailable $mailable;
    /**
     * Create a new job instance.
     */
    public function __construct(
        array $emails,
        Mailable $mailable
    ) {
        $this->emails = $emails;
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (splitEmails($this->emails) as $i => $sendEmails) {
            foreach ($sendEmails as $email) {
                if($email === null) continue;
                Mail::mailer("$i")->to($email)->send($this->mailable);
            }
        }
    }
}

function splitEmails(array $array)
{
    $length = count($array);
    $baseSize = (int) ($length / 5);
    $remainder = $length % 5;

    $sizes = [];
    for ($i = 0; $i < 5; $i++) {
        $sizes[] = $i < $remainder ? $baseSize + 1 : $baseSize;
    }

    $result = [];
    $start = 0;
    foreach ($sizes as $size) {
        $result[] = array_slice($array, $start, $size);
        $start += $size;
    }

    return $result;
}
