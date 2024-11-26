<?php

namespace App\Listeners;

use App\Firestore\UserCollection;

final class LogSuccessfullLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private UserCollection $model)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $this->model->findOrFail($event->user->email);

        if (! $user) {
            $this->model->createUser($event->user->email, [
                'id' => $event->user->sid,
                'nickname' => $event->user->nickname,
                'name' => $event->user->name,
                'email' => $event->user->email,
                'picture' => $event->user->picture,
                'email_verified' => $event->user->email_verified,
                'last_login_at' => now(),
                'updated_at' => $event->user->updated_at,
            ]);
            return;
        }

        $this->model->updateUser($event->user->email,[
            'last_login_at' => now()
        ]);
    }
}
