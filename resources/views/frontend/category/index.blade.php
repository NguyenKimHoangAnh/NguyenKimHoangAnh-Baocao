<!-- resources/views/brands/index.blade.php -->
@includeIf('frontend.header')
@section('title')
    Danh Mục Sản Phẩm
@endsection

@extends('layouts.master')

<style>
    .category-container {
        display: flex;
        flex-wrap: wrap;
    }

    .category-item {
        width: 300px;
        margin: 10px;
        overflow: hidden;
        border: 2px solid #333;
        /* Đường viền đậm hơn (màu đen) và kích thước 2px */
        border-radius: 8px;
        /* Góc bo */
    }

    .product-image {
        max-width: 100%;
        height: auto;
        cursor: pointer;
    }

    .category-link {
        text-decoration: none;
        color: inherit;
        display: block;
        text-align: center;
    }
</style>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('dist/img/sp.png') }}');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#33FFFF ;">
        Danh Mục Sản Phẩm
    </h2>
</section>
<br>
<div class="container">
    <div class="category-container">
        @isset($category)
            @foreach ($category as $cat)
                <div class="category-item">
                    <a class="category-link" href="{{ route('products.category', $cat->id) }}">
                        <img class="product-image" src="{{ asset('images/category/' . $cat->image) }}"
                            alt="{{ $cat->name }}">

                        <!-- Thêm các thông tin khác cần hiển thị -->
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
</div>
