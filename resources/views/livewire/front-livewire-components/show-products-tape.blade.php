<div class="col-12 col-md-8 col-lg-9">
    <div class="shop_grid_product_area">
        <div class="row">
            @if ($products)
                @foreach ($products as $product)
                    <!-- Single gallery Item -->
                    <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s" wire:click="$emit('updateFilter')">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="img/product-img/product-1.jpg" alt="">
                            <div class="product-quicview" wire:click="$emit('clickedOnModal', {{$product->id}})">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div wire:click="$emit('updateFilter')" class="product-description">
                            <h4 class="product-price">$ {{ $product->price }}</h4>
                            <p>{{ $product->name }} {{ $product->description }}</p>
                            <!-- Add to Cart -->
                            @if (isset($productIdsInCart) && in_array($product->id, $productIdsInCart))
                            <a href="#" class="added-marker add-to-cart-btn" wire:click="addToCart({{ $product->id }})">ADDED</a>
                            @else
                                <a href="#" class="add-to-cart-btn" wire:click="addToCart({{ $product->id }})">ADD TO CART</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    {{ $products->links('layouts.frontend-user-side.pagination-view-snipet') }}
</div>
