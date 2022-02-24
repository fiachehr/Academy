<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{

    /**
     * Display Signup Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        return view('authentication.signup');
    }

    /**
     * Register User.
     *
     */
    public function register(AuthRegisterRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = '0';
        $input['ts_register'] = Carbon::now()->timestamp;
        User::create($input);
        return redirect()->route('authentication.index')->with('signup', 'Your account has been created. Please wait for confirmation');
    }

    /**
     * Display Login Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('authentication.login');
    }

    /**
     * login User.
     *
     */
    public function login(LoginRequest $request)
    {
        $input = $request->all();
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password'], 'is_active' => '1'])) {
            return redirect()->route('panel.dashboard');
        }
        return redirect()->back()->with('invalid', 'Username or password is wrong or your account is deactivated');
    }

    /*
     * Sign Up And Login With GoogleAccount
     */
    public function loginByGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /*
     * Callback Sign Up With GoogleAccount
     * @return Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $isRegistered = User::where("email", $data['email'])->first();
        if ($isRegistered) {
            if (!$isRegistered->is_active) {
                return redirect()->route('authentication.index')->with('deactivated', 'Your account is deactivated');
            }
            Auth::login($isRegistered);
            return redirect()->route('panel.dashboard');
        }
        $data['password'] = "12345678";
        $data['is_active'] = '0';
        $data['ts_register'] = Carbon::now()->timestamp;
        User::create($data);
        return redirect()->route('authentication.index')->with('signup', 'Your account has been created. Please wait for confirmation');
    }

    /**
     * Display Profile Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('authentication.profile');
    }

    /**
     * Change Profile.
     *
     */
    public function editProfile(ProfileRequest $request)
    {
        User::find(Auth::user()->id)->update($request->all() + ['ts_update' => Carbon::now()->timestamp]);
        return redirect()->route('authentication.index')->with('change-profile', 'Your profile data have been changed');
    }

    /**
     * Display Change Password Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('authentication.changePassword');
    }

    /**
     * Change Password Action.
     *
     */
    public function changePasswordAction(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('last_password'), Auth::user()->password))) {
            return redirect()->back()->with("wrong-password", "Your current password does not matches with the password.");
        }

        User::find(Auth::user()->id)->update(['password' => $request->get('password'), 'ts_update' => Carbon::now()->timestamp]);
        return redirect()->route('authentication.index')->with('change-profile', 'Your current password has been changed');
    }

    /**
     * Logout.
     *
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('authentication.index');
    }
}
