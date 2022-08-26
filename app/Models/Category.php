<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Base
{
    use HasFactory;

    protected $fillable = ['name' , 'slug' , 'desc' , 'type', 'parent_id' , 'columns' , 'service_name' , 'auth_token'];

    protected static $free_columns = [
        'energy' => [
            [
                'title' => 'عنوان شاخص',
                'class' => 'info'
            ],
            [
                'title' => 'کلید شاخص',
            ],
            [
                'title' => 'قیمت شاخص به ریال',
                'class' => 'success'
            ],
            [
                'title' => 'نرخ بازگشایی شاخص',
            ],
            [
                'title' => 'بالاترین نرخ امروز',
                'class' => 'success'
            ],
            [
                'title' => 'پایین ترین نرخ امروز',
                'class' => 'danger'
            ],
            [
                'title' => 'میزان تغییر',
                'class' => 'purple'
            ],
            [
                'title' => 'نوع تغییر',
                'class' => 'inverse'
            ],
            [
                'title' => 'درصد تغییر',
                'class' => 'warning'
            ],
            [
                'title' => 'زمان آخرین نرخ',
            ],
        ],

        'metal' => [
            [
                'title' => 'عنوان شاخص',
                'class' => 'info'
            ],
//            [
//                'image' => 'تصویر محصول',
//            ],
            [
                'title' => 'عنوان دسته',
                'class' => 'warning'
            ],
            [
                'title' => 'قیمت محصول به ریال',
                'class' => 'success'
            ],
            [
                'title' => 'بالاترین نرخ امروز',
                'class' => 'success'
            ],
            [
                'title' => 'پایین ترین نرخ امروز',
                'class' => 'danger'
            ],
            [
                'title' => 'میزان تغییر',
                'class' => 'purple'
            ],
            [
                'title' => 'نوع تغییر',
                'class' => 'inverse'
            ],
            [
                'title' => 'درصد تغییر',
                'class' => 'warning'
            ],
            [
                'title' => 'سایر دیتاهای محصول',
                'class' => 'info'
            ],
        ],

        'precious-metals' => [
            [
                'title' => 'عنوان شاخص',
                'class' => 'info'
            ],
            [
                'title' => 'کلید شاخص',
            ],
            [
                'title' => 'قیمت محصول به ریال',
                'class' => 'success'
            ],
            [
                'title' => 'نرخ بازگشایی شاخص',
                'class' => 'warning'
            ],
            [
                'title' => 'بالاترین ترین نرخ امروز',
                'class' => 'success'
            ],
            [
                'title' => 'پایین ترین نرخ امروز',
                'class' => 'danger'
            ],
            [
                'title' => 'میزان تغییر',
                'class' => 'purple'
            ],
            [
                'title' => 'نوع تغییر',
                'class' => 'inverse'
            ],
            [
                'title' => 'درصد تغییر',
                'class' => 'warning'
            ],
            [
                'title' => 'زمان آخرین نرخ',
            ],
        ]
    ];

    protected $casts = [
        'columns' => 'array'
    ];

    #############################################################################

    public function scopeFilter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('type' , $filter);
        }
        if ($search){
            $query->where('name' , 'like' , '%' . $search . '%')
                ->OrWhere('slug' , 'like' , '%' . $search . '%')
                ->OrWhere('service_name' , 'like' , '%' . $search . '%')
                ->OrWhere('desc' , 'like' , '%' . $search . '%')
                ->OrWhereHas('parent', function ($query) use ($search){
                    return $query->where('name' , 'like' , '%' . $search . '%')
                        ->OrWhere('slug' , 'like' , '%' . $search . '%')
                        ->OrWhere('service_name' , 'like' , '%' . $search . '%')
                        ->OrWhere('desc' , 'like' , '%' . $search . '%');
                });
        }
        return $query;
    }

    #############################################################################

    public function get_type()
    {
        return $this->type == 'free' ? 'رایگان' : 'اشتراک';
    }

    public function get_child_type()
    {
        return count($this->childs) > 0 ? 'دسته بندی جداول' : 'جدول';
    }

    public function getColumns()
    {
        return $this->items()->pluck('title')->toArray();
    }

    public function getColumnsAssCollection()
    {
        return $this->items()->get();
    }

    public static function getfreeColumns($category)
    {
        return array_key_exists($category,self::$free_columns) ? self::$free_columns[$category] : [];
    }

    public function getCashData($search)
    {
        $query = Data::whereHas('item', function ($query){
            return $query->where('category_id', $this->id);
        });

        if ($search){
            $query = Data::Filter($query,$search,"");
        }

//        if (!auth()->check() || !auth()->user()->get_subscription()){
//            $query = $query->limit(5);
//        }

        return $query->get()->groupBy('row_code');
    }

    ######################################################################################

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function childs()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
