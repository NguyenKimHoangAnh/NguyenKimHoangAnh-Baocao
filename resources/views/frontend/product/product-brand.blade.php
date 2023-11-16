@extends('layouts.master')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @isset($brand)
            <title>{{ $brand->name }} Products</title>
        @endisset
    </head>

    <body>
        @isset($brand)
            <h1>{{ $brand->name }} Products</h1>

            <!-- Hiển thị danh sách sản phẩm -->
            @foreach ($list_product as $product)
                <div class="product-item">
                    <h2>{{ $product->name }}</h2>
                    <!-- Hiển thị thông tin sản phẩm -->
                    <p>{{ $product->description }}</p>
                    <p>Price: ${{ $product->price }}</p>
                </div>
            @endforeach

            {{ $list_product->links() }}
        @endisset
    </body>

    </html>
@endsection
