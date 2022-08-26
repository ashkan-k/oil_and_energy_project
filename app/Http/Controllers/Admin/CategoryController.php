<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Responses;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoryController extends Controller
{
    public function index()
    {
        $objects = Category::doesntHave('childs')->Filter(\request('search'), \request('filter'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Categories.list', compact('objects'));
    }

    public function create()
    {
        $parents = Category::all();
        return view('Admin.Categories.form', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت افزوده شد.", 'categories.index');
    }

    public function edit(Category $category)
    {
        $parents = Category::all();
        return view('Admin.Categories.form', compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت ویرایش شد.", 'categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت حذف شد.", 'categories.index');
    }

    ######################################################################

    public function childs_list($slug)
    {
        $objects = Category::whereHas('parent', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->with('childs')->Filter(\request('search'), \request('filter'))
            ->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));

        return view('Admin.Categories.childs', compact('objects'));
    }

    public function childs_detail($slug)
    {
        $objects = Category::whereHas('parent', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->Filter(\request('search'), \request('filter'))
            ->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));

        return view('Admin.Categories.childs', compact('objects'));
    }
}
