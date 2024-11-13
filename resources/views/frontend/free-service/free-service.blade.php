@extends('frontend.master')

@section('title', 'Free Job Preparation Videos and Exams - Biddabari')

@section('meta-description', 'Prepare for your dream job with free videos and exams from Biddabari. Access top online courses and resources for government and private job exams in Bangla.')

@section('meta-keywords', 'free job preparation, Free job preparation online, Free job preparation courses, Best free job preparation online, Job preparation bangla, Govt Job preparation online')

@section('meta-url', request()->url())

@section('og-url', request()->url())

@section('og-image', 'frontend/logo/favicon/favicon-32x32.png')


@section('body')
    <div class="courses-area-two section-bg py-5 bg-white">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="section-title text-center">
                    <h2 class="">ফ্রি <span class="test-danger"
                            style="display:inline; margin:0; padding: 0;"></span> শিখুন</h2>
                    <hr class="w-25 mx-auto bg-danger" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-body border-0 rounded-0">
                    <div class="row cat_mobile_res">
                    @foreach($courseCategories as $courseCategory)
                        @if($courseCategory->id != 157)
                        <div class="col-md-3 col-m-6">
                            <div class="categories-item">
                                <a href="{{ route('front.free.course', ['slug' => $courseCategory->slug]) }}">
                                    <img loading="lazy"
                                        src="{{ asset(isset($courseCategory->second_image) ? $courseCategory->second_image : 'frontend/logo/biddabari-card-logo.jpg') }}"
                                        alt="Categories" class="w-100 border-0">
                                </a>
                                <div class="content">
                                    <a href="{{ route('front.free.course', ['slug' => $courseCategory->slug]) }}">
                                        <i class="{{ $courseCategory->icon ?? 'flaticon-web-development' }}"></i>
                                        <h3>{{ 'ফ্রি শিখুন' }}</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
<style>
   @media only screen and (min-width: 280px) and (max-width: 420px){
        .cat_mobile_res .col-md-3 {
            width: 50% !important;
        }
   }
</style>

@endpush
