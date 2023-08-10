<div>
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
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
                                        <img src="img/product-img/product-1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ optional($product)->name ?? '' }}</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        @if (isset($product) && !is_null($product->discount))
                                            <h5 class="price">{{ $product->price - $product->discount->price_off }}
                                                <span> {{ $product->price }} </span>
                                            </h5>
                                        @else
                                            <h5 class="price">{{ optional($product)->price ?? '' }}</h5>
                                        @endif
                                        <p>{{ optional($product)->description ?? '' }}</p>
                                        <a href="{{route('go.to.single.product', ['id' => optional($product)->id ?? 1])}}">go to single product</a>
                                    </div>
                                    <!-- Add to Cart Form" -->
                                    <form class="cart">
                                        <div class="quantity">
                                            <span class="qty-minus"
                                                onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></span>

                                            <input type="number" class="qty-text" id="qty" step="1"
                                                min="1" max="12" name="quantity" value="1">

                                            <span class="qty-plus"
                                                onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                        <button style="{{ isset($checkIfItemAdded) ? 'background-color: green; color: white;' : ''}}" type="submit" name="addtocart" value="{{ $productId }}" class="cart-submit">{{ isset($checkIfItemAdded) ? 'Added' : 'Add to cart'}}</button>
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
    <script>
        document.addEventListener('DOMContentLoaded',
            function() { // Получаем ссылки на кнопку и элемент ввода количества по их классам
                // Получить элемент формы
                const addToCartButton = document.querySelector('.cart-submit');
                const quantityInput = document.querySelector('.qty-text');

                // Добавляем обработчик события 'click' на кнопку
                addToCartButton.addEventListener('click', function() {
                    event.preventDefault();
                    const quantityValue = quantityInput.value;
                    var productId = addToCartButton.getAttribute('value');
                    addToCartButton.style.backgroundColor = 'green';
                    addToCartButton.textContent = 'Added';
                    console.log(quantityValue); // Вы можете здесь использовать значение по вашему усмотрению
                    console.log(productId); // Вы можете здесь использовать значение по вашему усмотрению
                    
                    const data = {
                        quantity: quantityValue,
                        productId: productId,
                    };

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/add-to-cart-from-modal');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            console.log('Data sended');
                        }
                    };
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.send(JSON.stringify(data));
                });
            });
    </script>
</div>
