<div class="header-cart-menu d-flex align-items-center ml-auto">
    <!-- Cart Area -->
    @php
        $sessionCart = Session::get('cart');
    @endphp
    <div class="cart">
        @if (Auth::check())
        <a href="#" id="header-cart-btn" target="_blank"><span
                class="cart_quantity">{{ $allProductQuantity }}</span> <i class="ti-bag"></i> В
            кошику {{ $allProductPriseTotal }} грн.</a>
    @else
        <a href="#" id="header-cart-btn" target="_blank"><span
                class="cart_quantity">{{ $allProductQuantity }}</span> <i class="ti-bag"></i> В
            кошику {{ $allProductPriseTotal }} грн.</a>
    @endif
        <!-- Cart List Area Start -->
        <ul class="cart-list">
            @if (Auth::check())
                @if ($productsInCart)
                    @foreach ($productsInCart as $productInCart)
                    <li>
                        <a href="#" class="image"><img src="img/product-img/product-10.jpg" class="cart-thumb"
                                alt=""></a>
                        <div class="cart-item-desc">
                            <h6><a href="#">{{ $productInCart->name}}</a></h6>
                            <p>{{ $productInCart->pivot->quantity  }}x - <span class="price">{{ $productInCart->discount_id ? $productInCart->price - $productInCart->discount->price_off : $productInCart->price }}</span></p>
                        </div>
                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                    </li>
                    @endforeach
                @endif
                <li class="total">
                    <span class="pull-right">Всього: {{  $allProductPriseTotal }} грн.</span>

                    <a href="{{ route('cart') }}" class="btn btn-sm btn-checkout">Cart</a>
                </li>
            @else
                @if ($sessionCart)
                    @foreach ($sessionCart as $item)
                        <li>
                            <a href="#" class="image"><img src="img/product-img/product-10.jpg" class="cart-thumb"
                                    alt=""></a>
                            <div class="cart-item-desc">
                                <h6><a href="#">{{ $item['productName'] }}</a></h6>
                                <p>{{ $item['quantity'] }}x - <span class="price">{{ $item['price'] }}</span></p>
                            </div>
                            <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                        </li>
                    @endforeach
                @endif
                <li class="total">
                    <span class="pull-right">Всього: {{ $allProductPriseTotal }} грн.</span>

                    <a href="{{ route('cart') }}" class="btn btn-sm btn-checkout">Cart</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="header-right-side-menu ml-15">
        <a href="#" id="sideMenuBtn"><i class="ti-menu" aria-hidden="true"></i></a>
    </div>
</div>
