@section('title')
    Chi Tiết Sản Phẩm
@endsection

@includeIf('frontend.header')
@extends('layouts.master')

<head>
    <link rel="stylesheet" href="{{ asset('dist/css/price.css') }}">
    <style>
        .custom-outline-red {
            border: 1px solid red !important;
            color: red !important;
        }
    </style>
    <style>
        .contact-share {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .share {
            display: inline-flex;
            align-items: center;
        }


        .social-icons {
            display: inline-flex;
        }

        .social-icon {
            margin-right: 5px;
        }

        .custom-justify-right {
            justify-content: flex-end;
        }

        .button-container {
            margin-bottom: 20px;
            margin-left: -20px;
        }

        .btn-addcart-detail {
            /* Thêm các thuộc tính CSS cho nút "Thêm vào giỏ hàng" ở đây */
            /* Ví dụ: */
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-addwish-b2 {
            /* Thêm các thuộc tính CSS cho biểu tượng trái tim ở đây */
            /* Ví dụ: */
            display: block;
            position: relative;
        }
    </style>
</head>
<div class="container mt-5 mb-5">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <div class="d-flex align-items-center custom-justify-right">
            <a href="{{ route('site.product') }}" class="back-link">
                <i class="fa fa-long-arrow-left"></i>
                <span class="ml-1">Quay lại</span>
            </a>
        </div>


        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="slick3 gallery-lb">
                            <div class="col-md-6">
                                <div class="images p-3">
                                    <div class="text-center p-4">
                                        <a href="{{ asset('images/product/' . $product->image) }}">
                                            <img class="product-image"
                                                src="{{ asset('images/product/' . $product->image) }}" width="400" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        <h1 class="product-name">{{ $product->name }}</h1>
                    </h4>

                    <span class="mtext-106 cl2">
                        <div class="d-flex align-items-center flex-row">
                            <img src="{{ asset('images/product/sale.png') }}" width="20">
                            <span class="guarantee">Giảm giá sập sàn</span>
                        </div>
                        <h2 class="product-price">
                            @if ($product->price_sale)
                                <del>Giá:{{ $product->price }} VND</del> {{ $product->price_sale }} VND
                            @else
                                {{ $product->price }} VND
                            @endif
                        </h2>
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                    <p class="product-description">{{ $product->metadesc }}</p>
                    </p>

                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Chọn Size
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="time">
                                        <option>Size</option>
                                        <option>Size S</option>
                                        <option>Size M</option>
                                        <option>Size L</option>
                                        <option>Size XL</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>


                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty"
                                        id="qty" value="{{ $product->qty }}">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                <div class="button-container">
                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                                <div class="contact-share">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-md-6 share">
                                           
                                            <a href="#" class="d-flex align-items-center">
                                                <img src="{{ asset('images/product/phone.png') }}" width="15">
                                                <span class="ml-2">0983149188</span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 share">
                                            
                                            <div class="d-flex">
                                                <!-- Thêm các biểu tượng mạng xã hội để chia sẻ tại đây -->
                                                <a href="#" class="social-icon"><img
                                                        src="{{ asset('images/product/zalo.png') }}"
                                                        width="30"></a>
                                                <a href="#" class="social-icon"><img
                                                        src="{{ asset('images/product/mes.png') }}" width="30"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
