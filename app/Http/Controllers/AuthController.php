<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use Socialite;

use Carbon\Carbon;

use App\Models\User;

class AuthController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function intended_view()
    {
        if (Auth::check()) {
            $role = Auth::user()->getRoleNames()[0];
            if ($role  == 'USER') {
                return redirect()->route('user.dashboard');
            }
            if ($role  == 'INSTRUCTOR') {
                return redirect()->route('instructor.dashboard');
            }
            if ($role  == 'ADMIN' || $role  == 'SUPER_ADMIN') {
                return redirect()->route('admin.dashboard');
            }
        }

        Auth::logout();
        Session()->invalidate();
        Session()->regenerateToken();
        return redirect()->route('login');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function verification()
    {
        return view('auth.verification');
    }

    public function forget_password()
    {
        return view('auth.forget_password');
    }

    public function login_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' =>  'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }

            $credentials = request(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['status' => 0, 'msg' => 'Invalid credentials']);
            }

            return response()->json(['status' => 1, 'msg' => 'Login Successfull']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function register_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'email' =>  'required|email|unique:users|max:255',
                'phone' =>  'required|unique:users',
                'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/|',
            ],[
              'password.regex' => 'password must contain one special character and one capital letter'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                $user->assignRole('USER');
                $user->sendEmailVerificationNotification();
                $credentials = request(['email', 'password']);
                Auth::attempt($credentials);
                return response()->json(['status' => 1, 'msg' => 'Registration Successful.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'An error occured']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }

    public function verify_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }
            $user = User::find(Auth()->id());
            if (!$user) {
                return response()->json(['status' => 0, 'msg' => 'An error occured, Try again']);
            }
            $from = Carbon::parse($user->updated_at);
            $diff_in_minutes = Carbon::now()->diffInMinutes($from);
            if ($diff_in_minutes > 10) {
                return response()->json(['status' => 0, 'msg' => 'Token Expired']);
            }
            if (Hash::check($request->token, $user->remember_token)) {
                $user->email_verified_at = Carbon::now();
                $user->remember_token = Null;
                if ($user->save()) {
                    $user->sendEmailWelcomeNotification();
                    return response()->json(['status' => 1, 'msg' => 'Email Verification Successful.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'An error occured']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Invalid Token']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function resend_verification(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' =>  'required|email'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['status' => 0, 'msg' => 'An error occured, Try again']);
            }
            $user->sendEmailVerificationNotification();
            return response()->json(['status' => 1, 'msg' => 'Email request verification token re-sent to ' . $user->email]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function forget_password_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' =>  'required|email'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['status' => 0, 'msg' => 'An error occured, Try again']);
            }
            $user->sendEmailForgetPasswordNotification();
            return response()->json(['status' => 1, 'msg' => 'Verification Token sent to ' . $user->email]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function reset_password_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' =>  'required|email',
                'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['status' => 0, 'msg' => 'An error occured, Try again']);
            }
            $from = Carbon::parse($user->updated_at);
            $diff_in_minutes = Carbon::now()->diffInMinutes($from);
            if ($diff_in_minutes > 10) {
                return response()->json(['status' => 0, 'msg' => 'Token Expired']);
            }
            if (Hash::check($request->token, $user->remember_token)) {
                $user->password = Hash::make($request->password);
                $user->remember_token = Null;
                if ($user->save()) {
                    return response()->json(['status' => 1, 'msg' => 'Password reset Successful. Please login']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'An error occured']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Invalid Token']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()], 500);
        }
    }


    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        if (!$userSocial->getEmail()) {
            return redirect()->route('login')->with(['error' => 'No valid email found']);
        }
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('intended_view');
        } else {
            $name = explode(' ', $userSocial->name);
            $user = new User;
            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $user->email = $userSocial->email;
            // $user->google_id = $userSocial->id;
            $user->email_verified_at = Carbon::now();
            $user->password = Hash::make(rand(1, 10000));
            $user->save();
            $user->assignRole('USER');
            // $user->sendEmailWelcomeNotification();
            Auth::login($user);
            return redirect()->route('intended_view');
            // return view('auth.register', ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session()->invalidate();
        Session()->regenerateToken();
        return redirect()->route('login');
    }
}
