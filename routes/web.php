<?php

use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('fffffffffffffff', function () {
//    $categories = \Illuminate\Support\Facades\DB::connection('mysql2')->table('categories')->get()->toArray();
//
//    foreach ($categories as $item) {
//        $item = json_decode(json_encode($item), true);
//        Category::create($item);
//    }

//    $tables = \Illuminate\Support\Facades\DB::connection('mysql2')->table('tables')->get()->toArray();
//
//    $items = $tables;
//    $tables = [];
//    foreach ($items as $key => $item) {
//        foreach ($item as $l => $j) {
//            if ($j != null) {
//                $tables[$key][$l] = json_decode(json_encode($j), true);
//            }
//        }
//    }
//
////    foreach ($tables as $item) {
////        $category_id = $item['category_id'];
////        $loop_items = array_diff(array_keys($item), ['id', 'category_id', 'created_at', 'updated_at']);
////        foreach ($loop_items as $new_item) {
////            \App\Models\Item::create([
////                'category_id' => $category_id,
////                'title' => $new_item
////            ]);
////        }
////    }

//    User::query()->delete();
//    $user = User::create(
//        [
//            'first_name' => 'اشکان',
//            'last_name' => 'کریمی',
//            //            'email' => 'as@gmail.com',
//            'phone' => '09396988720',
//            'password' => Hash::make('123'),
//            'phone_verified_at' => Carbon::now(),
//            'is_superuser' => true,
//        ]
//    );
//    auth()->login($user);
});

Route::get('/', [HomeController::class, 'index']);

## Posts ##
Route::group(['prefix' => 'posts','as' => 'posts.show.'], function () {
    Route::get('{slug?}', [PostController::class, 'post_list'])->name('list');
    Route::get('detail/{post}', [PostController::class, 'post_detail'])->name('detail');
});

## Comments ##
Route::post('comments/store', [CommentController::class, 'store'])->name('submit_comment');

// پرداخت و درگاه پرداخت
Route::group(['middleware' => ['auth:web']], function () {
    Route::post('payment/', [PaymentController::class, 'Pay'])->name('payment');
    Route::get('payment/callback', [PaymentController::class, 'Callback'])->name('payment.callback');
});

Route::redirect('/admin', '/admin/dashboard');
