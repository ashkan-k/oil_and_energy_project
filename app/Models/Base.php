<?php


namespace App\Models;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
//    public function getCreatedAtAttribute($dates){
//        return Verta::instance($dates)->format('H:i %B %d, %Y ');
//    }

    public function getCreated()
    {
        return Verta::instance($this->created_at)->format('H:i %B %d, %Y ');
    }

    public function getUpdatedAtAttribute($dates)
    {
        return Verta::instance($dates)->format('H:i %B %d, %Y ');
    }
}
