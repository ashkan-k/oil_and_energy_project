<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Base
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'status', 'refID'];

    public function scopeFilter($query, $search, $filter)
    {
        if ($filter) {
            $query = $query->where('status', $filter == 'success' ? 1 : 0);
        }
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                return $q->where('first_name', 'like', '%' . $search . '%')
                    ->OrWhere('last_name', 'like', '%' . $search . '%')
                    ->OrWhere('phone', 'like', '%' . $search . '%');
            })->OrWhere('refID', 'like', '%' . $search . '%');
        }
        return $query;
    }

    #############################################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
