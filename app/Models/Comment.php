<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Base
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'status', 'text', 'post_id'];

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $filter = $filter == 'approved' ? 1 : 0;
            $query = $query->where('status' , $filter);
        }
        if ($search){
            $query->where('name' , 'like' , '%' . $search . '%')
                ->OrWhere('email' , 'like' , '%' . $search . '%')
                ->OrWhere('text' , 'like' , '%' . $search . '%')
                ->OrWhereHas('post', function ($query) use ($search){
                    return $query->where('title' , 'like' , '%' . $search . '%');
                });
        }
        return $query;
    }

    public function get_type()
    {
        return $this->status ? 'تایید شده' : 'در صف';
    }

    #############################################################

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
