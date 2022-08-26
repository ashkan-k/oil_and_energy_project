<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'value', 'row_code'];

    public static function save_data($request,$category,$is_updating)
    {
        $row_code = self::generateUniqueCode();

        foreach ($request->all() as $item_id => $value) {
            if (is_numeric($item_id)){
                $item = Item::findOrFail($item_id);
                if ($is_updating){
                    $item->datas()->updateOrCreate(
                        ['value' =>  $value],
                        ['row_code' => $row_code,'value' =>  $value]
                    );
                }
                else{
                    $item->datas()->create(
                        ['row_code' => $row_code,'value' =>  $value]
                    );
                }
            }
        }

        Data::where('row_code', $request->last_row_code)->delete();
    }

    private static function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Data::where("row_code", "=", $code)->first());

        return $code;
    }

    public static function Filter($query,$search,$filter)
    {
        if ($filter){
            $query = $query->where('type' , $filter);
        }

        if ($search){
            $query->where('value' , 'like' , '%' . $search . '%');
        }
        return $query;
    }

    #############################################################################

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
