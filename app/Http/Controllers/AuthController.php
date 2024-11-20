<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth0\Laravel\Facade\Auth0;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function callback(Request $request)
    {
        // Exchange the authorization code for tokens and user information 
        $userInfo = Auth0::getUser();
        if ($userInfo) { 
            info('user info',[
                'user' => $userInfo,
            ]);
            // Create or update the user in your database 
            $user = $this->createOrGetUser($userInfo); 
            // Log the user in 
            Auth::login($user); 
            // Redirect to the intended page or dashboard 
            return redirect()->intended('/'); 
        } // If user info is not present, redirect to login 
        
        return redirect('/')->with('error', 'Unable to authenticate user.');
    }

    protected function createOrGetUser($userInfo) { 
        // Logic to find or create a user in your database 
        // based on the information from Auth0 
        $user = User::firstOrCreate( 
        ['email' => $userInfo['email']], // 'sub' is the Auth0 user ID 
        [ 
            'name' => $userInfo['name'] ?? 'unknown', 
            'email' => $userInfo['email'] ?? 'unknown', 
            'password' => $userInfo['password'] ?? 'password'
            // Add any other fields you need 
        ] ); 

        return $user; 
    }
}


