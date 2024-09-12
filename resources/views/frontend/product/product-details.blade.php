@extends('frontend.master')
<div class="container">
  <div class="row">
        <div class="col-md-12 mt-4">
            @section('meta-url'){{ route('front.product-details', ['slug' => $product->slug]) }}@endsection
            @section('og-url'){{ route('front.product-details', ['slug' => $product->slug]) }}@endsection
            @section('og-image'){{ $product->image }} @endsection
        </div>
    </div>
</div>
@section('body')
    <div class="courses-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">


                <div class="col-md-3">
                    <div class="card">
                        <div class="py-2 text-center">
                            <a href="{{ route('front.show-product-pdf', ['content_id' => $product->id]) }}"
                            class="btn rounded-0 btn-outline-success ">একটু পড়ে দেখুন</a>
                        </div>
                        <div class="mt-3 blog_card_img">
                            <img src="{{ asset(isset($product->image) ? $product->image : 'frontend/logo/biddabari-card-logo.jpg') }}"
                                alt="" class="img-fluid" style="min-height: 250px" />
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 custom_product_details_scroll"> --}}
                <div class="col-md-6">
                    <div class="content">
                        <h1 class="mb-0 f-s-30">{!! $product->title !!}</h1>
                        <p class="mb-0 f-s-20">By {{ $product->productAuthor->name }}</p>
                        <p class="mb-0">Category Name: @foreach ($product->productCategories as $productCategory)
                                {{ $productCategory->name . ' ' }}
                            @endforeach
                        </p>
                        @if ($product->has_discount_validity == 'true')
                            <p class="f-s-20 mb-0" style="margin-right: 15px;">Price: <del
                                    class="text-danger">{{ $product->price }} tk</del></p>
                            <p class="f-s-20 mb-0" style="">Discounted Price:
                                {{ $grandPrice = $product->price - $product->discount_amount }} tk</p>
                        @else
                            <p class="mb-0 f-s-25 fw-bold">{{ $product->price }} tk<span>

                                    </span></p>
                        @endif
                        @php
                            $stockStatus = false;
                            if ($product->stock_amount > 0) {
                                $stockStatus = true;
                            }
                        @endphp
                        @if ($stockStatus == true)
                            <p class="text-success f-s-19">In Stock</p>
                        @else
                            <p class="text-danger f-s-19">Out Of Stock</p>
                        @endif
                        <a href="{{ route('front.view-cart', [$product->id]) }}" class="default-btn w-100 mb-3 f-s-22 custom_book_button_none">এখনই কিনুন</a>
                        {!! $product->description !!}

                        <a href="{{ route('front.view-cart',[$product->id]) }}" class="default-btn f-s-24 custom_book_button_block">এখনই কিনুন</a>


                    </div>
                </div>

                <div class="col-md-3">
                    <h2 class="text-center">Latest Products</h2>
                    <div class="mt-3">
                        <div class="row justify-content-center">
                            @foreach ($latestProducts as $latestProduct)
                                <div class="col-5 col-md-12 ">
                                    <div class="mt-2">
                                        <a href="{{ route('front.product-details', ['slug' => $latestProduct->slug]) }}"
                                            class="">
                                            <div class="card border-0">
                                                <div class="row">
                                                    <div class="col-md-4 ps-1 pd_padding">
                                                        <img src="{{ asset(isset($latestProduct->image) ? $latestProduct->image : 'frontend/logo/biddabari-card-logo.jpg') }}"
                                                            alt="" class="img-fluid" style="height: 100px" />
                                                    </div>
                                                    <div class="col-md-7">
                                                        <h3 class="mb-0 f-s-21">{{ $latestProduct->title }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        /*review section*/
        .no-pad p {
            margin-bottom: 2px !important;
        }

        .comment-user-image {
            border-radius: 60%;
            width: 40px;
            height: 40px;
        }

        .com-img-box {
            /*height: 78px;*/
            width: 56px;
        }

        .main-comment p {
            margin-bottom: 2px !important;
        }

        .sub-replay p {
            margin-bottom: 2px !important;
        }

        .bb-1px {
            border-bottom: 1px solid black;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('/') }}frontend/assets/js/page-js/product-comments.js"></script>
@endpush
