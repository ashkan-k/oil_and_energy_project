<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $objects = PostCategory::Filter(\request('search'),\request('status'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Post_Categories.list', compact('objects'));
    }

    public function create()
    {
        return view('Admin.Post_Categories.form');
    }

    public function store(PostCategoryRequest $request)
    {
        PostCategory::create($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت افزوده شد.", 'post_categories.index');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('Admin.Post_Categories.form', compact('postCategory'));
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $postCategory->update($request->all());
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت ویرایش شد.", 'post_categories.index');
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return $this->SuccessRedirect("دسته بندی مورد نظر با موفقیت حذف شد.", 'post_categories.index');
    }
}
