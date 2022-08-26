<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

class Code extends Base
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'is_used'
    ];

    public function generateCode($codeLength = 6)
    {
        $max = pow(10, $codeLength);
        $min = $max / 10 - 1;
        $code = mt_rand($min, $max);
        return $code;
    }

    public function __construct(array $attributes = [])
    {
        if (!isset($attributes['code'])) {
            $attributes['code'] = $this->generateCode();
        }
        parent::__construct($attributes);
    }

    public function send_code()
    {
        if (!$this->user) {
            throw new \Exception("No user attached to this token.");
        }
        if (!$this->code) {
            $this->code = $this->generateCode();
        }

        try {
            $message = "سلام\n\nکاربر گرامی کد یکبار مصرف ورود شما {$this->code} می باشد.\n\nhttp://price.iroilmarket.com/";

            $data = [
                'username' => config('iroilmarket.SMS_USERNAME'),
                'password' => config('iroilmarket.SMS_PASSWORD'),
                'to' => $this->user->phone,
                'from' => config('iroilmarket.SMS_FROM_NUMBER'),
                'text' => $message,
            ];

            $response = Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', $data)->json();

            if ($response['RetStatus'] == 1) {
                return True;
            } else {
                return False;
            }


        } catch (\Exception $ex) {
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
