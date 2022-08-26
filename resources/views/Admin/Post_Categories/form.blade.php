@extends('layouts.admin-master')

@section('title'){{ isset($postCategory) ? 'ویرایش دسته بندی محتوا-مقاله' : 'افزودن دسته بندی محتوا-مقاله' }}@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن دسته بندی محتوا-مقاله</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($postCategory)){{ route('post_categories.update' , $postCategory->id) }}@else{{ route('post_categories.store') }}@endif">

                        @csrf
                        @if(isset($postCategory))
                            @method('PATCH')
                        @endif

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="name" name="name" type="text"
                                       value="{{ isset($postCategory->name) ? $postCategory->name : old('name') }}">
                                <label for="name" class="">نام</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="slug" name="slug" type="text"
                                       value="{{ isset($postCategory->slug) ? $postCategory->slug : old('slug') }}">
                                <label for="slug">نامک(slug)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('post_categories.index') }}"
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
        $("#name").on('keyup', function () {
            data = $("#name").val()
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
@endsection
