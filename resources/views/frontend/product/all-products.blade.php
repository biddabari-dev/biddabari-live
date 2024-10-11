@extends('frontend.master')

@section('body')
<div class="courses-area-two section-bg ">
    <div class="container bg-white  pb-70 ps-3">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="text-center mb-5">
                    <a href="javascript:void(0)" class="btn border-main-color"><h1 class="fw-bolder fs-2">আমাদের বই
                            সমূহ</h1></a>
                </div>
                <div class="row product_mobile_res pro_book_mobile_res">
                    @foreach($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="blog-card">
                            <div class="book-btn-sec">
                                <a href="{{ route('front.product-details',['id'=>$product->id, 'slug'=>$product->slug]) }}"
                                    class="read-btn btn btn-warning">Read More</a>
                                @php
                                $stockStatus = false;
                                if ($product->stock_amount > 0)
                                {
                                $stockStatus = true;
                                }
                                @endphp
                                <p></p>
                                <a href="{{ route('front.view-cart',[$product->id]) }}" class="default-btn ">এখনই কিনুন</a>

                            </div>

                            <div class="blog_card_img">

                                <img src="{{ asset($product->image ?? 'frontend/logo/biddabari-card-logo.jpg') }}"
                                    alt="{{ $product->title }}">

                            </div>
                            <div class="content">
                                <h3><a
                                        href="{{ route('front.product-details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                        {{Str::limit($product->title, 38) }}</a></h3>
                                @if($stockStatus == true)
                                <p class="text-success f-s-19">In Stock</p>
                                @else
                                <p class="text-danger f-s-19">Out Of Stock</p>
                                @endif
                                <p>TK {{$product->price}} </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if(count($products) > 0)
                    <div class="col-md-12 mt-5">
                        <div class="text-center">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row col-12">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
@endpush

@section('js')
@endsection
