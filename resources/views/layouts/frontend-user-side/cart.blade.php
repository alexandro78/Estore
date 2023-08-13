@extends('layouts.frontend-user-side.index-page')
@section('content')
    <!-- ****** Cart Area Start ****** -->
    <div class="cart_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form id="updateCartForm" method="post" action="{{ route('update.cart') }}">
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
                                    @if (1 != 1)
                                        {{-- auth()->check() --}}
                                        @foreach ($cartProducts as $cartProduct)
                                            <tr>
                                                <td class="cart_product_img d-flex align-items-center">
                                                    <a href="#"><img src="img/product-img/product-9.jpg"
                                                            alt="Product"></a>

                                                    <h6>{{ $cartProduct->product->name }}</h6>
                                                </td>
                                                <td class="price">
                                                    <span>{{ optional($cartProduct->product->discount)->price_off ? $cartProduct->product->price - $cartProduct->product->discount->price_off : $cartProduct->product->price }}$</span>
                                                </td>
                                                <td class="qty">
                                                    <div class="quantity">
                                                        <span class="qty-minus"
                                                            onclick="var effect = document.getElementById('{{ 'qty' . $cartProduct->id }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                                class="fa fa-minus" aria-hidden="true"></i></span>
                                                        <input type="number" class="qty-text"
                                                            id="{{ 'qty' . $cartProduct->id }}" step="1"
                                                            min="1" max="99"
                                                            name="quantities[{{ $cartProduct->product->id }}]"
                                                            value="{{ $cartProduct->quantity }}">
                                                        <span class="qty-plus"
                                                            onclick="var effect = document.getElementById('{{ 'qty' . $cartProduct->id }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                                class="fa fa-plus" aria-hidden="true"></i></span>
                                                    </div>
                                                </td>
                                                <td class="total_price"><span>{{ $cartProduct->total }}$</span></td>
                                            </tr>
                                        @endforeach
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
                                <a href="shop-grid-left-sidebar.html">Continue shooping</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <a href="#">clear cart</a>
                                <a id="updateCart" href="#">Update cart</a>
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
                        <form action="#">
                            <input type="search" name="search" placeholder="#569ab15">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="shipping-method-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Shipping method</h5>
                            <p>Select the one you want</p>
                        </div>

                        <div class="custom-control custom-radio mb-30">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between"
                                for="customRadio1"><span>Next day delivery</span><span>$4.99</span></label>
                        </div>

                        <div class="custom-control custom-radio mb-30">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between"
                                for="customRadio2"><span>Standard delivery</span><span>$1.99</span></label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between"
                                for="customRadio3"><span>Personal Pickup</span><span>Free</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Cart total</h5>
                            <p>Final info</p>
                        </div>

                        <ul class="cart-total-chart">
                            <li><span>Subtotal</span> <span>$59.90</span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span><strong>Total</strong></span> <span><strong>$59.90</strong></span></li>
                        </ul>
                        <a href="checkout.html" class="btn karl-checkout-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('updateCart').addEventListener('click', function(event) {
            event.preventDefault(); // Cancel the default action of following a link

            document.getElementById('updateCartForm').submit(); // Simulating a form submission
        });
    </script>
    <!-- ****** Cart Area End ****** -->
@endsection
