@extends('layouts.frontend-user-side.index-page')
@section('content')
    <!-- ****** Checkout Area Start ****** -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading">
                            <h5>Адреса замовлення</h5>
                            <p>Наявного купону немає</p>
                        </div>

                        <form id="submit-order" action="{{ route('save.new.order') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">Ім'я <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Прізвище <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="company">Назва компанії </label>
                                    <input type="text" class="form-control" id="company" name="company"
                                        placeholder="поле не обов'язкове">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="country">Країна <span>*</span></label>
                                    <select class="custom-select d-block w-100" id="country" name="country">
                                        <option value="ua">Україна</option>
                                        {{-- <option value="uk">United Kingdom</option>
                                        <option value="ger">Germany</option>
                                        <option value="fra">France</option>
                                        <option value="ind">India</option>
                                        <option value="aus">Australia</option>
                                        <option value="bra">Brazil</option>
                                        <option value="cana">Canada</option> --}}
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="delivery-point">№ Відділення для отримання замовлення <span>*</span></label>
                                    <input type="text" class="form-control" id="delivery-point" name="delivery_point">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="street_address">Назва вулиці, № будинку, № квартири{{-- <span>*</span> --}}
                                    </label>
                                    <input type="text" class="form-control mb-3" id="street_address"
                                        name="street_address" placeholder="поле не обов'язкове">
                                </div>


                                <div class="col-12 mb-3">
                                    <label for="postcode">Індекс {{-- <span>*</span> --}}</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                        placeholder="поле не обов'язкове">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Місто <span>*</span></label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                                <!-- <div class="col-12 mb-3">
                                                                                                <label for="state">Province <span>*</span></label>
                                                                                                <input type="text" class="form-control" id="state" value="">
                                                                                            </div> -->
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Телефон <span>*</span></label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        min="0" value="">
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="email_address">Email <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address" name="email_address">
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            name="terms_of_agreement">
                                        <label class="custom-control-label" for="customCheck1">Згоден з умовами користування
                                            сайтом</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2"
                                            name="create_account">
                                        <label class="custom-control-label" for="customCheck2">Створити акаунт</label>
                                    </div>
                                    {{-- <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Subscribe to our
                                            newsletter</label>
                                    </div> --}}
                                </div>
                            </div>

                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Деталі замовлення</h5>
                            <p>The Details</p>
                        </div>


                        <ul class="order-details-form mb-4">
                            <li><span>Товар</span> <span>сума</span></li>
                            @if ($productsInCart)
                                @foreach ($productsInCart as $productInCart)
                                    <li><span> {{ $productInCart->name }} - ({{ $productInCart->pivot->quantity }})
                                            шт.</span>
                                        <span>{{ $productInCart->discount_id ? ($productInCart->price - $productInCart->discount->price_off) * $productInCart->pivot->quantity : $productInCart->price * $productInCart->pivot->quantity }}
                                            грн.</span>
                                    </li>
                                @endforeach
                            @else
                                @foreach ($sessionCart as $productData)
                                    <li><span>{{ $productData['productName'] }} - ({{ $productData['quantity'] }}) шт.
                                        </span>
                                        <span>{{ $productData['price'] }} грн.</span>
                                    </li>
                                @endforeach
                            @endif
                            <li><span>Доставка</span>
                                <span>{{ $selectedShippingMethod == 1 ? 'Нова пошта' : 'УкрПошта' }}</span>
                            </li>
                            <li><span>Всього</span> <span>{{ $allProductPriseTotal }} грн.</span></li>
                        </ul>


                        <div id="accordion" role="tablist" class="mb-4">

                            <div class="shipping-method-area mt-70">
                                <div class="cart-page-heading">
                                    <h5>Метод оплати та доставки</h5>
                                    <p>оберіть варіант</p>
                                </div>

                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio1" name="payment_method" value="Передплата"
                                        class="custom-control-input">
                                    <label class="custom-control-label d-flex align-items-center justify-content-between"
                                        for="customRadio1"><span>Передплата</span>{{-- <span>1-5 днів (в середньому) </span> --}}</label>
                                </div>

                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio2" name="payment_method"
                                        value="Наложений платіж" class="custom-control-input">
                                    <label class="custom-control-label d-flex align-items-center justify-content-between"
                                        for="customRadio2"><span>Наложений платіж</span>{{-- <span>3-14 днів </span> --}}</label>
                                </div>
                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio3" name="payment_method"
                                        value="Передплата, кур'єрська
                                    доставка"
                                        class="custom-control-input">
                                    <label class="custom-control-label d-flex align-items-center justify-content-between"
                                        for="customRadio3"><span>Передплата, кур'єрська
                                            доставка</span>{{-- <span>3-14 днів </span> --}}</label>
                                </div>
                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio4" name="payment_method"
                                        value="Наложений платіж, кур'єрська
                                    доставка"
                                        class="custom-control-input">
                                    <label class="custom-control-label d-flex align-items-center justify-content-between"
                                        for="customRadio4"><span>Наложений платіж, кур'єрська
                                            доставка</span>{{-- <span>3-14 днів </span> --}}</label>
                                </div>
                            </div>
                        </div>
                        </form>
                        <a href="#" class="btn karl-checkout-btn" id="submit-order-btn">Відправити замовлення</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submitOrderBtn = document.getElementById("submit-order-btn");
            const submitOrderForm = document.getElementById("submit-order");

            submitOrderBtn.addEventListener("click", function(event) {
                event.preventDefault(); // Отменяем стандартное действие ссылки

                // Теперь программно вызываем событие отправки формы
                submitOrderForm.submit();
            });
        });
    </script>
    <!-- ****** Checkout Area End ****** -->
@endsection
