@extends('layouts.admin-master')

@section('title'){{ isset($post) ? 'ویرایش محتوا-مقاله' : 'افزودن محتوا-مقاله' }}@endsection

@section('Styles')
    <style>
        textarea {
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن محتوا-مقاله</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          enctype="multipart/form-data"
                          action="@if(isset($post)){{ route('posts.update' , $post->id) }}@else{{ route('posts.store') }}@endif">

                        @csrf
                        @if(isset($post))
                            @method('PATCH')
                        @endif

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="title" name="title" type="text"
                                       value="{{ isset($post->title) ? $post->title : old('title') }}">
                                <label for="title" class="">عنوان</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="slug" name="slug" type="text"
                                       value="{{ isset($post->slug) ? $post->slug : old('slug') }}">
                                <label for="slug">نامک(slug)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="short_text" name="short_text" class="materialize-textarea" dir="rtl"
                                          style="height: 100px;">{{ isset($post->short_text) ? $post->short_text : old('short_text') }}</textarea>
                                <label for="short_text">متن کوتاه(short text)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row">
                                    <label for="text">متن</label>
                                </div>
                                <div class="row">
                                   <textarea id="text" name="text" required
                                             class="materialize-textarea">{{ isset($post->text) ? $post->text : old('text') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select name="post_category_id" required id="post_category_id">
                                    <option selected value="">دسته بندی را انتخاب کنید</option>
                                    @foreach($categories as $c)
                                        <option
                                            @if(isset($post->post_category_id) && $post->post_category_id == $c->id) selected
                                            @else {{ old('post_category_id') }}
                                            @endif value="{{ $c->id }}">{{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="post_category_id">دسته بندی</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn blue darken-1">
                                    <span>انتخاب</span>
                                    <input type="file" name="image" @if(!isset($post)) required @endif id="image"
                                           value="{{ isset($post->image) ? $post->image : old('image') }}">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                                <label for="image">عکس</label>
                            </div>
                            @if(isset($post))
                                <div class="input-field col s12">
                                    <p>عکس قبلی:</p>
                                    <a href="{{ $post->image }}" target="_blank"><img src="{{ $post->image }}"
                                                                                      width="200"
                                                                                      alt="{{ $post->title }}"></a>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('posts.index') }}"
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


@section('Scripts')
    <script>
        $("#title").on('keyup', function () {
            data = $("#title").val()
            data = data.replaceAll(' ', '-')
            data = data.replaceAll('/', '-')
            $("#slug").val(data)
        });

        $('#slug').on('keyup', function () {
            data = $("#slug").val()
            data = data.replaceAll(' ', '-')
            data = data.replaceAll('/', '-')
            $("#slug").val(data)
        })
    </script>

    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('text', {
            // filebrowserUploadMethod: 'form',
            //
            // filebrowserUploadUrl: '/admin/panel/CK',
            // filebrowserImageUploadUrl: '/admin/panel/CK'
        });
    </script>
@endsection
