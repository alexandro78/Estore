<!-- ****** Offer Area Start ****** -->

<section class="offer_area height-700 section_padding_100 bg-img" style="background-image: {{ is_object($offerImage) ? 'url(' . asset('images/multimedia/' . $offerImage->filename) . ')' : 'url('. asset('images/multimedia/default-image/bg-5.jpg').')' }};">
    <div class="container h-100">
        <div class="row h-100 align-items-end justify-content-end">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                    <h2>{{$product->name}}<span class="karl-level">Hot</span></h2>
                    <p>{{ isset($product->freeShipping) ? $product->freeShipping->title : '' }}</p>
                    <div class="offer-product-price">
                        <h3><span class="regular-price">${{$product->price}}</span> ${{$product->price}}</h3>
                    </div>
                    <a href="#" class="btn karl-btn mt-30">Отримати зараз</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Offer Area End ****** -->