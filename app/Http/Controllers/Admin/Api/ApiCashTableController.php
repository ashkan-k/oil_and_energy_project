<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiCashTableController extends Controller
{
    public function add_new_item(Request $request ,$slug)
    {
        Item::sync_items($request->items,$request->deleted_items,$slug);
        return $this->ApiSuccessResponse(['message' => 'آیتم مورد نظر با موفقیت افزوده شد.'], 201);
    }

    public function get_items($slug)
    {
        $category = Category::whereSlug($slug)->whereType('cash')->firstOrFail();
        return $category->getColumns();
    }
}
