<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Data;
use App\Models\Table;
use Illuminate\Http\Request;

class CashTableController extends Controller
{
    public function add_new_item($slug)
    {
        $category = Category::whereSlug($slug)->whereType('cash')->firstOrFail();
        return view('Admin.Cash_Tables.add-items', compact('category'));
    }

    ##############################

    public function index($slug)
    {
        $category = Category::whereSlug($slug)->whereType('cash')->firstOrFail();
        $objects = $category->getCashData(\request('search'));

        return view('Admin.Cash_Tables.list', compact('objects', 'slug','category'));
    }

    public function create($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        $columns = $category->items()->pluck('title')->toArray();
        return view('Admin.Cash_Tables.form', compact('category', 'columns'));
    }

    public function store(Request $request)
    {
        $category = Category::where('slug',$request->category_slug)->firstOrFail();
        Data::save_data($request, $category,false);

        $next_url = 'tables.index';

        if ($request->has('save_and_new')){
            $next_url = 'tables.create';
        }

        return $this->SuccessRedirect("داده مورد نظر با موفقیت افزوده شد.", $next_url, [], $category->slug);
    }

    public function edit($row_code,$slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        $columns = $category->items()->pluck('title')->toArray();
        $data = Data::where('row_code', $row_code)->get();

        return view('Admin.Cash_Tables.form', compact('columns','row_code', 'data', 'category'));
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();
        Data::save_data($request, $category,true);
        return $this->SuccessRedirect("داده مورد نظر با موفقیت ویرایش شد.", 'tables.index', [], $slug);
    }

    public function destroy($row_code)
    {
        Data::where('row_code', $row_code)->delete();
        return $this->SuccessRedirect("داده مورد نظر با موفقیت حذف شد.", 'tables.index', [], \request('category_slug'));
    }
}
