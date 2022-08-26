<!-- End of Main Content -->
<aside class="sidebar right-sidebar blog-sidebar sidebar-fixed sticky-sidebar-wrapper">
    <div class="sidebar-overlay">
        <a href="#" class="sidebar-close">
            <i class="close-icon"></i>
        </a>
    </div>
    <a href="#" class="sidebar-toggle">
        <i class="fas fa-chevron-left"></i>
    </a>
    <div class="sidebar-content">
        <div class="pin-wrapper">
            <div class="sticky-sidebar"
                 style="border-bottom: 0px none rgb(102, 102, 102); width: 318.75px;">
                <div class="widget widget-search-form">
                    <div class="widget-body">
                        <form class="input-wrapper input-wrapper-inline">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="جستجو در وبلاگ"
                                   autocomplete="off">
                            <button type="submit" class="btn btn-search"><i class="w-icon-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- End of Widget search form -->
                <div class="widget widget-categories">
                    <h3 class="widget-title bb-no mb-0">دسته بندی ها </h3>
                    <ul class="widget-body filter-items search-ul">
                        @foreach($post_cats as $cat)
                            <li><a href="{{ route('posts.show.list', $cat->slug) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- End of Widget categories -->
                <div class="widget widget-posts">
                    <h3 class="widget-title bb-no">پست های محبوب </h3>
                    <div class="widget-body">
                        <div class="owl-carousel owl-theme owl-nav-top owl-loaded owl-drag"
                             data-owl-options="{
                                                'nav': true,
                                                'dots': false,
                                                'margin': 20
                                            }">

                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                     style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 678px;">
                                    <div class="owl-item active"
                                         style="width: 318.75px; margin-right: 20px;">
                                        <div class="widget-col">
                                            @foreach($top_posts as $p)
                                                <div class="post-widget mb-4">
                                                    <figure class="post-media br-sm">
                                                        <img src="{{ $p->image }}"
                                                             alt="Blog" width="150" height="150">
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="{{ route('posts.show.detail', $p->slug) }}"
                                                               class="post-date">{{ $p->created_at }}</a>
                                                        </div>
                                                        <h4 class="post-title">
                                                            <a href="{{ route('posts.show.detail', $p->slug) }}">{{ $p->title }}</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
