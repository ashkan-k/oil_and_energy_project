<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Base
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'short_text', 'text', 'view_count', 'image', 'post_category_id'];

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('type' , $filter);
        }
        if ($search){
            $query->where('title' , 'like' , '%' . $search . '%')
                ->OrWhere('slug' , 'like' , '%' . $search . '%')
                ->OrWhere('text' , 'like' , '%' . $search . '%')
                ->OrWhereHas('post_category', function ($query) use ($search){
                    return $query->where('name' , 'like' , '%' . $search . '%');
                });
        }
        return $query;
    }

    #############################################################################

    public function post_category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
