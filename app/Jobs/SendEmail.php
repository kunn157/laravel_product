<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SendMail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The mails instance.
     *
     * @var array $mails
     */
    protected $mails;
    /**
     * Create a new job instance.
     *
     * @param array $mails
     * @return void
     */
    public function __construct(array $mails)
    {
        $this->mails = $mails;
        $this->queue = 'email';
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendMail($this->mails);
        Mail::to($this->mails['user']->email)->send($email);

    }

}
