<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cash_categories = Category::whereType('cash')->where('parent_id', null)->with('childs')->get();
        $sliders = Slider::all();
        return view('home', compact('cash_categories', 'sliders'));
    }
}
