<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\SendMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $user = User::find($event->userId)->toArray();

        dd($user);

        Mail::send('eventMail', $user, function($message) use($user){
            $message->to($user['email']);
            $message->subject('Event Testing');
        });
    }
}
