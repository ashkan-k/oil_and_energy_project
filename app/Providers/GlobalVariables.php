<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalVariables extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('categories') && Schema::hasTable('payments') && Schema::hasTable('users'))
        {
            $cash_categories = Category::where('parent_id', null)->whereType('cash')->with('childs')->get();
            $free_categories = Category::whereType('free')->get();
            View::share('cash_categories',$cash_categories);
            View::share('free_categories',$free_categories);

            $user_counts = User::count();
            $free_tables_count = Category::whereType('free')->count();
            $cash_tables_count = Category::doesntHave('childs')->whereType('cash')->count();
            $total_income = Payment::query()->where('status', true)->sum('amount');
            View::share('user_counts',$user_counts);
            View::share('free_tables_count',$free_tables_count);
            View::share('cash_tables_count',$cash_tables_count);
            View::share('total_income',$total_income);
        }

        if (!str_starts_with(request()->path(), 'panel')){
            $post_cats = PostCategory::with('posts')->get();
            View::share('post_cats',$post_cats);
        }
    }
}
