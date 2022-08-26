<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function post_list($slug = null)
    {
        if (\request('search')) {
            $posts = Post::Filter(\request('search'), null)->paginate(env('PAGINATION_NUMBER'));
        } else {
            if ($slug) {
                $posts = PostCategory::where('slug', $slug)->firstOrFail()->posts()->paginate(env('PAGINATION_NUMBER'));
            } else {
                $posts = Post::paginate(env('PAGINATION_NUMBER'));
            }
        }

        $top_posts = Post::orderByDesc('view_count')->limit(10)->get();
        return view('Front.Posts.posts_list', compact('posts', 'top_posts'));
    }

    public function post_detail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $top_posts = Post::whereNotIn('id', [$post->id])->orderByDesc('view_count')->limit(10)->get();
        $comments = $post->comments()->where('status', 1)->get();
        return view('Front.Posts.post_detail', compact('post', 'top_posts', 'comments'));
    }
}
