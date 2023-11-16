@section('title')
    Camera Shop
@endsection

@includeIf('frontend.header')

<!-- end menu -->

<section class="body">
    <x-slide-show />

    @foreach ($list_category as $category)
        <product-frontend.product.product-list :rowcate="$category" />
    @endforeach
</section>
<br>
@includeIf('frontend.product.newproduct')
<br>
@includeIf('frontend.product.productsale')
<br>

@includeIf('frontend.footer')

@extends('layouts.master')
@includeIf('frontend.topic.topic')
