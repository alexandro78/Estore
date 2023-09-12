@extends('layouts.frontend-user-side.index-page')
@section('content')
    <!-- ****** Cart Area Start ****** -->
    <div id="cart-clear" class="cart_area section_padding_100 clearfix">
        <div id="cart-update" class="container">
            <div class="row">
                <div class="col-12">
                    <form id="update-cart-form" method="post" action="{{ route('update.cart') }}#cart-update">
                        @csrf
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{-- //FIXME: місце виводу продуктів в кошику --}}

                                    @if (1 != 1)
                                        {{-- auth()->check() --}}
                                        @if ($productsInCart)
                                            @foreach ($productsInCart as $productInCart)
                                                <tr>
                                                    <td class="cart_product_img d-flex align-items-center">
                                                        <a href="#"><img src="img/product-img/product-9.jpg"
                                                                alt="Product"></a>

                                                        <h6>{{ $productInCart->name }}</h6>
                                                    </td>
                                                    <td class="price">
                                                        <span>{{ $productInCart->discount_id ? $productInCart->price - $productInCart->discount->price_off : $productInCart->price }}$</span>
                                                    </td>
                                                    <td class="qty">
                                                        <div class="quantity">
                                                            <span class="qty-minus"
                                                                onclick="var effect = document.getElementById('{{ 'qty' . $productInCart->id }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                                    class="fa fa-minus" aria-hidden="true"></i></span>
                                                            <input type="number" class="qty-text"
                                                                id="{{ 'qty' . $productInCart->id }}" step="1"
                                                                min="1" max="99"
                                                                name="quantities[{{ $productInCart->id }}]"
                                                                value="{{ $productInCart->pivot->quantity }}">
                                                            <span class="qty-plus"
                                                                onclick="var effect = document.getElementById('{{ 'qty' . $productInCart->id }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                                    class="fa fa-plus" aria-hidden="true"></i></span>
                                                        </div>
                                                    </td>
                                                    <td class="total_price">
                                                        <span>{{ $productInCart->discount_id ? ($productInCart->price - $productInCart->discount->price_off) * $productInCart->pivot->quantity : $productInCart->price * $productInCart->pivot->quantity }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @else
                                        @if (isset($sessionCart))
                                            @foreach ($sessionCart as $productId => $productInfo)
                                                <tr>
                                                    <td class="cart_product_img d-flex align-items-center">
                                                        <a href="#"><img src="img/product-img/product-9.jpg"
                                                                alt="Product"></a>

                                                        <h6>{{ $productInfo['productName'] }}</h6>
                                                    </td>
                                                    <td class="price">
                                                        <span>{{ $productInfo['price'] }}$</span>
                                                    </td>
                                                    <td class="qty">
                                                        <div class="quantity">
                                                            <span class="qty-minus"
                                                                onclick="var effect = document.getElementById('{{ 'qty' . $productId }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                                    class="fa fa-minus" aria-hidden="true"></i></span>
                                                            <input type="number" class="qty-text"
                                                                id="{{ 'qty' . $productId }}" step="1" min="1"
                                                                max="99" name="quantities[{{ $productId }}]"
                                                                value="{{ $productInfo['quantity'] }}">
                                                            <span class="qty-plus"
                                                                onclick="var effect = document.getElementById('{{ 'qty' . $productId }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                                    class="fa fa-plus" aria-hidden="true"></i></span>
                                                        </div>
                                                    </td>
                                                    <td class="total_price"><span>{{ $productInfo['total'] }}$</span></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop w-50">
                                <a href="{{ route('products') }}#search">Continue shooping</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <a href="{{ route('clear.cart') }}#cart-clear">clear cart</a>
                                <a id="update-cart" href="#">Update cart</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="coupon-code-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Cupon code</h5>
                            <p>Enter your cupone code</p>
                        </div>
                        <form>
                            @csrf
                            <input type="search" name="search" placeholder="#569ab15">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <form id="checkout-form" method="post" action="{{ route('checkout') }}">
                        @csrf
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Shipping method</h5>
                                <p>Select the one you want</p>
                            </div>
                            @if ($errors->any())
                                <div id="chipping-error" class="alert alert-danger">
                                    <ul>
                                        <li>{{ 'Оберіть службу доставки!' }}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio1" name="radio-input" value="1"
                                    class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio1"><span>Нова пошта</span>{{-- <span>1-5 днів (в середньому) </span> --}}</label>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio2" name="radio-input" value="2"
                                    class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio2"><span>УкрПошта</span>{{-- <span>3-14 днів </span> --}}</label>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Cart total</h5>
                            <p>Final info</p>
                        </div>

                        <ul class="cart-total-chart">
                            {{-- <li><span>Subtotal</span> <span>$59.90</span></li>
                            <li><span>Shipping</span> <span>Free</span></li> --}}
                            <li><span><strong>Total</strong></span>
                                <span><strong>{{ $allProductPriseTotal }}$</strong></span>
                            </li>
                        </ul>
                        <a id="proceed-to-checkout" href="checkout.html" class="btn karl-checkout-btn">Proceed to
                            checkout</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.getElementById('update-cart').addEventListener('click', function(event) {
            event.preventDefault(); // Cancel the default action of following a link

            document.getElementById('update-cart-form').submit(); // Simulating a form submission
        });

        document.getElementById('proceed-to-checkout').addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('checkout-form').submit();
        });
    </script>
    <!-- ****** Cart Area End ****** -->
@endsection
