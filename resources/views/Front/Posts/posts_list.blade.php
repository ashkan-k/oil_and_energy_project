@extends('layouts.front-master')

@section('content')
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">{{ request('slug') ?: 'لیست مقالات' }}</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb-6">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">صفحه اصلی </a></li>
                    <li><a href="{{ route('posts.show.list') }}">وبلاگ </a></li>
                    <li>لیست</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content pb-2">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">

                        @foreach($posts as $p)
                            <article class="post post-list post-listing mb-md-10 mb-6 pb-2 overlay-zoom mb-4">
                                <figure class="post-media br-sm">
                                    <a href="{{ route('posts.show.detail', $p->slug) }}">
                                        <img src="{{ $p->image }}" width="930" height="500" alt="blog">
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-cats text-primary">
                                        <a href="{{ route('posts.show.list', $p->post_category->slug) }}">{{ $p->post_category->name }}</a>
                                    </div>
                                    <h4 class="post-title">
                                        <a href="{{ route('posts.show.detail', $p->slug) }}">{{ $p->title }}</a>
                                    </h4>
                                    <div class="post-content">
                                        <p>{{ \Illuminate\Support\Str::limit($p->short_text, 100) }}</p>
                                        <a href="{{ route('posts.show.detail', $p->slug) }}"
                                           class="btn btn-link btn-primary">(ادامه مطلب )</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            {!! $posts->links() !!}
                        </div>
                    </div>
                    @include('Front.components.posts_sidebar')
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection
