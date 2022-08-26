<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $objects = Comment::Filter(\request('search'),\request('status'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Comments.list', compact('objects'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return $this->SuccessRedirect("نظر مورد نظر با موفقیت حذف شد." , 'comments.index');
    }
}
