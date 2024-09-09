@extends('frontend.master')

@section('title')
Biddabari - All Course
@endsection

@section('body')
    <div class="courses-area-two section-bg py-5 bg-white">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="section-title text-center">
                    <h2 class="">ফ্রি <span class="test-danger"
                            style="display:inline; margin:0; padding: 0;">শিখুন</span> </h2>
                    <hr class="w-25 mx-auto bg-danger" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-body border-0 rounded-0">
                    <div class="row cat_mobile_res">
                    @foreach($courseCategories as $courseCategory)
                        <div class="col-md-3 col-m-6">
                            <div class="categories-item">
                                <a href="{{ route('front.free.course', ['slug' => $courseCategory->slug]) }}">
                                    <img loading="lazy"
                                        src="{{ asset(isset($courseCategory->image) ? $courseCategory->image : 'frontend/logo/biddabari-card-logo.jpg') }}"
                                        alt="Categories" class="w-100 border-0">
                                </a>
                                <div class="content">
                                    <a href="{{ route('front.free.course', ['slug' => $courseCategory->slug]) }}">
                                        <i class="{{ $courseCategory->icon ?? 'flaticon-web-development' }}"></i>
                                        <h3>{{ 'Free' }}</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
