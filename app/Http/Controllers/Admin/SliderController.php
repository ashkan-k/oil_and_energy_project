<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Uploader;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use Uploader;

    public function index()
    {
        $objects = Slider::Filter(\request('search'),\request('filter'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Sliders.list' , compact('objects'));
    }

    public function create()
    {
        return view('Admin.Sliders.form');
    }

    public function store(SliderRequest $request)
    {
        $image = $request->hasFile('image') ?
            $this->UploadFile($request->file('image') , 'sliders', $request->title) : null;

        Slider::create(array_merge($request->all() , ['image' => $image]));
        return $this->SuccessRedirect("اسلایدر مورد نظر با موفقیت افزوده شد." , 'sliders.index');
    }

    public function edit(Slider $slider)
    {
        return view('Admin.Sliders.form' , compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $image = $request->hasFile('image') ?
            $this->UploadFile($request->file('image') , 'sliders', $request->title) : $slider->image;

        $slider->update(array_merge($request->all() , ['image' => $image]));
        return $this->SuccessRedirect("اسلایدر مورد نظر با موفقیت ویرایش شد." , 'sliders.index');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return $this->SuccessRedirect("اسلایدر مورد نظر با موفقیت حذف شد." , 'sliders.index');
    }
}
