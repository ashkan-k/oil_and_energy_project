<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    public function index()
    {
        $objects = Category::Has('childs')->Filter(\request('search'),\request('filter'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Parent_Categories.list' , compact('objects'));
    }

    public function create()
    {
        $parents = Category::whereType('cash')->get();
        return view('Admin.Parent_Categories.form', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت افزوده شد." , 'parent_categories.index');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereType('cash')->get();
        return view('Admin.Parent_Categories.form' , compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت ویرایش شد." , 'parent_categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت حذف شد." , 'parent_categories.index');
    }
}
