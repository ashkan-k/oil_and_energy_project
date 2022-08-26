<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Base
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public static function InitSettings()
    {
        $settings['LOGO'] = parent::firstOrCreate(['key' => 'LOGO'], [
            'key' => 'LOGO',
            'value' => 'logo.jpeg'
        ]);

        $settings['COPY_RIGHT'] = parent::firstOrCreate(['key' => 'COPY_RIGHT'], [
            'key' => 'COPY_RIGHT',
            'value' => 'تمام حقوق مادی و معنوی این سایت متعلق است به <a
                href="http://iroilmarket.com/">iroilmarket</a>&nbsp;است.'
        ]);

        $settings['PAYMENT_DESCRIPTION'] = parent::firstOrCreate(['key' => 'PAYMENT_DESCRIPTION'], [
            'key' => 'PAYMENT_DESCRIPTION',
            'value' => 'خرید اشتراک ویژه سایت iroilmarket'
        ]);

        $settings['PAYMENT_AMOUNT'] = parent::firstOrCreate(['key' => 'PAYMENT_AMOUNT'], [
            'key' => 'PAYMENT_AMOUNT',
            'value' => 399000
        ]);

        if (!str_contains(request()->url(),'/panel')){
            $settings['EMAIL'] = parent::firstOrCreate(['key' => 'EMAIL'], [
                'key' => 'EMAIL',
                'value' => 'as@gmail.com'
            ]);

            $settings['MOBILE'] = parent::firstOrCreate(['key' => 'MOBILE'], [
                'key' => 'MOBILE',
                'value' => '09120194131'
            ]);

            $settings['INSTAGRAM_ACCOUNT'] = parent::firstOrCreate(['key' => 'INSTAGRAM_ACCOUNT'], [
                'key' => 'INSTAGRAM_ACCOUNT',
                'value' => 'iroilmarket'
            ]);

            $settings['TWITTER_ACCOUNT'] = parent::firstOrCreate(['key' => 'TWITTER_ACCOUNT'], [
                'key' => 'TWITTER_ACCOUNT',
                'value' => 'https://twitter.com/account/login_challenge?platform=web&enc_user_id=AAAAEIC-njFAzF9mB4mjtUBHyD8GOfsRHBqm1S39nZzDiyLrNO8ncY7qcmoIi00&challenge_type=TemporaryPassword&challenge_id=btOW6UIACO49gMvAK7zbwdDjgpYEmblXMwylan&remember_me=true&redirect_after_login_verification=%2Firoilmarket'
            ]);

            $settings['FACEBOOK_ACCOUNT'] = parent::firstOrCreate(['key' => 'FACEBOOK_ACCOUNT'], [
                'key' => 'FACEBOOK_ACCOUNT',
                'value' => 'Iroilmarket-101050488747700'
            ]);

            $settings['CONTACT_US_MAIL'] = parent::firstOrCreate(['key' => 'CONTACT_US_MAIL'], [
                'key' => 'CONTACT_US_MAIL',
                'value' => 'iroilmarket2@gmail.com'
            ]);

            $settings['PHONE_NUMBER'] = parent::firstOrCreate(['key' => 'PHONE_NUMBER'], [
                'key' => 'PHONE_NUMBER',
                'value' => '021-1111111'
            ]);
        }

        return $settings;
    }

    #######################################################################

    public function scopeFilter($query, $search, $filter)
    {
        if ($filter) {
            $query = $query->where('status', $filter == 'success' ? 1 : 0);
        }
        if ($search) {
            $query->where('key', 'like', '%' . $search . '%')
                ->OrWhere('value', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
