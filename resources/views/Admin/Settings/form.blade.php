@extends('layouts.admin-master')

@section('title'){{ isset($setting) ? 'ویرایش تنظیمات' : 'افزودن تنظیمات' }}@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن تنظیمات</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($setting)){{ route('settings.update' , $setting->id) }}@else{{ route('settings.store') }}@endif">

                        @csrf
                        @if(isset($setting))
                            @method('PATCH')
                        @endif

                        <div class="row">
                            <div class="input-field col s12">
                                <input required id="key" name="key" type="text"
                                       value="{{ isset($setting->key) ? $setting->key : old('key') }}">
                                <label for="key" class="">نام(کلید)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="desc" name="value" class="materialize-textarea"
                                          style="height: 100px;">{{ isset($setting->value) ? $setting->value : old('value') }}</textarea>
                                <label for="value">مقدار</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('settings.index') }}"
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
