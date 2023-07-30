@extends('layouts.frontend-user-side.index-page')
@section('content')
    <livewire:front-livewire-components.quick-view-modal-component/>
    <!-- початок секції показу товарів -->
    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">
                        <div class="widget catagory mb-50">
                            <!--  Side Nav  -->
                            <div class="nav-side-menu">
                                <h6 class="mb-0">Catagories</h6>
                                <div class="menu-list">
                                    <ul id="menu-content2" class="menu-content collapse out">
                                        <!-- Single Item -->
                                        <x-front-components.categories/>
                                        {{-- @foreach ($categories as $category)
                                            <li data-toggle="collapse" data-target="#{{ Str::slug($category->name) }}">
                                                <a href="{{ $category->children->count() > 0 ? '#' : 'http://some.url' }}">{{ $category->name }}<span
                                                        class="{{ $category->children->count() > 0 ? 'arrow' : '' }}"></span></a>
                                                @if ($category->children->count() > 0)
                                                    <ul class="sub-menu collapse show"
                                                        id="{{ Str::slug($category->name) }}">
                                                        @foreach ($category->children as $child)
                                                            <li><a href="#">{{ $child->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <livewire:front-livewire-components.filter-side-bar />
                        <!-- початок секції рекомендованих товарів -->
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
                        <!-- кінець секції рекомендованих товарів -->
                    </div>
                </div>
                <livewire:front-livewire-components.show-products-tape />
            </div>
        </div>
    </section>
    <!-- кінець секції показу товарів -->
@endsection
