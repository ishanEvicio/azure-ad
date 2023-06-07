<?php

namespace Ishanevicio\AzureSocialite;

use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToOauthProvider()
    {
        return Socialite::driver('azure-oauth')->redirect();
    }

    public function handleOauthResponse()
    {
        $user = Socialite::driver('azure-oauth')->user();

        $authUser = $this->findOrCreateUser($user);
        if(!$authUser){
           return redirect('/login')->with('error', 'Invalid user, Please try again!');
        }

        auth()->login($authUser, true);

        session([
            'azure_access_token' => $user->token,
            'user_email_address' => $user->email
        ]);

        return redirect(
            config('azure-oath.redirect_on_login')
        );
    }

    protected function findOrCreateUser($user)
    {
        $user_class = config('azure-oath.user_class');
        $authUser = $user_class::where(config('azure-oath.user_email_address'), $user->email)->first();

        if ($authUser) {
            return $authUser;
        }


        return false;
    }
}