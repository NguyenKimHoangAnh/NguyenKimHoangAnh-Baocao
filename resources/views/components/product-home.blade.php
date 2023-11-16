<div>
    <div class="container">
        <div class="row py-3">
            <div class="col-md-12 border-bottom border-1 border-danger">
                <a class="float-start text-danger" style="text-decoration: none"
                    href="{{ route('slug.index',['slug'=>$cat->slug]) }}">
                    <h4 class="text-center">{{ $cat->name }}</h4>
                </a>
            </div>
        </div>
        <div class="container mt-3 overflow-hidden text-center">
            <div class="row">
                @foreach ($list_product as $product) 
                <div class="col-md-3 py-3  bg-light">
                    <div class="product-item boder">
                        <div class="product-image">
                            <a href="{{ route('slug.index',['slug'=>$product->slug]) }}">
                                <img class="boder boder-2 img-fluid" src="{{ asset('images/product/'. $product->image)}}"
                                    alt="">
                            </a>
                        </div>
                        <div class="product-name py-1">
                            <h5>
                                <a class=" text-dark " style="text-decoration: none"
                                    href="{{ route('slug.index',['slug'=>$product->slug]) }}">
                                    <p class="fs-6 text-truncate"> {{ $product->name}}</p>

                                </a>
                                <p>Giá: {{ number_format($product->price)}}₫</p>
                            </h5>
                        </div>
                        <div class="product-price-cart">
                            <div class="row">
                                <div>
                                    <a class="btn btn-sm btn-danger text-center"
                                        href=""><i
                                            class="fas fa-cart-plus">
                                        </i> Thêm vào giỏ hàng
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>