@php
    use Carbon\Carbon;
@endphp
<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
            <button class="btn active" data-filter="*">ALL</button>
            @foreach ($categories as $category)
                <button class="btn" data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row karl-new-arrivals">
            @foreach ($categories as $category)
                @foreach ($category->products as $product)
                    @php
                        $dateUpdated = Carbon::parse($product->updated_at ?? $product->created_at);
                        $diffInDays = $dateUpdated->diffInDays(Carbon::now());
                        
                        $mainImage = $product->images->where('is_main', 1)->first();
                        $imagePath = $mainImage ? $mainImage->filename : 'product-2.jpg';
                        $imageUrl = $mainImage ? asset('images/multimedia/' . $mainImage->filename) : asset('img/product-img/' . $imagePath);
                    @endphp

                    @if ($diffInDays <= 14)
                        <!-- Single gallery Item Start -->
                        <div class="col-12 col-sm-6 col-md-4 single_gallery_item {{ Str::slug($category->name) }} wow fadeInUpBig"
                            data-wow-delay="0.2s">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ $imageUrl }}" alt="">
                                <div class="product-quicview">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="ti-plus"></i></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <h4 class="product-price">{{ $product->price . ' грн.' }}</h4>
                                <p>{{ $product->name }}</p>
                                <!-- Add to Cart -->
                                @if ($cartItems->isNotEmpty())
                                    @foreach ($cartItems as $cartItem)
                                        <a href="#" class="add-to-cart-btn"
                                            data-product-id="{{ 1 }}">{{ $cartItem->product_id == $product->id ? 'ADDED' : 'ADD TO CART' }}</a>
                                    @endforeach
                                @else
                                    <a href="#" class="add-to-cart-btn" data-product-id="{{ 1 }}">ADD
                                        TO CART</a>
                                @endif
                            </div>
                        </div>
                    @else
                        <!-- Bestsellers -->
                        <div class="col-12 col-sm-6 col-md-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                            @foreach ($bestsellers as $product)
                                @php
                                    $mainImage = $product->images->where('is_main', true)->first();
                                    $imagePath = $mainImage ? $mainImage->filename : 'product-2.jpg';
                                    $imageUrl = $mainImage ? asset('images/multimedia/' . $mainImage->filename) : asset('img/product-img/' . $imagePath);
                                @endphp
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="{{ $imageUrl }}" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">{{ $product->price . ' грн.' }}</h4>
                                    <p>{{ $product->name }}</p>
                                    <!-- Add to Cart -->
                                    @if ($cartItems->isNotEmpty())
                                        @foreach ($cartItems as $cartItem)
                                        <a href="#" class="add-to-cart-btn" data-product-id="{{ 1 }}">{{ $cartItem->product_id == $product->id ? 'ADDED' : 'ADD TO CART' }}</a>
                                        @endforeach
                                    @else
                                        <a href="#" class="add-to-cart-btn"
                                            data-product-id="{{ 1 }}">ADD
                                            TO CART</a>
                                    @endif
                                </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- ****** New Arrivals Area End ****** -->

<script> 
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    function addToCart(event) {
        event.preventDefault();

        const button = event.target;
        const productId = event.target.getAttribute('data-product-id');

        if (button.innerHTML !== 'ADDED') {
            button.innerHTML = 'ADDED';

            const data = {
                productId: productId
            };

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/add-to-cart');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    // Обработка ответа сервера здесь
                    console.log(response);
                }
            };
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(JSON.stringify(data));
        }
    }

</script>
