@extends('layouts.auth-master')

@section('title')فراموشی رمز عبور@endsection

@section('content')
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <span class="db"><img src="/logo.jpeg" width="50" alt="logo"/></span>
                <h5 class="font-medium m-b-20">فراموشی رمز عبور iroilmarket</h5>
            </div>
        @include('Admin.Section.components.form_errors')
        @include('Admin.Section.components.auth.show_messages')
        <!-- Form -->
            <div class="row">
                <form class="col s12" action="{{ route('reset_password.mobile') }}" method="post">
                @csrf
                <!-- email -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="phone" type="text" value="{{ old('phone') }}" class="validate" name="phone" required>
                            <label for="phone">شماره موبایل</label>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row m-t-40">
                        <div class="col s12">
                            <button class="btn-large w100 blue accent-4" type="submit">ارسال کد</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="center-align m-t-20 db">
                <a href="#" class="btn indigo darken-1 tooltipped m-r-5" data-position="top"
                   data-tooltip="Login with Facebook"><i class="fab fa-facebook-f"></i></a> <a href="#"
                                                                                               class="btn orange darken-4 tooltipped"
                                                                                               data-position="top"
                                                                                               data-tooltip="Login with Facebook"><i
                        class="fab fa-google-plus-g"></i></a>
            </div>
            <div class="center-align m-t-20 db">
                رمز عبور خود را به یاد می آوردید؟ <a href="{{ route('login') }}">وارد شوید</a>
            </div>
        </div>
    </div>
@endsection
