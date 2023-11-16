<!-- resources/views/brands/index.blade.php -->
@includeIf('frontend.header')
@section('title')
    Thương Hiệu Sản Phẩm
@endsection

@extends('layouts.master')

<style>
    .brand-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Khoảng cách giữa các ảnh */
        }

        .brand-item {
            width: 300px;
            margin: 0;
            overflow: hidden;
            border: 2px solid #333; /* Màu đường viền đậm hơn (#333 là màu đen) */
            border-radius: 8px; /* Góc bo */
        }

        .product-image {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .brand-link {
            text-decoration: none;
            color: inherit;
            display: block;
            text-align: center;
        }
</style>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('dist/img/brands.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#33FFFF ;">
        Thương Hiệu Sản Phẩm
    </h2>
</section>
<br>
<div class="container">
    <div class="brand-container">
        @isset($brands)
            @foreach ($brands as $brand)
                <div class="brand-item">
                    <a class="brand-link" href="{{ route('products.brands', $brand->id) }}">
                        <img class="product-image" src="{{ asset('images/brand/' . $brand->image) }}"
                            alt="{{ $brand->name }}">

                        <!-- Thêm các thông tin khác cần hiển thị -->
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
</div>
