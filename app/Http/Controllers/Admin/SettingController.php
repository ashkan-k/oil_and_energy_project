<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $objects = Setting::Filter(\request('search'),\request('filter'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Settings.list' , compact('objects'));
    }

    public function create()
    {
        return view('Admin.Settings.form');
    }

    public function store(SettingRequest $request)
    {
        Setting::create($request->all());
        return $this->SuccessRedirect("تنظیمات مورد نظر با موفقیت افزوده شد." , 'settings.index');
    }

    public function edit(Setting $setting)
    {
        return view('Admin.Settings.form' , compact('setting'));
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->update($request->all());
        return $this->SuccessRedirect("تنظیمات مورد نظر با موفقیت ویرایش شد." , 'settings.index');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return $this->SuccessRedirect("تنظیمات مورد نظر با موفقیت حذف شد." , 'settings.index');
    }
}
