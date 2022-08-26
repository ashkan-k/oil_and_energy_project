<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Uploader;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Uploader;

    public function index()
    {
        $objects = Post::Filter(\request('search'),\request('status'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Posts.list', compact('objects'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        return view('Admin.Posts.form', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $image = $request->hasFile('image') ?
            $this->UploadFile($request->file('image') , 'posts', $request->title) : null;

        Post::create(array_merge($request->all() , ['image' => $image]));
        return $this->SuccessRedirect("محتوا مورد نظر با موفقیت افزوده شد.", 'posts.index');
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        return view('Admin.Posts.form', compact('post','categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $image = $request->hasFile('image') ?
            $this->UploadFile($request->file('image') , 'sliders', $request->title) : $post->image;

        $post->update(array_merge($request->all() , ['image' => $image]));
        return $this->SuccessRedirect("محتوا مورد نظر با موفقیت ویرایش شد.", 'posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->SuccessRedirect("محتوا مورد نظر با موفقیت حذف شد.", 'posts.index');
    }
}
