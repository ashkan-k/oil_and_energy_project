<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthHelpers;
use App\Http\Controllers\Traits\Responses;
use App\Models\Code;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use AuthHelpers, Responses;

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['logout' , 'profile']]);
        $this->middleware('guest', ['except' => ['logout' , 'profile']]);
//        if (\request()->route()->uri() == 'profile')
//        {
//            parent::__construct();
//        }
    }

    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->login_validators);
            $data = $request->only(['phone', 'password']);
            $remember_me = $request->has('remember_me');

            if (!auth()->validate($data)) {
                throw ValidationException::withMessages(['phone' => 'شماره موبایل / رمز عبور اشتباه است!']);
            }

            $user = User::wherePhone($data['phone'])->first();

            if ($user->phone_verified_at) {
                auth()->login($user, $remember_me);
                return $this->SuccessRedirect(null, 'dashboard');
            } else {
                $this->SendCode($user);
                $this->set_helper_sessions($user, $remember_me);

                return $this->SuccessRedirect(null, 'verify', ['حساب کابری شما احراز هویت نشده است. یک پیامک حاوی کد احراز هویت به شماره تلفن شما ارسال شده است.']);
            }
        }
        return view('Auth.login');
    }

    public function register(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->register_validators);
            $data = $request->all();

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            $this->SendCode($user);
            $this->set_helper_sessions($user, true);

            return $this->SuccessRedirect(null, 'verify', ['یک پیامک حاوی کد احراز هویت به شماره تلفن شما ارسال شده است.']);
        }
        return view('Auth.register');
    }

    public function verify(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->verify_validators);

            $this->verify_code($request->code);
            $phone = session()->get('login_phone', null);
            $rememberMe = session()->get('remember_me', false);

            $user = User::wherePhone($phone)->firstOrFail();
            $user->update(['phone_verified_at' => Carbon::now()]);

            auth()->login($user, $rememberMe);
            $this->change_is_used($user);
            $this->remove_helper_sessions();

            return $this->SuccessRedirect(null, 'dashboard');
        }
        return view('Auth.verify');
    }

    public function profile(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->profile_validators);
            $request['password'] = $request->password ? Hash::make($request->password) : auth()->user()->password;
            auth()->user()->update($request->only(['first_name' , 'last_name' , 'password']));

            return $this->SuccessRedirect("پروفایل کابری شما با موفقیت ویرایش شد.", 'profile');
        }
        $user = auth()->user();
        return view('Auth.profile' , compact('user'));
    }

    public function logout()
    {
        auth()->logout();
        return $this->SuccessRedirect(null, 'login');
    }

    #########################################################################

    public function send_code_ajax()
    {
        $phone = session()->get('login_phone', null);
        $user = User::wherePhone($phone)->firstOrFail();

        $this->SendCode($user);
        return $this->ApiSuccessResponse(['message' => 'کد جدید ارسال شد.']);
    }

    #########################################################################
    ## Reset Password ##
    public function reset_password_mobile(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->reset_password_mobible_validators);
            $data = $request->all();

            $user = User::wherePhone($data['phone'])->first();
            $this->SendCode($user);

            return $this->SuccessRedirect('پیامک حاوی کد احراز هویت برای شما ارسال شد.', 'reset_password.confirm');
        }
        return view('Auth.reset_password.reset_password_mobile');
    }

    public function reset_password_confirm(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->verify_validators);

            $this->verify_code($request->code);

            $user = Code::whereCode($request->code)->first()->user;
            session()->put('reset_password_code', $request->code);
            $this->change_is_used($user);

            return $this->SuccessRedirect('رمز عبور جدید خود را وارد کنید.', 'reset_password.enter');
        }
        return view('Auth.reset_password.reset_password_confirm');
    }

    public function reset_password_enter(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, $this->reset_password_enter_validators);

            if (session('reset_password_code')) {
                $code = session('reset_password_code');
                session()->remove('reset_password_code');
                $user = Code::whereCode($code)->first()->user;
                $user->update(['password' => Hash::make($request->password)]);

                return $this->SuccessRedirect('تغییر رمز عبور شما با موفقیت انجام شد . اکنون میتوانید وارد شوید.', 'login');
            }

            throw ValidationException::withMessages(['code' => 'زمان بازیابی رمز عبور منقضی شده است! ، دوباره درخواست کنید']);
        }
        return view('Auth.reset_password.reset_password_enter');
    }
}
