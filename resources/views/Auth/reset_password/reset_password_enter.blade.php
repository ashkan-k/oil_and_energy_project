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
                <form class="col s12" action="{{ route('reset_password.enter') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" value="{{ old('password') }}" type="password" name="password"
                                   class="validate" required>
                            <label for="password">رمز عبور</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password_confirmation" value="{{ old('password_confirmation') }}" type="password"
                                   name="password_confirmation" class="validate"
                                   required>
                            <label for="password_confirmation">تکرار رمز عبور</label>
                        </div>
                    </div>

                    <div class="row m-t-40">
                        <div class="col s12">
                            <button class="btn-large w100 blue accent-4" type="submit">ذخیره</button>
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
