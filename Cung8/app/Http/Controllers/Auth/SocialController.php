<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;
use App\User;
use Auth;
use App\Social;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user->getAvatar());
        $social = User::where('email', $user->getEmail())->first();
        if($social)
        {
        	Auth::login($social);
        	return redirect('home');
        }
        else
        {
        	$temp = new User;
        	$temp->name = $user->getName();
        	$temp->email = $user->getEmail();
        	$temp->level = 0;
        	$temp->avatar = $user->getAvatar();
        	$temp->save();

        	Auth::login($temp);
        	return redirect('home');
        }
    }
}
