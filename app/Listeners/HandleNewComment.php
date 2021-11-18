<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleNewComment
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
     * @param  \App\Events\CommentPosted  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        // Envoyer un email à l'admin avec le comment $event->comment;
        Mail::to('admin@monsite.com')
            ->send(new \App\Mail\CommentPosted($event->comment));

    }
}
