@extends('layouts.front-master')

@section('Styles')
    <style>
        td {
            direction: ltr !important;
        }

    </style>
    <style>
        a {
            text-decoration: none;
        }

        .table-hover {
            direction: ltr !important;
        }

        table{
            font-size: 18px !important;
        }

    </style>
@endsection

@section('content')
    <main class="main">
        <section class="intro-section">
            <div
                class="owl-carousel owl-theme owl-nav-inner owl-dot-inner owl-nav-lg animation-slider gutter-no row cols-1"
                data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'items': 1,
                    'responsive': {
                        '1600': {
                            'nav': true,
                            'dots': false
                        }
                    }
                }">

                @foreach($sliders as $item)
                    <div class="banner banner-fixed intro-slide intro-slide3"
                         style="background-image: url({{ $item->image }}); background-color: #f0f1f2;">
                        <div class="container">
                            {{--                            <figure class="slide-image skrollable slide-animate" data-animation-options="{--}}
                            {{--                                                            'name': 'fadeInDownShorter',--}}
                            {{--                                                            'duration': '1s'--}}
                            {{--                                                        }">--}}
                            {{--                                <img src="assets/images/demos/demo1/sliders/skate.png" alt="Banner"--}}
                            {{--                                     data-bottom-top="transform: translateY(10vh);"--}}
                            {{--                                     data-top-bottom="transform: translateY(-10vh);" width="310" height="444">--}}
                            {{--                            </figure>--}}
                            <div class="banner-content text-right y-50">
                                {{--                                <p class="font-weight-normal text-default text-uppercase mb-0 slide-animate"--}}
                                {{--                                   data-animation-options="{--}}
                                {{--                                    'name': 'fadeInLeftShorter',--}}
                                {{--                                    'duration': '1s',--}}
                                {{--                                    'delay': '.6s'--}}
                                {{--                                }">--}}
                                {{--                                    فروشنده برتر هفتگی--}}
                                {{--                                </p>--}}
                                {{--                                <h5 class="banner-subtitle font-weight-normal text-default ls-25 slide-animate"--}}
                                {{--                                    data-animation-options="{--}}
                                {{--                                    'name': 'fadeInLeftShorter',--}}
                                {{--                                    'duration': '1s',--}}
                                {{--                                    'delay': '.4s'--}}
                                {{--                                }">--}}
                                {{--                                    مجموعه پرطرفدار--}}
                                {{--                                </h5>--}}
                                @if(isset($item->title))
                                    <h3 class="banner-title p-relative font-weight-bolder ls-50 slide-animate"
                                        data-animation-options="{
                                        'name': 'fadeInLeftShorter',
                                        'duration': '1s',
                                        'delay': '.2s'
                                    }">
                                        {{ $item->title }}
                                    </h3>
                            @endif
                            {{--                                <div class="btn-group slide-animate" data-animation-options="{--}}
                            {{--                                    'name': 'fadeInLeftShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.8s'--}}
                            {{--                                }">--}}
                            {{--                                    <a href="shop-list.html"--}}
                            {{--                                       class="btn btn-dark btn-outline btn-rounded btn-icon-right">اکنون بخرید<i--}}
                            {{--                                            class="w-icon-long-arrow-left"></i></a>--}}
                            {{--                                </div>--}}
                            <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                    </div>
            @endforeach

            <!-- End of .intro-slide3 -->
            </div>
            <!-- End of .owl-carousel -->
        </section>
        <!-- End of .intro-section -->
        <div class="container" style="margin-top: 100px !important;">
            @if (count($cash_categories) > 0)
                @if (auth()->check() && auth()->user()->get_subscription())
                    @foreach ($cash_categories as $cat)

                        @if(count($cat->childs) > 0)
                            <h2 class="col text-center text-primary text-wrap">{{ $cat->name }}</h2>

                            @foreach($cat->childs as $ch_table)

                                @if(count($ch_table->childs) > 0)
                                    <h3 class="col text-center text-danger text-wrap">{{ $ch_table->name }}</h3>

                                    @foreach($ch_table->childs as $nested_ch)
                                        <div class="table-responsive mt-5" style="margin-bottom: 9%!important;">
                                            <h4 class="col text-center text-wrap">{{ $nested_ch->name }}</h4>

                                            <table class="table table-hover table-striped">
                                                <tr>
                                                    <th>#</th>
                                                    @foreach ($nested_ch->items as $column)
                                                        <th>{{ strtoupper(str_replace('_' , ' ' ,$column->title)) }}</th>
                                                    @endforeach
                                                </tr>
                                                @foreach ($nested_ch->getCashData(null) as $item)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>

                                                        @foreach ($nested_ch->items as $column)
                                                            @php
                                                                $current_data = $item->where('item_id', $column->id)->first() ? $item->where('item_id', $column->id)->first()->value : null;
                                                            @endphp
                                                            @if(str_starts_with($current_data,'+'))
                                                                <td><span style="direction: ltr!important;"
                                                                        class="badge bg-success">{{ $current_data }}</span>
                                                                </td>
                                                            @elseif(str_starts_with($current_data,'-'))
                                                                <td><span style="direction: ltr!important;"
                                                                        class="badge bg-danger">{{ $current_data }}</span>
                                                                </td>
                                                            @else
                                                                <td>{{ $current_data }}</td>
                                                            @endif
                                                        @endforeach

                                                    </tr>
                                                @endforeach
                                            </table>
                                            @if($nested_ch->desc)
                                                <p style="float: left!important;font-size: 17px">{{ $nested_ch->desc }}
                                                    <span
                                                        class="text-danger">*</span></p>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div style="margin-bottom: 9%!important;" class="text-center">
                                        <p>{{ $ch_table->desc }}</p>
                                        <hr style="color: #0b0b0b;height: 3px!important;">
                                    </div>

                                @else
                                    <div class="table-responsive mt-5" style="margin-bottom: 9%!important;">
                                        <h3 class="col text-center text-wrap">{{ $ch_table->name }}</h3>

                                        <table class="table table-hover table-striped">
                                            <tr>
                                                <th>#</th>
                                                @foreach ($ch_table->items as $column)
                                                    <th>{{ strtoupper(str_replace('_' , ' ' ,$column->title)) }}</th>
                                                @endforeach
                                            </tr>
                                            @foreach ($ch_table->getCashData(null) as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    @foreach ($ch_table->items as $column)
                                                        @php
                                                            $current_data = $item->where('item_id', $column->id)->first() ? $item->where('item_id', $column->id)->first()->value : null;
                                                        @endphp
                                                        @if(str_starts_with($current_data,'+'))
                                                            <td><span style="direction: ltr!important;"
                                                                    class="badge bg-success">{{ $current_data }}</span>
                                                            </td>
                                                        @elseif(str_starts_with($current_data,'-'))
                                                            <td><span style="direction: ltr!important;"
                                                                    class="badge bg-danger">{{ $current_data }}</span>
                                                            </td>
                                                        @else
                                                            <td>{{ $current_data }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </table>

                                        @if($ch_table->desc)
                                            <p dir="rtl" class="text-right" style="float: left!important;font-size: 17px;direction: ltr !important;"><span
                                                    class="text-danger">*</span>{{ $ch_table->desc }}</p>
                                        @endif
                                    </div>
                                @endif

                            @endforeach
                        @endif

                    @endforeach
                @else
                    <div class="row">
                        <h2 class="text-center text-danger mt-5 mb-5">برای مشاهده داده های ویژه ابتدا باید ثبت نام کرده
                            و
                            اشتراک
                            ویژه
                            سایت را خریداری کنید!</h2>
                        <a type="button" href="{{ route('login') }}"
                           class="btn btn-large btn-primary text-center mt-3 mb-5 col-5">ورود</a>
                        <a type="button" href="{{ route('register') }}"
                           class="btn btn-large btn-dark text-center mt-3 mb-5 col-5 ml-10">ثبت نام</a>
                    </div>
                @endif
            @else
                <h2 class="text-center text-danger mt-5 mb-5">جدولی در دسترس نیست!</h2>
            @endif

        </div>
    </main>
@endsection
