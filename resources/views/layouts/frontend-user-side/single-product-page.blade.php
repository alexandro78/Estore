@extends('layouts.frontend-user-side.index-page')
@section('content')
    <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dresses</a></li>
                        <li class="breadcrumb-item active">Long Dress</li>
                    </ol>
                    <!-- btn -->
                    <a href="#" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to
                        Category</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
    <section class="single_product_details_area section_padding_0_100">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                                <li class="active" data-target="#product_details_slider" data-slide-to="0"
                                    style="background-image: url({{ asset('img/product-img/product-9.jpg') }});">
                                </li>
                                <li data-target="#product_details_slider" data-slide-to="1"
                                    style="background-image: url({{ asset('img/product-img/product-2.jpg') }});">
                                </li>
                                <li data-target="#product_details_slider" data-slide-to="2"
                                    style="background-image: url({{ asset('img/product-img/product-3.jpg') }});">
                                </li>
                                <li data-target="#product_details_slider" data-slide-to="3"
                                    style="background-image: url({{ asset('img/product-img/product-4.jpg') }});">
                                </li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a class="gallery_img" href="{{ asset('img/product-img/product-9.jpg') }}">
                                        <img class="d-block w-100" src="{{ asset('img/product-img/product-9.jpg') }}"
                                            alt="First slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a class="gallery_img" href="{{ asset('img/product-img/product-2.jpg') }}">
                                        <img class="d-block w-100" src="{{ asset('img/product-img/product-2.jpg') }}"
                                            alt="Second slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a class="gallery_img" href="{{ asset('img/product-img/product-3.jpg') }}">
                                        <img class="d-block w-100" src="{{ asset('img/product-img/product-3.jpg') }}"
                                            alt="Third slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a class="gallery_img" href="{{ asset('img/product-img/product-4.jpg') }}">
                                        <img class="d-block w-100" src="{{ asset('img/product-img/product-4.jpg') }}"
                                            alt="Fourth slide">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cart-anchor" class="col-12 col-md-6">
                    <div id="size-section" class="single_product_desc">

                        <h4 class="title"><a href="#"> {{ $product->name }}</a></h4>
                        @if (isset($product) && !is_null($product->discount))
                            <h4 class="price">$ {{ $product->price - $product->discount->price_off }} <span
                                    style="font-size: 14px; color: grey; text-decoration: line-through;">
                                    {{ $product->price }} </span> </h4>
                        @else
                            <h4 class="price">$ {{ $product->price }} </h4>
                        @endif
                        <p class="available">Available: <span
                                class="text-muted">{{ $product->in_stock == 1 ? 'In Stock' : 'Out of stock' }}
                            </span></p>

                        <div class="single_product_ratings mb-15">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>

                        <div class="widget size mb-50">
                            <h6 class="widget-title">Size</h6>
                            <div class="widget-desc">
                                <ul>
                                    @if ($sizes)
                                        @foreach ($sizes as $size)
                                            @if (isset($productSizeId))
                                                <li class="{{ $productSizeId == $size->id ? 'li-size-elem' : '' }}"><a
                                                        href="{{ route('get.product.by.size', ['id' => $product->id, 'productSizeId' => $size->id]) }}#size-section">{{ $size->size }}</a>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{ route('get.product.by.size', ['id' => $product->id, 'productSizeId' => $size->id]) }}#size-section">{{ $size->size }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <form class="cart clearfix mb-50 d-flex" method="post"
                            action="{{ route('cart.add.from.single.product.page', ['id' => $product->id, 'price' => $product->price]) }}#cart-anchor">
                            @csrf
                            <div class="quantity">
                                <span class="qty-minus"
                                    onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                        class="fa fa-minus" aria-hidden="true"></i></span>
                                <input type="number" class="qty-text" id="qty" step="1" min="1"
                                    max="12" name="quantity" value="1">
                                <span class="qty-plus"
                                    onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                        class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>

                            {{-- //FIXME: Місце додавання товару в кошик або сесійний кошик зі сторінки окремого товару. --}}
                            @if (Auth::check())
                                {{-- auth()->check() --}}
                                @if ($cartItem)
                                    <button style="background-color: green;" type="submit" name="addtocart"
                                        value="5" class="btn cart-submit d-block">ADDED</button>
                                @else
                                    <button type="submit" name="addtocart" value="5"
                                        class="btn cart-submit d-block">ADD TO CART</button>
                                @endif
                            @else
                                @if ($sessionCart)
                                    <button style="background-color: green;" type="submit" name="addtocart"
                                        value="5" class="btn cart-submit d-block">ADDED555</button>
                                @else
                                    <button type="submit" name="addtocart" value="5"
                                        class="btn cart-submit d-block">ADD TO CART555</button>
                                @endif
                            @endif
                        </form>

                        <div id="accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">Information</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">Деталі розміру</a>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        @if (isset($productSizeId) && isset($sizeDetail))
                                            <p>{{ $sizeDetail->description }} </p>
                                        @else
                                            <p>Оберіть розмір щоб побачити його деталі!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">shipping &amp; Returns</a>
                                    </h6>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint
                                            repudiandae suscipit ab soluta delectus voluptate, vero vitae, tempore maxime
                                            rerum iste dolorem mollitia perferendis distinctio. Quibusdam laboriosam rerum
                                            distinctio. Repudiandae fugit odit, sequi id!</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae qui maxime
                                            consequatur laudantium temporibus ad et. A optio inventore deleniti ipsa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

    <!-- ****** Quick View Modal Area Start ****** -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img src="{{ asset('img/product-img/product-1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99<span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                            quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium
                                            eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <span class="qty-minus"
                                                onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></span>

                                            <input type="number" class="qty-text" id="qty2" step="1"
                                                min="1" max="12" name="quantity" value="1">

                                            <span class="qty-plus"
                                                onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add
                                            to cart 881</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                        </div>
                                    </form>

                                    <div class="share_wf mt-30">
                                        <p>Share With Friend</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
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
    <!-- ****** Quick View Modal Area End ****** -->

    <section class="you_may_like_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h2>related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="you_make_like_slider owl-carousel">

                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ asset('img/product-img/product-1.jpg') }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">$39.90</h4>
                                <p>Jeans midi cocktail dress</p>
                                <!-- Add to Cart -->
                                <a href="#" class="add-to-cart-btn">ADD TO CART 1</a>
                            </div>
                        </div>

                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ asset('img/product-img/product-2.jpg') }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">$39.90</h4>
                                <p>Jeans midi cocktail dress</p>
                                <!-- Add to Cart -->
                                <a href="#" class="add-to-cart-btn">ADD TO CART 2</a>
                            </div>
                        </div>

                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ asset('img/product-img/product-3.jpg') }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">$39.90</h4>
                                <p>Jeans midi cocktail dress</p>
                                <!-- Add to Cart -->
                                <a href="#" class="add-to-cart-btn">ADD TO CART 3</a>
                            </div>
                        </div>

                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ asset('img/product-img/product-4.jpg') }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">$39.90</h4>
                                <p>Jeans midi cocktail dress</p>
                                <!-- Add to Cart -->
                                <a href="#" class="add-to-cart-btn">ADD TO CART 4</a>
                            </div>
                        </div>

                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ asset('img/product-img/product-5.jpg') }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">$39.90</h4>
                                <p>Jeans midi cocktail dress</p>
                                <!-- Add to Cart -->
                                <a href="#" class="add-to-cart-btn">ADD TO CART 5</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
