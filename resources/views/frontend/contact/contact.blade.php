@extends('layouts.site')

@section('title')
    Liên hệ
@endsection

@includeIf('frontend.header')

<head>
    <!-- Các thẻ meta và các tệp stylesheet khác -->
    <script src="{{ asset('dist/js/contactController.js') }}"></script>
</head>

{{-- Thay thế nội dung vào Placeholder `custom-css` của view `frontend.layouts.master` --}}
@section('custom-css')
@endsection

{{-- Thay thế nội dung vào Placeholder `main-content` của view `frontend.layouts.master` --}}
@section('main-content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('dist/img/lien-he.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center" style="color:#33FFFF ;">
            Liên Hệ
        </h2>
    </section>

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116" ng-controller="contactController">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('frontend.contact.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" maxlength="20">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung liên hệ</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <!-- Địa chỉ và thông tin liên hệ -->
                    <h4>
                        Địa chỉ liên hệ
                    </h4>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>
                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Địa chỉ
                            </span>
                            <p class="stext-115 cl6 size-213 p-t-18">
                                Đỗ Xuân Hợp - Phước Long B - Tp.Thủ Đức - Tp.Hồ Chí Minh
                            </p>
                        </div>
                    </div>
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>
                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Đường dây nóng
                            </span>
                            <p class="stext-115 cl1 size-213 p-t-18">
                                0383149188
                            </p>
                        </div>
                    </div>
                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>
                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Email hỗ trợ
                            </span>
                            <p class="stext-115 cl1 size-213 p-t-18">
                                thienkhaicv@gmail.com
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bản đồ Địa chỉ Shop -->
                <div class="row mt-4">
                    <div class="col-md-12 text-center mb-4">
                        <h2>Địa chỉ Google Map</h2>
                    </div>
                    <div class="col-md-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15675.805499332162!2d106.76456004429173!3d10.815033206067431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317526f6c2f03f5b%3A0xf739b7a2f84408f6!2zxJDhu5cgWHXDom4gSOG7o3AsIFBoxrDhu5tjIExvbmcgQiwgUXXhuq1uIDksIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1697966428048!5m2!1svi!2s"
                            width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Thay thế nội dung vào Placeholder `custom-scripts` của view `frontend.layouts.master` --}}
@section('custom-scripts')
    <script>
        // Khai báo controller `contactController`
        app.controller('contactController', function($scope, $http) {
            // hàm submit form sau khi đã kiểm tra các ràng buộc (validate)
            $scope.submitContactForm = function() {
                // kiểm tra các ràng buộc là hợp lệ, gởi AJAX đến action 
                if ($scope.contactForm.$valid) {
                    // ...
                }
            };
        });
    </script>
@endsection

