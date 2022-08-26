<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->all());
        return $this->SuccessRedirect("نظر شما با موفقیت ثبت شد." , 'posts.show.detail',[],$request->slug);
    }
}
