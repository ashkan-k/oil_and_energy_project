<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FreeTableController extends Controller
{
    public function index($slug)
    {
        $category = Category::whereSlug($slug)->whereType('free')->firstOrFail();
        return view('Admin.Free_Tables.list', compact('category'));
    }
}
