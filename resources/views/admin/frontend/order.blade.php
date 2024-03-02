@extends('admin.frontend.main')

@section('content')


    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Order</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Order Request</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <div class="row center">
                <div class="col-aligncenter col-lg-6" style="float:none;margin:auto;">
                    <div class="card">
                        @if (Auth::user())
                        <div class="card-header">
                            <h4>You Are A Manager .You Can Not Order.</h4>
                        </div>
                        @else

                        <div class="card-header">
                            <h4>Billing Address</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/orderrequest') }}" method="POST">
                                @csrf
                                <input name="package_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $package_id }}" required >
                                <div class="form-group">
                                    <label for="" class="form-label-control">Give Your Full Name</label>
                                    <input type="text" class="form-control" name="customer_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Give Your Email Address</label>
                                    <input type="email" class="form-control" name="customer_email" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Give Your Phone Number</label>
                                    <input type="text" class="form-control" name="customer_phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Give Your Address</label>
                                    <input type="text" class="form-control" name="customer_location" required>
                                </div>

                                <div class="from-group">
                                    <button type="submit" style="text-align: center; border-radius:0px; background:#5b93d3 !important;" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
                {{-- <div class="col-lg-6 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        <li><span class="order-middle-left">Product Name X 1</span> <span
                                                class="order-price">$100 </span></li>
                                        <li><span class="order-middle-left">Product Name X 1</span> <span
                                                class="order-price">$100 </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li>Free shipping</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>$100</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-1" class="collapsed"
                                                        aria-expanded="true">Direct bank transfer</a>
                                                </h4>
                                            </div>
                                            <div id="my-account-1" class="panel-collapse collapse show"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-2" aria-expanded="false"
                                                        class="collapsed">Check payments</a></h4>
                                            </div>
                                            <div id="my-account-2" class="panel-collapse collapse"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-3">Cash on delivery</a></h4>
                                            </div>
                                            <div id="my-account-3" class="panel-collapse collapse"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <a class="btn-hover" href="#">Place Order</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- checkout area end -->
@endsection
