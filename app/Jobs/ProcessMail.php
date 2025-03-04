<?php

namespace App\Jobs;

use App\Models\MailConfig;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $emails;
    private array $senders;
    private Mailable $mailable;
    /**
     * Create a new job instance.
     */
    public function __construct(
        array $emails,
        array $senders,
        Mailable $mailable
    ) {
        $this->emails = $emails;
        $this->senders = $senders;
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        setMailConfigs();
        foreach (splitEmails($this->emails, count($this->senders)) as $i => $sendEmails) {
            foreach ($sendEmails as $email) {
                if($email === null) continue;
                Mail::mailer($this->senders[$i])->to($email)->send($this->mailable);
            }
        }
    }
}


function setMailConfigs()
{
    $configs = MailConfig::all();
    config()->set('mail.mailers.smtp', [
        'transport' => 'smtp',
        'url' => env('MAIL_URL'),
        'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
        'port' => env('MAIL_PORT', 587),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => $configs[0]->email,
        'password' => $configs[0]->password ?? env('MAIL_PASSWORD'),
        'timeout' => null,
        'local_domain' => env('MAIL_EHLO_DOMAIN'),
    ]);

    foreach ($configs as $config) {
        $username = $config->email;
        $password = $config->password;
        config()->set("mail.mailers." . $config->id, [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => $username,
            'password' => $password ?? env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ]);
    }
}


function splitEmails(array $array, int $senderCount)
{
    $length = count($array);
    $baseSize = (int) ($length / $senderCount);
    $remainder = $length % $senderCount;

    $sizes = [];
    for ($i = 0; $i < $senderCount; $i++) {
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