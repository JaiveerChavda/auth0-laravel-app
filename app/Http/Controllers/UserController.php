<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth0\Laravel\Facade\Auth0;
use Auth0\SDK\Utility\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $firestoreDB;

    public function __contruct(){
        $this->$firestoreDB = app('firebase.firestore')->database();
    }
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
    public function create()
    {
        // dd('on create method');
        $user = app('firebase.firestore')->database()->collection('users')->newDocument();
        $user->set([
            'name' => 'john',
            'email' => 'johndeo@example.in',
            // 'last_login_at' => now(),
        ]);
     
        dd('user created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(!Auth::check()){
            dd('you are not logged in');
        }

        $user = auth()->user();
        $auth_id = auth()->id();

        $user = Auth0::management()->users()->get($auth_id);

        info('user info',[
            'user ' => $user
        ]);

        dd(json_decode($user->getBody()));

        dd(HttpResponse::decodeContent($user));

        return view('profile', ['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
