<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title','Wikinaft')</title>

    <meta name="keywords" content="Wikinaft"/>
    <meta name="description" content="Wikinaft - وبسایت نفت و انرژی">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/{{ $settings['LOGO']['value'] }}">

    <style>
        a {
            text-decoration: none;
        }

    </style>

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Poppins:400,500,600,700,800']
            }
        };
        (function (d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '/front/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preload" href="/front/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="/front/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="/front/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="/front/assets/fonts/wolmart87d5.ttf?png09e" as="font" type="font/ttf"
          crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="/front/assets/vendor/fontawesome-free/css/all.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="/front/assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/front/assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/front/assets/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="/admin/src/css/sweetalert2.min.css"/>

    <!-- Default CSS -->
{{--    <link rel="stylesheet" type="text/css" href="/front/assets/css/demo1.min.css">--}}

    <link rel="stylesheet" type="text/css" href="/front/assets/css/style.min.css">

    @yield('Styles')

</head>

<body class="home">
<div class="page-wrapper">
    <!-- Start of Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <p class="welcome-msg"></p>
                </div>
                <div class="header-right">
                    {{--                    <span class="divider d-lg-show"></span>--}}
                    <a href="mailto:{{ $settings['CONTACT_US_MAIL']['value'] }}" class="d-lg-show">تماس با ما </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="d-lg-show">حساب کاربری من </a>
                        <a type="button" onclick="$('#frm_logout').submit()" class="d-lg-show">خروج </a>
                        <form id="frm_logout" style="display: none" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="d-lg-show"><i class="w-icon-account"></i>ورود </a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="{{ route('register') }}" class="ml-0 d-lg-show">ثبت نام </a>
                    @endauth
                </div>
            </div>
        </div>
        <!-- End of Header Top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left mr-md-4">
                    <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                    </a>
                    <a href="/{{ $settings['LOGO']['value'] }}" class="logo ml-lg-0">
                        <img src="/{{ $settings['LOGO']['value'] }}" alt="logo" width="110" height="20"/>
                    </a>
                    {{-- <form method="get" action="#"
                        class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                        <div class="select-box">
                            <select id="category" name="category">
                                <option value="">تمام دسته بندیها</option>
                                <option value="4">مدلینگ </option>
                                <option value="5">مبلمان </option>
                                <option value="6">کفشها </option>
                                <option value="7">اسپورتی </option>
                                <option value="8">گیم/بازی </option>
                                <option value="9">کامپیوترها </option>
                                <option value="10">الکترونیکی </option>
                                <option value="11">آشپرخانه </option>
                                <option value="12">لباس </option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="search" id="search" placeholder="جستجو ..."
                            required />
                        <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>
        <!-- End of Header Middle -->
        <div class="sticky-content-wrapper">
            <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="has-submenu">
                                        <a href="vendor-dokan-store.html">اخبار و محتوا</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('posts.show.list') }}">همه</a></li>
                                            @foreach($post_cats as $cat)
                                                @if(count($post_cats) > 0)
                                                    <li class="has-submenu">
                                                        <a href="#">{{ $cat->name }}</a>
                                                        <ul class="submenu">
                                                            @foreach($cat->posts as $p)
                                                                <li>
                                                                    <a href="{{ route('posts.show.detail', $p->slug) }}">{{ $p->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="active">
                                        <a href="/">صفحه اصلی </a>
                                    </li>
                                    @auth
                                        <li class="active">
                                            <a href="{{ route('dashboard') }}">حساب کاربری </a>
                                        </li>
                                    @else
                                        <li class="active">
                                            <a href="{{ route('login') }}">ورود </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ route('register') }}">ثبت نام </a>
                                        </li>
                                    @endauth
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End of Header -->

    <!-- Start of Main-->
@yield('content')
<!-- End of Main -->

    <!-- Start of Footer -->
    <footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
        <hr>
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-about">
                            <a href="/{{ $settings['LOGO']['value'] }}" target="_blank" class="logo-footer">
                                <img src="/{{ $settings['LOGO']['value'] }}" alt="logo-footer" width="115"
                                     height="40"/>
                            </a>
                            <div class="widget-body">
                                <p class="widget-about-title">سوال داشتید؟ با ما تماس بگیرید</p>
                                <a href="tel:18005707777"
                                   class="widget-about-call">{{ $settings['PHONE_NUMBER']['value'] }}</a>
                                {{--                                    <p class="widget-about-desc">همین حالا ثبت نام کنید تا به روزرسانی های مربوط به--}}
                                {{--                                        محصولات را دریافت کنید.--}}
                                {{--                                    </p>--}}

                                <div class="social-icons social-icons-colored">
                                    <a href="https://www.facebook.com/{{ $settings['FACEBOOK_ACCOUNT']['value'] }}"
                                       target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                                    <a href="{{ $settings['TWITTER_ACCOUNT']['value'] }}" target="_blank"
                                       class="social-icon social-twitter w-icon-twitter"></a>
                                    <a href="http://instagram.com/{{ $settings['INSTAGRAM_ACCOUNT']['value'] }}"
                                       target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                                    {{--                                    <a href="#" class="social-icon social-telegram w-icon-telegram"></a>--}}
                                    {{--                                    <a href="#" class="social-icon social-youtube w-icon-youtube"></a>--}}
                                    {{--                                    <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h3 class="widget-title">شرکت </h3>
                            <ul class="widget-body">
                                <li><a href="https://iroilmarket.com/about-iroilmarket-company/">درباره ما </a></li>
                                <li><a href="mailto:{{ $settings['CONTACT_US_MAIL']['value'] }}">تماس با ما </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">حساب کاربری </h4>
                            <ul class="widget-body">
                                @auth
                                    <li><a href="{{ route('dashboard') }}">حساب کاربری من</a></li>
                                @else
                                    <li><a href="{{ route('login') }}">ورود </a></li>
                                    <li><a href="{{ route('register') }}">ثبت نام</a></li>
                                @endauth

                            </ul>
                        </div>
                    </div>
                    {{--                    <div class="col-lg-3 col-sm-6">--}}
                    {{--                        <div class="widget">--}}
                    {{--                            <h4 class="widget-title">خدمات مشتری </h4>--}}
                    {{--                            <ul class="widget-body">--}}
                    {{--                                <li><a href="#">روش های پرداخت </a></li>--}}
                    {{--                                <li><a href="#">ضمانت عودت وجه </a></li>--}}
                    {{--                                <li><a href="#">روش بازگشتی </a></li>--}}
                    {{--                                <li><a href="#">مرکز پشتیبانی </a></li>--}}
                    {{--                                <li><a href="#">حمل و نقل </a></li>--}}
                    {{--                                <li><a href="#">شرایط و ضوابط</a></li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="">
                <div class="footer-right text-center">
                    <p class="copyright"> {!! $settings['COPY_RIGHT']['value'] !!}</p>
                </div>
                {{--                <div class="footer-right">--}}
                {{--                    <span class="payment-label mr-lg-8">پرداخت امن و مطمئن با </span>--}}
                {{--                    <figure class="payment">--}}
                {{--                        <img src="/front/assets/images/payment.png" alt="payment" width="159" height="25"/>--}}
                {{--                    </figure>--}}
                {{--                </div>--}}
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Page-wrapper-->

<!-- Start of Sticky Footer -->
{{--<div class="sticky-footer sticky-content fix-bottom">--}}
{{--    <a href="demo1.html" class="sticky-link active">--}}
{{--        <i class="w-icon-home"></i>--}}
{{--        <p>خانه </p>--}}
{{--    </a>--}}
{{--    <a href="shop-banner-sidebar.html" class="sticky-link">--}}
{{--        <i class="w-icon-category"></i>--}}
{{--        <p>فروشگاه </p>--}}
{{--    </a>--}}
{{--    <a href="my-account.html" class="sticky-link">--}}
{{--        <i class="w-icon-account"></i>--}}
{{--        <p>حساب کاربری </p>--}}
{{--    </a>--}}
{{--    <div class="cart-dropdown dir-up">--}}
{{--        <a href="cart.html" class="sticky-link">--}}
{{--            <i class="w-icon-cart"></i>--}}
{{--            <p>سبد خرید </p>--}}
{{--        </a>--}}
{{--        <div class="dropdown-box">--}}
{{--            <div class="products">--}}
{{--                <div class="product product-cart">--}}
{{--                    <div class="product-detail">--}}
{{--                        <h3 class="product-name">--}}
{{--                            <a href="product-default.html">یاس بافتنی بژ<br>کفش دونده تیک</a>--}}
{{--                        </h3>--}}
{{--                        <div class="price-box">--}}
{{--                            <span class="product-quantity">1</span>--}}
{{--                            <span class="product-price">250000 تومان</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <figure class="product-media">--}}
{{--                        <a href="product-default.html">--}}
{{--                            <img src="/front/assets/images/cart/product-1.jpg" alt="product" height="84"--}}
{{--                                 width="94"/>--}}
{{--                        </a>--}}
{{--                    </figure>--}}
{{--                    <button class="btn btn-link btn-close">--}}
{{--                        <i class="fas fa-times"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--                <div class="product product-cart">--}}
{{--                    <div class="product-detail">--}}
{{--                        <h3 class="product-name">--}}
{{--                            <a href="product-default.html">پینا ابزار آبی<br>لباس جین جلو</a>--}}
{{--                        </h3>--}}
{{--                        <div class="price-box">--}}
{{--                            <span class="product-quantity">1</span>--}}
{{--                            <span class="product-price">320000 تومان</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <figure class="product-media">--}}
{{--                        <a href="product-default.html">--}}
{{--                            <img src="/front/assets/images/cart/product-2.jpg" alt="product" width="84"--}}
{{--                                 height="94"/>--}}
{{--                        </a>--}}
{{--                    </figure>--}}
{{--                    <button class="btn btn-link btn-close">--}}
{{--                        <i class="fas fa-times"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="cart-total">--}}
{{--                <label>مجموع کل: </label>--}}
{{--                <span class="price">570000 تومان</span>--}}
{{--            </div>--}}

{{--            <div class="cart-action">--}}
{{--                <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">نمایش سبد </a>--}}
{{--                <a href="checkout.html" class="btn btn-primary  btn-rounded">پرداخت </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End of Dropdown Box -->--}}
{{--    </div>--}}

{{--    --}}{{--        <div class="header-search hs-toggle dir-up">--}}
{{--    --}}{{--            <a href="#" class="search-toggle sticky-link">--}}
{{--    --}}{{--                <i class="w-icon-search"></i>--}}
{{--    --}}{{--                <p>جستجو</p>--}}
{{--    --}}{{--            </a>--}}
{{--    --}}{{--            <form action="#" class="input-wrapper">--}}
{{--    --}}{{--                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="جستجو"--}}
{{--    --}}{{--                    required />--}}
{{--    --}}{{--                <button class="btn btn-search" type="submit">--}}
{{--    --}}{{--                    <i class="w-icon-search"></i>--}}
{{--    --}}{{--                </button>--}}
{{--    --}}{{--            </form>--}}
{{--    --}}{{--        </div>--}}
{{--</div>--}}
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top -->
<a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i
        class="fas fa-chevron-up"></i></a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
    {{--            <form action="#" method="get" class="input-wrapper">--}}
    {{--                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="جستجو"--}}
    {{--                    required />--}}
    {{--                <button class="btn btn-search" type="submit">--}}
    {{--                    <i class="w-icon-search"></i>--}}
    {{--                </button>--}}
    {{--            </form>--}}
    <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">منوی اصلی </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="/">صفحه اصلی </a></li>
                    <li><a href="mailto:{{ $settings['CONTACT_US_MAIL']['value'] }}">تماس با ما</a></li>
                    @auth()
                        <li><a href="{{ route('dashboard') }}">حساب کاربری من </a></li>
                    @else
                        <li><a href="{{ route('register') }}">ثبت نام </a></li>
                        <li><a href="{{ route('login') }}">ورود </a></li>
                    @endauth
                    <li class="">
                        <a href="#">اخبار و محتوا<span class="toggle-btn"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('posts.show.list') }}">همه</a></li>
                            @foreach($post_cats as $cat)
                                <li>
                                    <a href="#">{{ $cat->name }}<span class="toggle-btn"></span></a>
                                    <ul>
                                        @foreach($cat->posts as $p)
                                            <li><a href="{{ route('posts.show.detail', $p->slug) }}">{{ $p->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-tshirt2"></i>مدل
                        </a>
                        <ul>
                            <li>
                                <a href="#">زنانه </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تازه رسیده ها </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">فروش برتر </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">پرطرفدار </a></li>
                                    <li><a href="shop-fullwidth-banner.html">لباس </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کفش </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کیسه ها </a></li>
                                    <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">جواهری و ساعت </a></li>
                                    <li><a href="shop-fullwidth-banner.html">ویژه </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">مردانه </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تازه رسیده ها </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">فروش برتر </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">پرطرفدار </a></li>
                                    <li><a href="shop-fullwidth-banner.html">لباس </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کفش </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کیسه ها </a></li>
                                    <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">جواهری و ساعت </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-home"></i>خانه و باغ
                        </a>
                        <ul>
                            <li>
                                <a href="#">بدروم </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تخت ها ، قاب ها و پایه ها</a></li>
                                    <li><a href="shop-fullwidth-banner.html">کمد </a></li>
                                    <li><a href="shop-fullwidth-banner.html">نیمکت خواب </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">تختخواب و تابلوهای مخصوص بچه ها</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">زره پوش ها </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">اتاق خواب 2</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">میز های قهوه </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">صندلی </a></li>
                                    <li><a href="shop-fullwidth-banner.html">جداول </a></li>
                                    <li><a href="shop-fullwidth-banner.html">تخت خواب های مبل و مبل</a></li>
                                    <li><a href="shop-fullwidth-banner.html">کابینت و سینه</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">دفتر</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">صندلی های اداری </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">میزها </a></li>
                                    <li><a href="shop-fullwidth-banner.html">قفسه های کتاب </a></li>
                                    <li><a href="shop-fullwidth-banner.html">قفسه پوشه ها </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">اتاق غذاخوری </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">آشپزخانه و غذاخوری</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">مجموعه های غذاخوری </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">کابینت های نگهداری آشپزخانه</a></li>
                                    <li><a href="shop-fullwidth-banner.html">قفسه های بشیرز</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">صندلی غذاخوری</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">اتاق غذاخوری جداول </a></li>
                                    <li><a href="shop-fullwidth-banner.html">مدفوع بار</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-electronics"></i>الکترونیکها
                        </a>
                        <ul>
                            <li>
                                <a href="#">لپ تاپ و کامپیوتر</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">کامپیوترهای رومیزی</a></li>
                                    <li><a href="shop-fullwidth-banner.html">مانیتور </a></li>
                                    <li><a href="shop-fullwidth-banner.html">لپ تاپ </a></li>
                                    <li><a href="shop-fullwidth-banner.html">درایوها و فضای ذخیره سازی</a></li>
                                    <li><a href="shop-fullwidth-banner.html">کامپیوتر تجهیزات جانبی </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">تلویزیون و ویدئو</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تلویزیون</a></li>
                                    <li><a href="shop-fullwidth-banner.html">بلندگوهای صوتی خانگی</a></li>
                                    <li><a href="shop-fullwidth-banner.html">پروژکتورها</a></li>
                                    <li><a href="shop-fullwidth-banner.html">دستگاههای پخش رسانه</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">دوربین های دیجیتال </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">دوربین های دیجیتال SLR</a></li>
                                    <li><a href="shop-fullwidth-banner.html">دوربین های ورزشی و اکشن</a></li>
                                    <li><a href="shop-fullwidth-banner.html">لنزهای دوربین </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">چاپگر عکس </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">کارت های حافظه دیجیتال</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">تلفن های همراه </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تلفن های حامل </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">گوشی های قفل شده </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">قاب گوشی و موبایل</a></li>
                                    <li><a href="shop-fullwidth-banner.html">شارژرهای تلفن همراه</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-furniture"></i>مبلمان
                        </a>
                        <ul>
                            <li>
                                <a href="#">مبلمان </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">مبل و نیمکت </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html"> نرم صندلی </a></li>
                                    <li><a href="shop-fullwidth-banner.html">قاب های تخت </a></li>
                                    <li><a href="shop-fullwidth-banner.html">میزهای کنار تخت </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">میزهای آرایش</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="#">روشنایی </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">لامپ های روشنایی </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">لامپ </a></li>
                                    <li><a href="shop-fullwidth-banner.html">چراغ سقف </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">چراغ های دیواری </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">حمام روشنایی </a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="#">صفحه اصلی جانبی </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">لوازم جانبی تزئینی </a></li>
                                    <li><a href="shop-fullwidth-banner.html">شمع و نگهدارنده</a></li>
                                    <li><a href="shop-fullwidth-banner.html">رایحه خانگی</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">آینه </a></li>
                                    <li><a href="shop-fullwidth-banner.html">ساعت ها </a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="#">باغ و فضای باز</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">باغ مبلمان </a></li>
                                    <li><a href="shop-fullwidth-banner.html">چمن زنها</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">واشرهای تحت فشار</a></li>
                                    <li><a href="shop-fullwidth-banner.html">همه ابزار باغ</a></li>
                                    <li><a href="shop-fullwidth-banner.html">غذاخوری در فضای باز</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-heartbeat"></i>زیبایی و سلامتی
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-gift"></i>کارت هدیه
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-gamepad"></i>بازی و اسباب بازی
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ice-cream"></i>آشپزی
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ios"></i>تلفن هوشمند
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-camera"></i>دوربین ها و عکس
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ruby"></i>تجهیزات جانبی
                        </a>
                    </li>
                    {{-- <li>
                        <a href="shop-banner-sidebar.html"
                            class="font-weight-bold text-primary text-uppercase ls-25">
                            نمایش تمام دسته بندیها<i class="w-icon-angle-right"></i>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Mobile Menu -->

<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky mb-0">
                <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                    <figure class="product-image">
                        <img src="/front/assets/images/products/popup/1-440x494.jpg"
                             data-zoom-image="/front/assets/images/products/popup/1-800x900.jpg"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                    <figure class="product-image">
                        <img src="/front/assets/images/products/popup/2-440x494.jpg"
                             data-zoom-image="/front/assets/images/products/popup/2-800x900.jpg"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                    <figure class="product-image">
                        <img src="/front/assets/images/products/popup/3-440x494.jpg"
                             data-zoom-image="/front/assets/images/products/popup/3-800x900.jpg"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                    <figure class="product-image">
                        <img src="/front/assets/images/products/popup/4-440x494.jpg"
                             data-zoom-image="/front/assets/images/products/popup/4-800x900.jpg"
                             alt="Water Boil Black Utensil" width="800" height="900">
                    </figure>
                </div>
                <div class="product-thumbs-wrap">
                    <div class="product-thumbs">
                        <div class="product-thumb active">
                            <img src="/front/assets/images/products/popup/1-103x116.jpg" alt="Product Thumb"
                                 width="103" height="116">
                        </div>
                        <div class="product-thumb">
                            <img src="/front/assets/images/products/popup/2-103x116.jpg" alt="Product Thumb"
                                 width="103" height="116">
                        </div>
                        <div class="product-thumb">
                            <img src="/front/assets/images/products/popup/3-103x116.jpg" alt="Product Thumb"
                                 width="103" height="116">
                        </div>
                        <div class="product-thumb">
                            <img src="/front/assets/images/products/popup/4-103x116.jpg" alt="Product Thumb"
                                 width="103" height="116">
                        </div>
                    </div>
                    <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                    <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">ساعت مچی الکترونیکی بلک مچی</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="/front/assets/images/products/brand/brand-1.jpg" alt="Brand" width="102"
                             height="48"/>
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            دسته بندی:
                            <span class="product-category"><a href="#">الکترونیک </a></span>
                        </div>
                        <div class="product-sku">
                            کد: <span>MS46891340</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">40000 تومان</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 نظر )</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                            است.
                        </li>
                        <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                            است.
                        </li>
                        <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                            است.
                        </li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-form product-variation-form product-color-swatch">
                    <label>رنگ:</label>
                    <div class="d-flex align-items-center product-variations">
                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                        <a href="#" class="color" style="background-color: #ccc;"></a>
                        <a href="#" class="color" style="background-color: #333;"></a>
                    </div>
                </div>
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">سایز :</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        <a href="#" class="size">کوچک </a>
                        <a href="#" class="size">متوسط </a>
                        <a href="#" class="size">بزرگ </a>
                        <a href="#" class="size">خیلی بزرگ </a>
                    </div>
                    <a href="#" class="product-variation-clean">حذف همه </a>
                </div>

                <div class="product-variation-price">
                    <span></span>
                </div>

                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>افزودن به سبد </span>
                    </button>
                </div>

                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="https://www.facebook.com/{{ $settings['FACEBOOK_ACCOUNT']['value'] }}"
                               target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="{{ $settings['TWITTER_ACCOUNT']['value'] }}" target="_blank"
                               class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="http://instagram.com/{{ $settings['INSTAGRAM_ACCOUNT']['value'] }}" target="_blank"
                               class="social-icon social-instagram w-icon-instagram"></a>
                            {{--                            <a href="#" class="social-icon social-telegram w-icon-telegram"></a>--}}
                            {{--                            <a href="#" class="social-icon social-youtube w-icon-youtube"></a>--}}
                            {{--                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>--}}
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                        <a href="#" class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->

<!-- Plugin JS File -->
<script src="/front/assets/vendor/jquery/jquery.min.js"></script>
<script src="/front/assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
<script src="/front/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/front/assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="/front/assets/vendor/zoom/jquery.zoom.min.js"></script>
<script src="/front/assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
<script src="/front/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/front/assets/vendor/skrollr/skrollr.min.js"></script>
<script src="/admin/src/js/sweetalert2.min.js"></script>

<!-- Main JS -->
<script src="/front/assets/js/main.min.js"></script>

@yield('Scripts')

</body>
</html>
