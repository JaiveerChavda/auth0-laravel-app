<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth0\Laravel\Events\AuthenticationSucceeded;

class LogSuccessfullSignup
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
     * @param  object  $event
     * @return void
     */
    public function handle(AuthenticationSucceeded $event)
    {
        // create firestore object
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        //create the user in the firestore database

        info('auth0 signup listner');

        // create new user document(record) in users collection 
        // $user = $database->collection('users')->newDocument();
        // $user->set([
        //     'id' => $event->user->sid,
        //     'nickname' => $event->user->nickname,
        //     'name' => $event->user->name,
        //     'email'=> $event->user->email,
        //     'picture' => $event->user->picture,
        //     'email_verified' => $event->user->email_verified,
        //     'last_login_at' => now(),
        //     'updated_at' => $event->user->updated_at
        // ]);

    }
}
