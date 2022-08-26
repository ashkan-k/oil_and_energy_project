<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Base
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('type' , $filter);
        }
        if ($search){
            $query->where('name' , 'like' , '%' . $search . '%')
                ->OrWhere('slug' , 'like' , '%' . $search . '%');
        }
        return $query;
    }

    #############################################################################

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
