<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;



final class LogSuccessfullLogin
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
    public function handle(Login $event)
    {
        $firestore = app();
        $usersRef = $firestore->database()->collection('users')->document($event->user->sid);

        $allUsers = $firestore->database()->collection('users')->documents();

        info('users with ' . $event->user->email,[
            'data' => $usersRef,
        ]);

        $usersRef->set([
            'name' => 'laraval',
        ],['merge' => true]);

        // Convert Firestore documents to an array
        $users = [];
        foreach ($allUsers as $document) {
            $users[$document->id()] = $document->data();
        }

        info('user data', [
            'data' => $users
        ]);
        
        info('auth0 login listner');
    }
}
