@extends('layouts.admin-master')

@section('title'){{ isset($slider) ? 'ویرایش اسلایدر' : 'افزودن اسلایدر' }}@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن اسلایدر</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post" enctype="multipart/form-data"
                          action="@if(isset($slider)){{ route('sliders.update' , $slider->id) }}@else{{ route('sliders.store') }}@endif">

                        @csrf
                        @if(isset($slider))
                            @method('PATCH')
                        @endif

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="title" name="title" type="text"
                                       value="{{ isset($slider->title) ? $slider->title : old('title') }}">
                                <label for="title" class="">عنوان</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn blue darken-1">
                                    <span>انتخاب</span>
                                    <input type="file" name="image" @if(!isset($slider)) required @endif id="image"
                                           value="{{ isset($slider->image) ? $slider->image : old('image') }}">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                                <label for="image">عکس</label>
                            </div>
                            @if(isset($slider))
                                <div class="input-field col s12">
                                    <p>عکس قبلی:</p>
                                    <a href="{{ $slider->image }}" target="_blank"><img src="{{ $slider->image }}"
                                                                                        width="200"
                                                                                        alt="{{ $slider->title }}"></a>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('sliders.index') }}"
                                   class="btn red waves-effect waves-light right m-l-10" type="button">
                                    بازگشت
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
