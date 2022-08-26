@extends('layouts.admin-master')

@section('title'){{ isset($category) ? 'ویرایش دسته بندی' : 'افزودن دسته بندی' }}@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن دسته بندی</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($category)){{ route('parent_categories.update' , $category->id) }}@else{{ route('parent_categories.store') }}@endif">

                        @csrf
                        @if(isset($category))
                            @method('PATCH')
                        @endif

                        <input type="hidden" name="type" value="cash">

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="name" name="name" type="text"
                                       value="{{ isset($category->name) ? $category->name : old('name') }}">
                                <label for="name" class="">نام</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="slug" name="slug" type="text"
                                       value="{{ isset($category->slug) ? $category->slug : old('slug') }}">
                                <label for="slug">نامک(slug)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="desc" name="desc" class="materialize-textarea"
                                          style="height: 100px;">{{ isset($category->desc) ? $category->desc : old('desc') }}</textarea>
                                <label for="desc">توضیحات</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row">
                                    <label for="parent_id">دسته بندی والد</label>
                                </div>
                                <div class="row">
                                    <select onchange="ChangeType()" name="parent_id" id="parent_id" class="select2 browser-default">
                                        <option selected value="">دسته بندی والد را انتخاب کنید</option>
                                        @foreach($parents as $p)
                                            <option @if(isset($category->parent_id) && $category->parent_id == $p->id) selected
                                                    @endif value="{{ $p->id }}">{{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('parent_categories.index') }}"
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

        // Basic Select2 select
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });

    </script>
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
    <script>

        @if(isset($category) && $category->type == 'free')
        $("#service_name_div :input").attr('required', true)
        $('#service_name_div').show()

        $("#token_div :input").attr('required', true)
        $('#token_div').show()
        @else
        $('#service_name_div').hide()
        $('#token_div').hide()

        @endif

        function ChangeType() {
            var selected_type = $("#type").val()

            if (selected_type === 'free') {
                $("#service_name_div :input").attr('required', true)
                $('#service_name_div').show()

                $("#token_div :input").attr('required', true)
                $('#token_div').show()
            } else {
                $("#service_name_div :input").val(null)
                $("#service_name_div :input").attr('required', false)
                $('#service_name_div').hide()

                $("#token_div :input").val(null)
                $("#token_div :input").attr('required', false)
                $('#token_div').hide()
            }
        }
    </script>
@endsection
