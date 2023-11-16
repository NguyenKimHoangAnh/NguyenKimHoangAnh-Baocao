@extends('layouts.master')

<!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
<div class="container mt-4">
    <div id="thongbao" class="alert alert-danger d-none face" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <h1 class="text-center">Giỏ hàng</h1>
    <div class="row">
        <div class="col col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="datarow">
                    @isset($list_product)
                        @foreach ($list_product as $product)
                            <tr>
                                <td>
                                    <input type="number" value="{!! $product->id !!}" class="product_id">
                                </td>
                                <td>
                                    <img class="product-image" src="{!! asset('images/product/' . $product->image) !!}" class="card-img-top">
                                </td>
                                <td>
                                    <h1 class="product-name">{!! $product->name !!}</h1>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <input type="number" name="qty" id="qty_{{ $product->id }}" value="{!! $product->qty !!}" min="1" class="text-right">
                                        <input type="hidden" value="{!! $product->quantity !!}" class="product_qty">
                                    </div>
                                </td>
                                <td class="text-right">{!! $product->price_sale !!}</td>
                                <td class="text-right">{!! $product->price_sale * $product->qty !!}</td>
                                <td>
                                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                                    <a data-sp-ma="{!! $product->id !!}" class="btn btn-danger btn-delete-sanpham">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                    </a>
                                </td>
                            </tr>  
                        @endforeach
                    @endisset      
                </tbody>
            </table>

            <a href="../index.html" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Quay về trang chủ</a>
            <a href="checkout.html" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thanh toán</a>
        </div>
    </div>
</div>