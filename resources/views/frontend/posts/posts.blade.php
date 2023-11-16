<!DOCTYPE html>
<html>
<head>
    <title>Bài Viết</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .how-bor1 {
            margin-bottom: 80px; /* Thay đổi giá trị này để điều chỉnh khoảng cách giữa các ảnh */
        }
    </style>
</head>
<body>
    @includeIf('frontend.header')

    @extends('layouts.master')

    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('dist/img/1.png') }}');">
        <h2 class="ltext-105 cl0 txt-center" style="color:#33FFFF ;">
            Bài Viết
        </h2>
    </section>

    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            <div class="row p-b-148 clearfix">
                @php
                    $page = 1;
                    $postsPerPage = 4;
                @endphp
                @foreach($posts as $index => $post)
                    @if($index >= ($page - 1) * $postsPerPage && $index < $page * $postsPerPage)
                        <div class="col-md-7 col-lg-8">
                            <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                                <h3 class="mtext-111 cl2 p-b-16">
                                    <a href="{{ route('frontend.postdetail', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="stext-113 cl6 p-b-26">
                                    {{ $post->content }}
                                </p>
                                
                            </div>
                        </div>

                        <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                            <div class="how-bor1">
                                <img class="product-image img-fluid" src="{{ asset('images/post/' . $post->image) }}" alt="IMG">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                        @include('frontend.pagination')
                        
            </div>
        </div>
    </section>
</body>
</html>