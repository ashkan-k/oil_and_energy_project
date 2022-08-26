<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApiCommentController extends Controller
{
    public function change_status(Request $request)
    {
        Comment::findOrFail($request->id)->update(['status' => $request->status]);
        return $this->ApiSuccessResponse(['message' => 'وضعیت نظر مورد نظر با موفقیت تغییر یافت.'], 200);
    }
}
