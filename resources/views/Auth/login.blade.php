@extends('layouts.auth-master')

@section('title')ورود@endsection

@section('content')
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <span class="db"><img src="/logo.jpeg" width="50" alt="logo"/></span>
                <h5 class="font-medium m-b-20">ورود به iroilmarket</h5>
            </div>
        @include('Admin.Section.components.form_errors')
        @include('Admin.Section.components.auth.show_messages')
        <!-- Form -->
            <div class="row">
                <form class="col s12" action="{{ route('login') }}" method="post">
                @csrf
                <!-- email -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="phone" type="text" value="{{ old('phone') }}" class="validate" name="phone" required>
                            <label for="phone">شماره موبایل</label>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" value="{{ old('password') }}" name="password" class="validate" required>
                            <label for="password">رمز عبور</label>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row m-t-5">
                        <div class="col s7">
                            <label>
                                <input type="checkbox" value="1" name="remember_me"/>
                                <span>مرا بخاطر پسپار؟</span>
                            </label>
                        </div>
                        <div class="col s5 right-align"><a href="{{ route('reset_password.mobile') }}" class="link" id="to-recover">فراموش کرده اید؟</a>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row m-t-40">
                        <div class="col s12">
                            <button class="btn-large w100 blue accent-4" type="submit">ورود</button>
                        </div>
                    </div>
                </form>
            </div>
{{--            <div class="center-align m-t-20 db">--}}
{{--                <a href="#" class="btn indigo darken-1 tooltipped m-r-5" data-position="top"--}}
{{--                   data-tooltip="Login with Facebook"><i class="fab fa-facebook-f"></i></a> <a href="#"--}}
{{--                                                                                               class="btn orange darken-4 tooltipped"--}}
{{--                                                                                               data-position="top"--}}
{{--                                                                                               data-tooltip="Login with Facebook"><i--}}
{{--                        class="fab fa-google-plus-g"></i></a>--}}
{{--            </div>--}}
            <div class="center-align m-t-20 db">
                حساب کاربر ندارید؟ <a href="{{ route('register') }}">ثبت نام کنید!</a>
            </div>
        </div>
    </div>
@endsection
