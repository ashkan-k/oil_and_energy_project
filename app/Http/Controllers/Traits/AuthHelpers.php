<?php


namespace App\Http\Controllers\Traits;


use App\Models\Code;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

trait AuthHelpers
{
    private $login_validators = [
        'phone' => 'numeric|exists:users',
        'password' => 'required',
    ];

    private $register_validators = [
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'required|confirmed',
        'phone' => 'unique:users|max:11|min:11',
    ];

    private $reset_password_mobible_validators = [
        'phone' => 'numeric|exists:users',
    ];

    private $reset_password_enter_validators = [
        'password' => 'required|confirmed',
    ];

    private $verify_validators = [
        'code' => 'required|numeric'
    ];

    private $profile_validators = [
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'confirmed',
    ];

    //////////////////////////////////////////////////////////////////////////////////////

    private function verify_code($code)
    {
        $code_obj = Code::where('code', $code)->first();
        if ($code_obj && !$code_obj->is_used)
        {
            return true;
        }
        throw ValidationException::withMessages(['code' => 'کد وارد شده نامعتبر است!']);
    }

    public function SendCode($user)
    {
        $code = $this->CreateNewCode($user);
        $user->notify(new SendSmsNotification($code));
    }

    private function check_code_sent($user)
    {
        $code = $user->codes()->latest()->first();
        if ($code)
        {
            $diff_minutes = Carbon::parse($code->created_at)->diffInMinutes(Carbon::now());
            if ($diff_minutes < 1)
            {
                return false;
            }
        }
        return true;
    }

    private function change_is_used($user)
    {
        $user->codes()->where('is_used' , false)->update(['is_used' => true]);
    }

    private function CreateNewCode($user)
    {
        if (!$this->check_code_sent($user)) {
            throw ValidationException::withMessages(['code' => 'کد یکبار مصرف ورود برای شما ارسال شده است ، پس از گذشت 1 دقیقه میتوانید دوباره درخواست کنید!']);
        }

        $user->codes()->update(['is_used' =>  true]);

        $code = Code::create([
            'user_id' => $user->id
        ]);
        return $code;
    }

    private function set_helper_sessions($user , $remember_me)
    {
        $this->remove_helper_sessions();
        session()->put('remember_me', $remember_me);
        session()->put('login_phone', $user->phone);
    }

    private function remove_helper_sessions()
    {
        session()->remove('login_phone');
        session()->remove('remember_me');
    }
}
