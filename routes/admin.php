<?php

use App\Http\Controllers\Admin\CashTableController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\FreeTableController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentCategoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


## Admin Routes ##
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('', function () {
        return redirect(\route('dashboard'));
    });
    ## Dashboard ##
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['middleware' => ['is_superuser']], function () {
        ## Users ##
        Route::resource('users', UserController::class);
        ## Parent Categories ##
        Route::resource('parent_categories', ParentCategoryController::class)->parameters([
            'parent_categories' => 'category',
        ]);
        ## Categories ##
        Route::resource('categories', CategoryController::class);
        ## Settings ##
        Route::resource('settings', SettingController::class)->middleware('is_superuser');
        ## Sliders ##
        Route::resource('sliders', SliderController::class)->middleware('is_superuser');
        ## Post Categories ##
        Route::resource('post_categories', PostCategoryController::class);
        ## Posts ##
        Route::resource('posts', PostController::class);
        ## Comments ##
        Route::resource('comments', CommentController::class)->only(['index', 'destroy']);
        ## Payments ##
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });

    ## Cash Tables ##
    Route::group(['prefix' => 'cash/tables', 'as' => 'tables.'], function () {
        ## Child Categories ##
        Route::group(['prefix' => 'category/childs', 'as' => 'childs.', 'middleware' => ['is_subscriber']], function () {
            ## Child Categories list ##
            Route::get('list/{slug}', [CategoryController::class, 'childs_list'])->name('list');
            ## Child Categories Show Tables ##
            Route::get('tables/{slug}', [CategoryController::class, 'childs_detail'])->name('detail');
        });

        ## Tables Data Show ##
        Route::get('{slug}', [CashTableController::class, 'index'])->name('index')->middleware('is_subscriber');

        ######################################################################################################################

        ## Items and Data ##
        Route::group(['middleware' => ['is_superuser']], function () {
            ## Items ##
            Route::get('items/{slug}', [CashTableController::class, 'add_new_item'])->name('items.create');

            ## Data ##
            Route::get('create/{slug}', [CashTableController::class, 'create'])->name('create');
            Route::post('', [CashTableController::class, 'store'])->name('store');

            Route::get('{row_code}/{slug}/edit', [CashTableController::class, 'edit'])->name('edit');
            Route::patch('{slug}', [CashTableController::class, 'update'])->name('update');

            Route::delete('{row_code}', [CashTableController::class, 'destroy'])->name('destroy');
        });
    });

    ## Free Tables Data ##
    Route::get('free/tables/{slug}/data', [FreeTableController::class, 'index'])->name('free_tables.index');
});
