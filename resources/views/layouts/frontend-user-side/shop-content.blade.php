@extends('layouts.frontend-user-side.index-page')
@section('content')
    <livewire:front-livewire-components.quick-view-modal-component />
    <!-- start of the product display section -->
    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">
                        <div class="widget catagory mb-50">
                            <!--  Side Nav  -->
                            <div class="nav-side-menu">
                                <h6 class="mb-0">Catagories</h6>
                                <livewire:front-livewire-components.category-livewire-component />
                            </div>
                        </div>
                        <livewire:front-livewire-components.filter-side-bar />
                         <!-- start of the recommended products section -->
                        <div class="widget recommended">
                            <h6 class="widget-title mb-30">Recommended</h6>

                            <div class="widget-desc">
                                <!-- Single Recommended Product -->
                                <div class="single-recommended-product d-flex mb-30">
                                    <div class="single-recommended-thumb mr-3">
                                        <img src="img/product-img/product-10.jpg" alt="">
                                    </div>
                                    <div class="single-recommended-desc">
                                        <h6>Men’s T-shirt</h6>
                                        <p>$ 39.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of recommended products section -->
                    </div>
                </div>
                <livewire:front-livewire-components.show-products-tape />
            </div>
        </div>
    </section>
    <!-- end of product display section -->
@endsection
