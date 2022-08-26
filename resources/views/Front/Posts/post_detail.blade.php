@extends('layouts.front-master')

@section('content')
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">{{ $post->title }}</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="/">صفحه اصلی </a></li>
                    <li><a href="{{ route('posts.show.list') }}">وبلاگ </a></li>
                    <li>{{ $post->title }}</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content post-single-content text-wrap">
                        <div class="post post-grid post-single">
                            <figure class="post-media br-sm">
                                <img src="{{ $post->image }}" alt="Blog" width="930" height="500">
                            </figure>
                        </div>
                        <!-- End Post -->
                        <h4 class="title title-md font-weight-bold mt-5">{{ $post->title }}</h4>
                        <p class="mb-2" style="white-space: nowrap;!important;">{!! $post->text !!}</p>
                    {{--                        <div class="tags">--}}
                    {{--                            <label class="text-dark mr-2">برچسبها :</label>--}}
                    {{--                            <a href="#" class="tag">مدل </a>--}}
                    {{--                            <a href="#" class="tag">سبک </a>--}}
                    {{--                            <a href="#" class="tag">مسافرت </a>--}}
                    {{--                            <a href="#" class="tag">زنانه </a>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- End Tag -->--}}
                    {{--                        <div class="social-links mb-10">--}}
                    {{--                            <div class="social-icons social-no-color border-thin">--}}
                    {{--                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>--}}
                    {{--                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>--}}
                    {{--                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>--}}
                    {{--                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>--}}
                    {{--                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    <!-- End Social Links -->
                    {{--                        <h4 class="title title-lg font-weight-bold mt-10 pt-1 mb-5">پست های اخیر </h4>--}}
                    {{--                        <div class="post-slider owl-carousel owl-theme owl-nav-top pb-2 owl-loaded owl-drag"--}}
                    {{--                             data-owl-options="{--}}
                    {{--                                'nav': true,--}}
                    {{--                                'dots': false,--}}
                    {{--                                'margin': 20,--}}
                    {{--                                'responsive': {--}}
                    {{--                                    '0': {--}}
                    {{--                                        'items': 1--}}
                    {{--                                    },--}}
                    {{--                                    '576': {--}}
                    {{--                                        'items': 2--}}
                    {{--                                    },--}}
                    {{--                                    '768': {--}}
                    {{--                                        'items': 3--}}
                    {{--                                    },--}}
                    {{--                                    '992': {--}}
                    {{--                                        'items': 2--}}
                    {{--                                    },--}}
                    {{--                                    '1200': {--}}
                    {{--                                        'items': 3--}}
                    {{--                                    }--}}
                    {{--                                }--}}
                    {{--                            }">--}}
                    {{--                            <div class="owl-stage-outer">--}}
                    {{--                                <div class="owl-stage"--}}
                    {{--                                     style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1215px;">--}}
                    {{--                                    <div class="owl-item active" style="width: 283.75px; margin-right: 20px;">--}}
                    {{--                                        <div class="post post-grid">--}}
                    {{--                                            <figure class="post-media br-sm">--}}
                    {{--                                                <a href="post-single.html">--}}
                    {{--                                                    <img src="assets/images/blog/single/2.jpg" alt="Post" width="296"--}}
                    {{--                                                         height="190" style="background-color: #bcbcb4;">--}}
                    {{--                                                </a>--}}
                    {{--                                            </figure>--}}
                    {{--                                            <div class="post-details text-center">--}}
                    {{--                                                <div class="post-meta">--}}
                    {{--                                                    توسط <a href="#" class="post-author">جعفر عباسیخان</a>--}}
                    {{--                                                    - <a href="#" class="post-date">1400/5/20</a>--}}
                    {{--                                                </div>--}}
                    {{--                                                <h4 class="post-title mb-3"><a href="post-single.html">مد به شما می گوید--}}
                    {{--                                                        که از چه کسی هستید...</a></h4>--}}
                    {{--                                                <a href="post-single.html"--}}
                    {{--                                                   class="btn btn-link btn-dark btn-underline font-weight-normal">ادامه--}}
                    {{--                                                    مطلب <i class="w-icon-long-arrow-left"></i></a>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="owl-item active" style="width: 283.75px; margin-right: 20px;">--}}
                    {{--                                        <div class="post post-grid">--}}
                    {{--                                            <figure class="post-media br-sm">--}}
                    {{--                                                <a href="post-single.html">--}}
                    {{--                                                    <img src="assets/images/blog/single/3.jpg" alt="Post" width="296"--}}
                    {{--                                                         height="190" style="background-color: #cad2d1;">--}}
                    {{--                                                </a>--}}
                    {{--                                            </figure>--}}
                    {{--                                            <div class="post-details text-center">--}}
                    {{--                                                <div class="post-meta">--}}
                    {{--                                                    توسط <a href="#" class="post-author">بهنام عباسی</a>--}}
                    {{--                                                    - <a href="#" class="post-date">1400/5/20</a>--}}
                    {{--                                                </div>--}}
                    {{--                                                <h4 class="post-title mb-3"><a href="post-single.html">یک پست وبلاگ جالب--}}
                    {{--                                                        با تصاویر ارائه می شود</a></h4>--}}
                    {{--                                                <a href="post-single.html"--}}
                    {{--                                                   class="btn btn-link btn-dark btn-underline font-weight-normal">ادامه--}}
                    {{--                                                    مطلب <i class="w-icon-long-arrow-left"></i></a>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="owl-item active" style="width: 283.75px; margin-right: 20px;">--}}
                    {{--                                        <div class="post post-grid">--}}
                    {{--                                            <figure class="post-media br-sm">--}}
                    {{--                                                <a href="post-single.html">--}}
                    {{--                                                    <img src="assets/images/blog/single/4.jpg" alt="Post" width="296"--}}
                    {{--                                                         height="190" style="background-color: #ececec;">--}}
                    {{--                                                </a>--}}
                    {{--                                            </figure>--}}
                    {{--                                            <div class="post-details text-center">--}}
                    {{--                                                <div class="post-meta">--}}
                    {{--                                                    توسط <a href="#" class="post-author">مهتاب عباسی</a>--}}
                    {{--                                                    - <a href="#" class="post-date">1400/5/20</a>--}}
                    {{--                                                </div>--}}
                    {{--                                                <h4 class="post-title mb-3"><a href="post-single.html">یک پست وبلاگ جالب--}}
                    {{--                                                        با تصاویر ارائه می شود</a></h4>--}}
                    {{--                                                <a href="post-single.html"--}}
                    {{--                                                   class="btn btn-link btn-dark btn-underline font-weight-normal">ادامه--}}
                    {{--                                                    مطلب <i class="w-icon-long-arrow-left"></i></a>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="owl-item" style="width: 283.75px; margin-right: 20px;">--}}
                    {{--                                        <div class="post post-grid">--}}
                    {{--                                            <figure class="post-media br-sm">--}}
                    {{--                                                <a href="post-single.html">--}}
                    {{--                                                    <img src="assets/images/blog/single/5.jpg" alt="Post" width="296"--}}
                    {{--                                                         height="190" style="background-color: #AFAFAF;">--}}
                    {{--                                                </a>--}}
                    {{--                                            </figure>--}}
                    {{--                                            <div class="post-details text-center">--}}
                    {{--                                                <div class="post-meta">--}}
                    {{--                                                    توسط <a href="#" class="post-author">جعفر خان </a>--}}
                    {{--                                                    - <a href="#" class="post-date">1400/5/20</a>--}}
                    {{--                                                </div>--}}
                    {{--                                                <h4 class="post-title mb-3"><a href="post-single.html">ما می خواهیم--}}
                    {{--                                                        متفاوت باشیم و مد به من این فرصت را می دهد</a></h4>--}}
                    {{--                                                <a href="post-single.html"--}}
                    {{--                                                   class="btn btn-link btn-dark btn-underline font-weight-normal">ادامه--}}
                    {{--                                                    مطلب <i class="w-icon-long-arrow-left"></i></a>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="owl-nav">--}}
                    {{--                                <button type="button" role="presentation" class="owl-prev disabled"><i--}}
                    {{--                                        class="w-icon-angle-left"></i></button>--}}
                    {{--                                <button type="button" role="presentation" class="owl-next"><i--}}
                    {{--                                        class="w-icon-angle-right"></i></button>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="owl-dots disabled"></div>--}}
                    {{--                        </div>--}}
                    <!-- End پست های اخیر  -->

                        <h4 class="title title-lg font-weight-bold pt-1 mt-10">{{ count($comments) }} نظر </h4>
                        <ul class="comments list-style-none pl-0">
                            @foreach($comments as $comment)
                                <li class="comment">
                                    <div class="comment-body">
                                        <figure class="comment-avatar">
                                            <img src="/admin/user.jpg" alt="Avatar" width="90"
                                                 height="90">
                                        </figure>
                                        <div class="comment-content text-wrap">
                                            <h4 class="comment-author font-weight-bold">
                                                <a>{{ $comment->name }}</a>
                                                <span class="comment-date">{{ $comment->created_at }}</span>
                                            </h4>
                                            <p class="text-wrap">{{ $comment->text }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- End Comments -->
                        <form class="reply-section pb-4" method="post" action="{{ route('submit_comment') }}">
                            @csrf
                            <input type="hidden" name="slug" value="{{ $post->slug }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <h4 class="title title-md font-weight-bold pt-1 mt-10 mb-0">ارسال نظر </h4>
                            <p class="text-danger">نظر ثبت شده شما بعد از تایید توسط مدیر سایت به نمایش گذاشته
                                میشود.</p>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <input type="text" class="form-control" required placeholder="نام خود را وارد کنید "
                                           name="name" id="name">
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <input type="text" class="form-control" required
                                           placeholder="ایمیل خود را وارد کنید "
                                           name="email" id="email">
                                </div>
                            </div>
                            <textarea cols="30" rows="6" placeholder="متن نظر..." required class="form-control mb-4"
                                      name="text" id="text"></textarea>
                            <button class="btn btn-dark btn-rounded btn-icon-right btn-comment">ارسال نظر<i
                                    class="w-icon-long-arrow-left"></i></button>
                        </form>
                    </div>
                    @include('Front.components.posts_sidebar')
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection

@section('Scripts')
    @include('Admin.Section.components.sweet_alert')
@endsection
