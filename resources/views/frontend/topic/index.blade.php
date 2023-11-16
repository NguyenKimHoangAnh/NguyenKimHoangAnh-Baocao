@includeIf('frontend.header')
@extends('layouts.master')

<head>
    <title>Chủ Đề Bài Viết</title>
    <link rel="stylesheet" type="text/css" href="topic.css">
    <style>
        .how-bor1 {
            margin-bottom: 80px; /* Thay đổi giá trị này để điều chỉnh khoảng cách giữa các ảnh */
        }
    </style>
</head>
 <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('dist/img/topic.png') }}');">
        <h2 class="ltext-105 cl0 txt-center" style="color:#33FFFF ;">
            Bài viết theo chủ đề
        </h2>
    </section>
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148 clearfix">
            <div class="col-md-3">
                <ul class="nav nav-pills flex-column">
                    @foreach($topics as $topic)
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showPosts({{ $topic->id }})">{{ $topic->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                @foreach($topics as $topic)
                    <div id="topic-{{ $topic->id }}" style="display: none;">
                        <h2>{{ $topic->name }}</h2>

                        @foreach($posts as $post)
                            @if($post->topic_id == $topic->id)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="p-t-7 p-r-15-lg p-r-0-md">
                                            <h3 class="mtext-111 cl2 p-b-16">
                                                <a href="{{ route('frontend.postdetail', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                            </h3>
                                            <p class="stext-113 cl6 p-b-26">
                                                {{ $post->content }}
                                            </p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="how-bor1">
                                            <img class="product-image img-fluid" src="{{ asset('images/post/' . $post->image) }}" alt="IMG">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function showPosts(topicId) {
            // Ẩn tất cả các phần tử chứa bài viết
            const postContainers = document.querySelectorAll('[id^="topic-"]');
            postContainers.forEach(container => {
                container.style.display = 'none';
            });

            // Hiển thị phần tử chứa bài viết tương ứng với chủ đề được chọn
            const selectedContainer = document.getElementById(`topic-${topicId}`);
            selectedContainer.style.display = 'block';
        }
    </script>
</section>