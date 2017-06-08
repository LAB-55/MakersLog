<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/log/new/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        
        $parts = explode("@", $user->email);
        $g_username = $parts[0];
        //dd($g_username);
        return User::create([
            'first_name' => $user->user['name']['givenName'],
            'last_name' => $user->user['name']['familyName'],
            'email'    => $user->email,
            'g_username' => $g_username,
            'nickname'   => isset($user->nickname) ? $user->nickname: "Not Specified",
            'bio'   => isset($user->tagline) ? $user->tagline: "Not Specified",
            'avatar'   => isset($user->avatar) ? str_replace('sz=50', 'sz=100', $user->avatar): "Not Specified",
            'website'   => isset($user->website) ? $user->website: "Not Specified",
            'gender'   => isset($user->gender) ? $user->gender: "Not Specified",
            'birthday'   => isset($user->birthday) ? $user->birthday: "Not Specified",
            'mobile_number'   => isset($user->mobile_number) ? $user->mobile_number: "Not Specified",
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
