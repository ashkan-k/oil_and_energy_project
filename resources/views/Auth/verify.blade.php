@extends('layouts.auth-master')

@section('title')تایید حساب کاربری@endsection

@section('content')
    <div class="auth-box" ng-init="countDown()">
        <div id="loginform">
            <div class="logo">
                <span class="db"><img src="/logo.jpeg" width="50" alt="logo"/></span>
                <h5 class="font-medium m-b-20">تایید حساب کاربری iroilmarket</h5>
            </div>
        @include('Admin.Section.components.form_errors')
        @include('Admin.Section.components.auth.show_messages')
        <!-- Form -->
            <div class="row">
                <form class="col s12" action="{{ route('verify') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="code" type="text" value="{{ old('code') }}" class="validate" maxlength="6"
                                   name="code" required>
                            <label for="code">کد شما</label>
                        </div>
                    </div>

                    <div class="row m-t-40">
                        <div class="col s12">
                            <button class="btn-large w100 blue accent-4" type="submit">تایید</button>
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col s12">
                            <button class="btn-large w100 orange accent-4" type="button" ng-click="sendCode()" ng-disabled="counter>0">ارسال مجدد کد ([[counter]] ثانیه)</button>
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
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.window = window;
            $scope.intervalId = 0;
            $scope.counter = 0;
            $scope.default_delay_second = 60;

            $scope.sendCode = function() {
                $scope.counter = $scope.default_delay_second;
                $http.post(`{{ route('send_code') }}`).then(res => {
                    if (res.status == 200) {
                        toastr.success('کد احراز هویت به شماره تلفن شما ارسال شد.');
                    }
                }).catch(e => {
                    toastr.error('شماره موبایل معتبر نیست.');
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}"
                    }, 2000);
                }).then(()=> {
                    $scope.countDown();
                })
            }

            // Counter here
            $scope.clearTimer = function() {
                clearInterval($scope.intervalId);
            }

            $scope.countDown = function() {
                $scope.clearTimer();
                $scope.counter = $scope.default_delay_second;
                $scope.intervalId = $scope.window.setInterval(() => {
                    $scope.counter -= 1;
                    if ($scope.counter === 0) {
                        $scope.clearTimer();
                    }
                    // I had to apply below method, because it was not working in the proper way!!!
                    $scope.$apply(function () {
                        $scope.intervalId = $scope.intervalId;
                    });
                }, 1000);
            }

            $scope.reset = reset;

            function reset() {
                $scope.counter = 0;
            }
        });
    </script>
@endsection
