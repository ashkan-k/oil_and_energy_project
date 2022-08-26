<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Base
{
    use HasFactory;

    protected $fillable = ['title', 'image'];

    ###################################################

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('type' , $filter);
        }
        if ($search){
            $query->where('title' , 'like' , '%' . $search . '%');
        }
        return $query;
    }
}
