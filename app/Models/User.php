<?php

namespace App\Models;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
//        'email',
        'phone',
        'phone_verified_at',
        'is_superuser',
//        'is_blocked',
        'password',
//        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('phone_verified_at' , '!=' , null);
        }
        if ($search){
            $query->where('first_name' , 'like' , '%' . $search . '%')
                ->OrWhere('last_name' , 'like' , '%' . $search . '%')
                ->OrWhere('phone' , 'like' , '%' . $search . '%');
        }
        return $query;
    }

    public function getCreatedAtAttribute($dates){
        return Verta::instance($dates)->format('H:i %B %d, %Y ');
    }

    public function getUpdatedAtAttribute($dates){
        return Verta::instance($dates)->format('H:i %B %d, %Y ');
    }

    public function get_avatar()
    {
        return $this->avatar ?: '/admin/user.jpg';
    }

    public function get_verified_status()
    {
        return $this->phone_verified_at ? 'فعال' : 'غیرفعال';
    }

    public function is_superuser()
    {
        return $this->is_superuser ? 'مدیر' : 'کاربر';
    }

    public function full_name()
    {
        if ($this->first_name && $this->last_name)
        {
            return $this->first_name . " " . $this->last_name;
        }
        return $this->phone;
    }

    public function get_subscription()
    {
        return $this->is_superuser || $this->payments()->where([
            ['refID', '!=', null],
            ['status', '=', true],
        ])->first();
    }

    #############################################################################
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
