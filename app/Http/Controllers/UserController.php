<?php

namespace App\Http\Controllers;

use App\Firestore\UserCollection;
use App\Models\User;
use App\Services\FirestoreDatabase;
use Auth0\Laravel\Facade\Auth0;
use Auth0\SDK\Utility\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserCollection $userCollection)
    {
        $userCollection->createUser('jrajora@truptman.in', [
            'id' => 'asdfa sdfasdf asdf ',
            'name' => 'jignesh rajora',
            'nickname' => 'jignesh',
            'email' => 'jrajora@truptman.in',
            'email_verified' => true,
            'picture' => null,
            'updated_at' => now(),
            'last_login_at' => now(),
        ]);

        dd('user created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(FirestoreDatabase $db, UserCollection $user)
    {
        $suresh = $user->findOrFail('suresh@example.com');

        dd($suresh);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (! Auth::check()) {
            dd('you are not logged in');
        }

        $user = auth()->user();
        $auth_id = auth()->id();

        $user = Auth0::management()->users()->get($auth_id);

        // info('user info', [
        //     'user ' => $user,
        // ]);

        $userInfo = json_decode($user->getBody());
        // dd($userInfo);

        // dd(json_decode($user->getBody()));

        // dd(HttpResponse::decodeContent($user));

        return view('profile', ['user' => $userInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCollection $userModel) {
        // validate the request
        $validated = $request->validate([
            'name' => 'required|max:125',
            'email' => 'email|required|string|max:255',
            'nickname' => 'required|string|max:255'
        ]);



        //update the data on auth0 side
        $user = Auth0::management()->users()->update(auth()->id(), $validated,config('services.auth0.client_id'));

        $userData = json_decode($user->getBody());
        
        info('update user',[
            'user' => $userData,
        ]);

        // update the data on firestore side.
        $userModel->updateUser($userData->email,[
            'name' => $userData->name,
            'email'=> $userData->email,
            'nickname' => $userData->nickname,
        ]);

        return redirect(route('profile'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
