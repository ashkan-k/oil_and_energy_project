@extends('layouts.admin-master')
@section('title','داشبورد')

@section('content')
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->

    @if(auth()->user()->is_superuser)
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card danger-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $user_counts }}</h2>
                                <h6 class="white-text op-5 light-blue-text">کاربران</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card info-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $free_tables_count }}</h2>
                                <h6 class="white-text op-5">تعدادجداول رایگان</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">receipt</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col l3 m6 s12">
                <div class="card success-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $cash_tables_count }}</h2>
                                <h6 class="white-text op-5 text-darken-2">تعداد جداول اشتراکی</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card warning-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $total_income }} تومان</h2>
                                <h6 class="white-text op-5">درآمد</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">attach_money</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(!auth()->user()->get_subscription())
            <div class="row text-center">
                <form action="{{ route('payment') }}" method="post">
                    @csrf
                    <div class="col m12 m5 text-center">
                        <div class="card-panel teal text-center">
                            <div class="row">
                                <div class="col">
                            <span class="white-text" style="font-size: 30px">
                        برای مشاهده جداول ویژه و بهره منده از اطلاعات آنها ابتدا باید اشتراک ویژه سایت را خریداری کنید.
                            </span>
                                </div>
                                <div class="col-4">
                                    <button type="submit"
                                            class="btn btn-large cyan waves-effect waves-light right">خرید اشتراک
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        @endif
    @endif
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
@endsection
