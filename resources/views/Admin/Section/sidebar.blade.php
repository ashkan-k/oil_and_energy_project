<aside class="left-sidebar">
    <ul id="slide-out" class="sidenav">

        <li>
            <ul class="collapsible">
                <li class="small-cap"><span class="hide-menu">پنل iroilmarket</span></li>

                <li>
                    <a href="{{ route('dashboard') }}" class="collapsible-header"><i
                            class="material-icons">dashboard</i><span
                            class="hide-menu"> داشبورد </span></a>
                </li>

                <li>
                    <a href="{{ route('profile') }}" class="collapsible-header"><i
                            class="material-icons">account_circle</i><span
                            class="hide-menu"> اطلاعات کاربری </span></a>
                </li>

                @if(auth()->user()->is_superuser)
                    <li class="small-cap"><span class="hide-menu">مدیریت</span></li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">group</i><span class="hide-menu">کاربران</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('users.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">کاربر جدید</span></a>
                                </li>
                                <li><a href="{{ route('users.index') }}"><i
                                            class="material-icons">adjust</i><span class="hide-menu">لیست کاربران</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">widgets</i><span class="hide-menu">دسته بندی</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('parent_categories.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">دسته بندی جدید</span></a>
                                </li>
                                <li><a href="{{ route('parent_categories.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">لیست دسته بندی ها</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">widgets</i><span class="hide-menu">مدیریت جداول</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('categories.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">جدول جدید</span></a>
                                </li>
                                <li><a href="{{ route('categories.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">لیست جدول ها</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">compare</i><span class="hide-menu">تصاویر اسلایدر</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('sliders.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">اسلایدر جدید</span></a>
                                </li>
                                <li><a href="{{ route('sliders.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">لیست اسلایدر ها</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="small-cap"><span class="hide-menu">محتوا و مقالات</span></li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">developer_board</i><span class="hide-menu">دسته بندی محتوا و مقالات</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('post_categories.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">دسته بندی جدید</span></a>
                                </li>
                                <li><a href="{{ route('post_categories.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">دسته بندی مقالات</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">receipt</i><span class="hide-menu">محتوا و مقالات</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('posts.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">محتوا و مقاله جدید</span></a>
                                </li>
                                <li><a href="{{ route('posts.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">محتوا و مقالات</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif


                <li class="small-cap"><span class="hide-menu">جداول رایگان</span></li>

                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">apps</i><span
                            class="hide-menu">جدول ها رایگان</span></a>
                    <div class="collapsible-body">
                        <ul>
                            @foreach($free_categories as $item)
                                <li><a href="{{ route('free_tables.index' , $item->slug) }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">{{ $item->name }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>


                @if(auth()->user()->get_subscription())
                    <li class="small-cap"><span class="hide-menu">جداول اشتراکی</span></li>

                    @foreach($cash_categories as $cash_c)

                        <li><a href="{{ route('tables.childs.list',$cash_c->slug) }}"><i class="material-icons">adjust</i><span
                                    class="hide-menu">{{ \Illuminate\Support\Str::limit($cash_c->name,50) }}</span></a></li>

                    @endforeach

{{--                    @foreach($cash_categories as $cash_c)--}}
{{--                        <li>--}}
{{--                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i--}}
{{--                                    class="material-icons">apps</i><span--}}
{{--                                    class="hide-menu">{{ \Illuminate\Support\Str::limit($cash_c->name,50) }}</span></a>--}}
{{--                            <div class="collapsible-body">--}}
{{--                                <ul class="collapsible" data-collapsible="accordion">--}}
{{--                                    @foreach($cash_c->childs as $item)--}}

{{--                                        @if(count($item->childs) > 0)--}}

{{--                                            <li>--}}
{{--                                                <a class="collapsible-header has-arrow">--}}
{{--                                                    <i class="material-icons">apps</i>--}}
{{--                                                    <span--}}
{{--                                                        class="nav-text">{{ \Illuminate\Support\Str::limit($item->name,20) }}</span>--}}
{{--                                                </a>--}}
{{--                                                <div class="collapsible-body">--}}
{{--                                                    <ul class="collapsible" data-collapsible="accordion">--}}

{{--                                                        @foreach($item->childs as $nested_ch)--}}

{{--                                                            <li>--}}
{{--                                                                <a href="{{ route('tables.index' , $nested_ch->slug) }}">--}}
{{--                                                                    <i class="material-icons">grade</i>--}}
{{--                                                                    <span--}}
{{--                                                                        class="hide-menu">{{ \Illuminate\Support\Str::limit($nested_ch->name,20) }}</span>--}}
{{--                                                                </a>--}}
{{--                                                            </li>--}}

{{--                                                        @endforeach--}}

{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}

{{--                                        @else--}}

{{--                                            <li><a href="{{ route('tables.index' , $item->slug) }}"><i--}}
{{--                                                        class="material-icons">grade</i><span--}}
{{--                                                        class="hide-menu">{{ \Illuminate\Support\Str::limit($item->name,20) }}</span></a>--}}
{{--                                            </li>--}}

{{--                                        @endif--}}

{{--                                    @endforeach--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
                @endif

                @if(auth()->user()->is_superuser)
                    <li class="small-cap"><span class="hide-menu">پیکربندی</span></li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">money</i><span class="hide-menu">تراکنش ها</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('payments.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">لیست تراکنش ها</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">brightness_7</i><span class="hide-menu">تنظیمات</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('settings.create') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">تنظیمات جدید</span></a>
                                </li>
                                <li><a href="{{ route('settings.index') }}"><i
                                            class="material-icons">adjust</i><span
                                            class="hide-menu">لیست تنظیمات</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </li>
    </ul>
</aside>
