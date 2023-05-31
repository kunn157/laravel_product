<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Mail;
use App\Mail\SendMail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::select('email','birthday')
        ->whereMonth('birthday','=' , date('m'))
        ->whereDay('birthday','=' , date('d'))->get();
        $view = 'admin.Mails.sendmailbirthday';
        foreach ($users as $user){
            $email=$user->email;
            $mails=[
                'view' => $view,
                'user' => $user,
            ];
            Mail::to($email)->send(new SendMail($mails));
        }
    }
}
