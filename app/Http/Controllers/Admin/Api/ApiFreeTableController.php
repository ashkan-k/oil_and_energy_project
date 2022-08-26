<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiFreeTableController extends Controller
{
    public function list($slug)
    {
        $category = Category::whereSlug($slug)->whereType('free')->firstOrFail();
        $page = \request('page' , 1);
        $limit = \request('limit' , 30);

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$category->auth_token}",
        ])->get("https://gateway.accessban.com/public/web-service/list/{$category->service_name}?format=json&limit=$limit&page={$page}");

        // $response = [
        //     ['dfdsfds'],
        //     ['dfdsfdsfdsf'],
        //     ['fdgfdg'],
        //     ['fdgfdg'],
        //     ['fgdgfdgfdg'],
        // ];

        $data = [
            // 'tables' => $response,
            'tables' => $response->json(),
            'columns' => Category::getfreeColumns($category->service_name)
        ];

        return $data;
    }
}
