@extends('admin.frontend.main')

@section('content')
 <!-- Hero/Intro Slider Start -->
 <div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            <div style="background-image: url('{{ asset('frontend_asset/images/slider-image/banner1.jpg') }}');" class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2021</h2>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{ asset('frontend_asset/images/slider-image/test1.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single slider item -->
            <div style="background-image: url('{{ asset('frontend_asset/images/slider-image/banner2.jpg') }}');" class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color2">
                <div class="container align-self-center">
                    <div class="row">
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{ asset('frontend_asset/images/slider-image/test1.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category" style="color:aliceblue;">Sale 45% Off</span>
                                <h2 class="title-1" style="color:aliceblue;" >Exclusive New<br> Offer 2021</h2>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Hero/Intro Slider End -->

    <!-- Feature Area Srart -->
    <div class="feature-area  mt-n-65px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- single item -->
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="assets/images/icons/1.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Free Shipping</h4>
                            <span class="sub-title">Capped at $39 per order</span>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="assets/images/icons/2.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Card Payments</h4>
                            <span class="sub-title">12 Months Installments</span>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="assets/images/icons/3.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Easy Returns</h4>
                            <span class="sub-title">Shop With Confidence</span>
                        </div>
                    </div>
                    <!-- single item -->
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area End -->

<!-- Product Area Start -->
<div class="product-area pt-100px pb-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-0">
                    <h2 class="title">#packages</h2>
                    <!-- Tab Start -->
                    <div class="nav-center">
                        <ul class="product-tab-nav nav align-items-center justify-content-center">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-product--all">All</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-product--new">New</a>
                            </li>

                        </ul>
                    </div>
                    <!-- Tab End -->
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            <div class="col">
                <div class="tab-content mb-30px0px">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade show active" id="tab-product--all">
                        <div class="row">
                            @foreach ($packages as $package )
                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                    data-aos-delay="200">
                                    <!-- Single Prodect -->
                                    <div class="product">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img src="{{ asset('uploads/package')}}/{{$package->package_img}}" alt="Product" />
                                            </a>
                                            <span class="badges">
                                                <span class="new">{{ $package->company }}</span>
                                            </span>
                                            <div class="actions">
                                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                        class="pe-7s-like"></i></a>
                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#examle{{$package->id}}"><i class="pe-7s-search"></i></a>
                                                    {{-- <a data-toggle="modal" data-target="#{{ $package->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a> --}}
                                            </div>
                                            <button title="Add To Cart" class=" add-to-cart"><a href="{{ url('/order') }}/{{ $package->id }}">Purchase Now</a></button>
                                        </div>
                                        <div class="content">
                                            <span class="ratings">
                                                <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                                </span>
                                                <span class="rating-num">( 5 Review )</span>
                                            </span>
                                            <h5 class="title"><a href="single-product.html">
                                             {{ $package->package_name }}   </a>
                                            </h5>


                                            <span class="price">
                                                <span class="new">Price: BDT{{$package->package_price}}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

        <!-- Modal area start -->

                                <!-- Modal -->
                            <div class="modal modal-2 fade" id="examle{{$package->id}}" tabindex="-1" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container zoom-top">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="{{ asset('uploads/package')}}/{{$package->package_img}}" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/zoom-image/2.jpg" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/zoom-image/3.jpg" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/zoom-image/4.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-container zoom-thumbs mt-3 mb-3">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/small-image/1.jpg" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/small-image/2.jpg" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/small-image/3.jpg" alt="">
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img class="img-responsive m-auto"
                                                                    src="assets/images/product-image/small-image/4.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                                                    <div class="product-details-content quickview-content">
                                                        <h2>{{ $package->package_name }}</h2>
                                                        <div class="pricing-meta">
                                                            <ul>
                                                                <li class="old-price not-cut">BDT{{ $package->package_price }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="pro-details-rating-wrap">
                                                            <div class="rating-product">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <span class="read-review"><a class="reviews" href="#">( 5 Customer Review
                                                                    )</a></span>
                                                        </div>
                                                        <p class="mt-30px mb-0">{{ $package->package_des }} </p>
                                                        <div class="pro-details-quality">
                                                            {{-- <div class="cart-plus-minus">
                                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                                            </div> --}}
                                                            <div class="pro-details-cart">
                                                                <button class="add-cart" href="#">Purchase Now</button>
                                                            </div>
                                                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                                                <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                                            </div>
                                                            {{-- <div class="pro-details-compare-wishlist pro-details-compare">
                                                                <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                                            </div> --}}
                                                        </div>
                                                        <div class="pro-details-sku-info pro-details-same-style  d-flex">
                                                            <span>SKU: </span>
                                                            <ul class="d-flex">
                                                                <li>
                                                                    <a href="#">Ch-256xl</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                                                            <span>Categories: </span>
                                                            <ul class="d-flex">
                                                                <li>
                                                                    <a href="#">Fashion.</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">eCommerce</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="pro-details-social-info pro-details-same-style d-flex">
                                                            <span>Share: </span>
                                                            <ul class="d-flex">
                                                                <li>
                                                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fa fa-google"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end -->

                            @endforeach



                        </div>
                    </div>
                    <!-- 1st tab end -->
                </div>
                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                        class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

<!-- About Intro Area start-->
<div class="about-intro-area">
    <div class="container position-relative h-100 d-flex align-items-center">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-intro-content">
                    <h2 class="title">About Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius modjior tem incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniamyl quinol exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duisau irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore euhti fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim</p>
                </div>
            </div>
        </div>
        <div class="intro-left">
            <img src="assets/images/about-image/intro-left.png" alt="" class="intro-left-image">
        </div>
        <div class="intro-right">
            <img src="{{ asset('frontend_asset/images/team/1.jpg') }}" alt="" class="intro-right-image">
        </div>
    </div>
</div>

<!-- About Intro Area End-->


<!-- Testimonial Area Start -->
<div class="testimonial-area pb-40px pt-100px ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-0">
                    <h2 class="title line-height-1">#testimonials</h2>
                </div>
            </div>
        </div>
        <!-- Slider Start -->
        <div class="testimonial-wrapper swiper-container">
            <div class="swiper-wrapper">
                <!-- Slider Single Item -->
                <div class="swiper-slide">
                    <div class="testi-inner">
                        <div class="reating-wrap">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="testi-content">
                            <p>Lorem ipsum dolor sit amet, consect adipisici elit, sed do eiusmod tempol incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniamfhq nostrud exercitation.
                            </p>
                        </div>
                        <div class="testi-author">
                            <div class="author-img">
                                <img src="assets/images/testimonial-image/1.png" alt="">
                            </div>
                            <div class="author-name">
                                <h4 class="name">Daisy Morgan</h4>
                                <span class="title">Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single Item -->
                <div class="swiper-slide">
                    <div class="testi-inner">
                        <div class="reating-wrap">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="testi-content">
                            <p>Lorem ipsum dolor sit amet, consect adipisici elit, sed do eiusmod tempol incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniamfhq nostrud exercitation.
                            </p>
                        </div>
                        <div class="testi-author">
                            <div class="author-img">
                                <img src="assets/images/testimonial-image/2.png" alt="">
                            </div>
                            <div class="author-name">
                                <h4 class="name">Leah Chatman</h4>
                                <span class="title">Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single Item -->
                <div class="swiper-slide">
                    <div class="testi-inner">
                        <div class="reating-wrap">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="testi-content">
                            <p>Lorem ipsum dolor sit amet, consect adipisici elit, sed do eiusmod tempol incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniamfhq nostrud exercitation.
                            </p>
                        </div>
                        <div class="testi-author">
                            <div class="author-img">
                                <img src="assets/images/testimonial-image/3.png" alt="">
                            </div>
                            <div class="author-name">
                                <h4 class="name">Reyna Chung</h4>
                                <span class="title">Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single Item -->
                <div class="swiper-slide">
                    <div class="testi-inner">
                        <div class="reating-wrap">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="testi-content">
                            <p>Lorem ipsum dolor sit amet, consect adipisici elit, sed do eiusmod tempol incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniamfhq nostrud exercitation.
                            </p>
                        </div>
                        <div class="testi-author">
                            <div class="author-img">
                                <img src="assets/images/testimonial-image/1.png" alt="">
                            </div>
                            <div class="author-name">
                                <h4 class="name">Daisy Morgan</h4>
                                <span class="title">Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single Item -->
                <div class="swiper-slide">
                    <div class="testi-inner">
                        <div class="reating-wrap">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="testi-content">
                            <p>Lorem ipsum dolor sit amet, consect adipisici elit, sed do eiusmod tempol incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniamfhq nostrud exercitation.
                            </p>
                        </div>
                        <div class="testi-author">
                            <div class="author-img">
                                <img src="assets/images/testimonial-image/2.png" alt="">
                            </div>
                            <div class="author-name">
                                <h4 class="name">Reyna Chung</h4>
                                <span class="title">Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single Item -->
            </div>
        </div>
        <!-- Slider Start -->
    </div>
</div>
<!-- Testimonial Area End -->






@endsection
