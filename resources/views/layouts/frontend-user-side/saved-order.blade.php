@extends('layouts.frontend-user-side.index-page')
@section('content')
    <!-- ****** Checkout Area Start ****** -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading">
                            <h5 style="color:green;">Замовлення відправлено!</h5>
                            <p>Дякуємо за чудове замовлення!
                                Найближчим часом ми зателефонуємо для уточнення деталей 📞 😌
                            </p>
                        </div>

                        <form>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <input type="text" class="form-control" id="first_name" value="№ замовлення:" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="last_name" value="37877329" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="text" class="form-control" id="first_name" value="Дата:" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="last_name" value="19.08.2023" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="text" class="form-control" id="first_name" value="Час:" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="last_name" value="11:45"readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Місто доставки</label>
                                    <input type="text" class="form-control" id="city" value="Дніпро" readonly>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="phone_number">Телефон підтримки</label>
                                    <input type="text" class="form-control" id="phone_number" min="0"
                                        value="38050 888 3027" readonly>
                                </div>
                            </div>
                        </form>
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
                            @foreach ($cartItems as $cartItem)
                                <li><span>{{ $cartItem->product->name }} - ({{ $cartItem->quantity }} шт.)</span>
                                    <span>{{ $cartItem->product->price }} грн.</span>
                                </li>
                            @endforeach
                            <li><span>Доставка</span>
                                <span>{{ $selectedShippingMethod == 1 ? 'Нова пошта' : 'УкрПошта' }}</span>
                            </li>
                            <li><span>Всього</span> <span>{{ $billSum }} грн.</span></li>
                        </ul>
                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Метод
                                            доставки</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo"><i
                                                class="fa fa-circle-o mr-3"></i>Метод оплати</a>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a style="background-color:#484747;" href="#" class="btn karl-checkout-btn" id="submit-order-btn">Переглянути інші товари</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Checkout Area End ****** -->
@endsection
