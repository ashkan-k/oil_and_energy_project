<?php

use App\Http\Controllers\Admin\Api\ApiCashTableController;
use App\Http\Controllers\Admin\Api\ApiCommentController;
use App\Http\Controllers\Admin\Api\ApiFreeTableController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CashTableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

## Admin API Routes ##
Route::group(['middleware' => [], 'as' => 'api.'], function () {
    ## Cash Table Items ##
    Route::group(['middleware' => ['is_superuser']], function () {
        ## Cash Table Items ##
        Route::get('table/cash/items/{slug}', [ApiCashTableController::class, 'get_items'])->name('tables.items.index');
        Route::post('table/cash/items/create/{slug}', [ApiCashTableController::class, 'add_new_item'])->name('tables.items.create');
        Route::post('comments/change_status', [ApiCommentController::class, 'change_status'])->name('comment_change_status');
    });

    ## Free Table Items ##
     Route::get('table/free/list/{slug}', [ApiFreeTableController::class, 'list'])->name('free.tables.index');
});
