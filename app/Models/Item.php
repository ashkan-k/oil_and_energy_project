<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title'];

    ###########################################################################
    public static function sync_items($items, $deleted_items, $slug)
    {
        $category = Category::whereSlug($slug)->first();

        if ($deleted_items) {
            Item::whereIn('title', $deleted_items)->delete();
        }

        foreach ($items as $item) {
            $category->items()->firstOrCreate([
                'title' => strtolower(str_replace(' ' , '_' ,$item)),
            ], [
                'title' => strtolower(str_replace(' ' , '_' ,$item)),
            ]);
        }
    }

    ###########################################################################

    public function datas()
    {
        return $this->hasMany(Data::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
