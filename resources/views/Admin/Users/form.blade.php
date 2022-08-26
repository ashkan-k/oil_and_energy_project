@extends('layouts.admin-master')

@section('title'){{ isset($user) ? 'ویرایش کاربر' : 'افزودن کاربر' }}@endsection

@section('content')
    <div class="row">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن کاربر</h5>
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($user)){{ route('users.update' , $user->id) }}@else{{ route('users.store') }}@endif">

                        @csrf
                        @if(isset($user))
                            @method('PATCH')
                        @endif

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="first_name" name="first_name" type="text"
                                       value="{{ isset($user->first_name) ? $user->first_name : old('first_name') }}">
                                <label for="first_name" class="">نام</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="last_name" name="last_name" type="text"
                                       value="{{ isset($user->last_name) ? $user->last_name : old('last_name') }}">
                                <label for="last_name" class="">نام خانوادگی</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="phone" name="phone" type="text" maxlength="11"
                                       value="{{ isset($user->phone) ? $user->phone : old('phone') }}">
                                <label for="phone" class="">شماره موبایل</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" name="password" type="text" minlength="8"
                                       value="{{ old('password') }}">
                                <label for="password" class="">رمز عبور</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select name="is_superuser" id="type">
                                    <option @if(isset($user->is_superuser) && !$user->is_superuser) selected
                                            @endif value="0">خیر
                                    </option>
                                    <option @if(isset($user->is_superuser) && $user->is_superuser) selected
                                            @endif value="1">بله
                                    </option>
                                </select>
                                <label for="type">آیا مدیر است؟</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('users.index') }}"
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
