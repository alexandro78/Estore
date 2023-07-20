<div class="col-12 col-md-8 col-lg-9">
    <div class="shop_grid_product_area">
        <div class="row">
            @if($products)
            @foreach($products as $product)
            <!-- Single gallery Item -->
            <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                <!-- Product Image -->
                <div class="product-img">
                    <img src="img/product-img/product-1.jpg" alt="">
                    <div class="product-quicview">
                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                    </div>
                </div>
                <!-- Product Description -->
                <div class="product-description">
                    <h4 class="product-price">$ {{ $product->price }}</h4> {{-- {{$product->price}} --}}
                    <p>{{ $minVal }} {{ $maxVal }} {{ $product->name}} {{ $product->description }}</p>{{-- {{$product->description}} --}}
                    <!-- Add to Cart -->
                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
            </ul>
        </nav>
    </div>

</div>