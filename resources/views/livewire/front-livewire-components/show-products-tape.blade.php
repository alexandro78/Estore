<div class="col-12 col-md-8 col-lg-9">
    <div id="search" class="shop_grid_product_area">
        <div class="row">
            @php
                $sessionCart = Session::get('cart');
            @endphp
            @if ($products)
                @foreach ($products as $product)
                    <!-- Single gallery Item -->
                    <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s"
                        wire:click="$emit('updateFilter')">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="img/product-img/product-1.jpg" alt="">
                            <div class="product-quicview" wire:click="$emit('clickedOnModal', {{ $product->id }})">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i
                                        class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div wire:click="$emit('updateFilter')" class="product-description">
                            @if (isset($product) && !is_null($product->discount))
                                <h4 style="text-decoration: line-through;" class="product-price">$ {{ $product->price }}
                                </h4>
                                <h4 style="color: #e29d11;" class="product-price">$
                                    {{ $product->price - $product->discount->price_off }}</h4>
                            @else
                                <h4 class="product-price">$ {{ $product->price }}</h4>
                            @endif
                            <p>{{ $product->name }} {{ $product->description }}</p>
                            <!-- Add to Cart -->
                            {{-- //FIXME: Місце додавання товару в кошик або сесійний кошик з сторінки списку товарів. --}}
                            @if (1 == 1)
                                @if (
                                    (isset($productIdsInCart) && in_array($product->id, $productIdsInCart)) ||
                                        (isset($productsIdInCart[$product->id]) && $productsIdInCart[$product->id]))
                                    <a href="#" class="added-marker add-to-cart-btn"
                                        wire:click="$emit('addToCart',{{ $product->id }})">ADDED</a>
                                @else
                                    <a href="#" class="add-to-cart-btn"
                                        wire:click="$emit('addToCart',{{ $product->id }})">ADD TO CART</a>
                                @endif
                            @else
                                @if (isset($sessionCart) && array_key_exists($product->id, $sessionCart))
                                    <a href="#" class="added-marker add-to-cart-btn"
                                        wire:click="$emit('addToCart',{{ $product->id }})">ADDED</a>
                                @else
                                    <a href="#" class="add-to-cart-btn"
                                        wire:click="$emit('addToCart',{{ $product->id }})">ADD TO CART</a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    {{ $products->links('layouts.frontend-user-side.pagination-view-snipet') }}
</div>
