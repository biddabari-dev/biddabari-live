@extends('frontend.master')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h2 class="bread">Course-Category/{{ $courseCategory->name }}</h2>
            </div>
        </div>
    </div>
    @if(!$courseCategory->courseCategories->isEmpty())
        <div class="categories-area pb-70">
            <div class="container">
                <div class="section-title mb-45 text-center">
                    <!--   <h2>কোর্স  <b>ক্যাটাগরি</b></h2>-->
                    <h2>কোর্স  <b>সমূহ</b></h2>
                    <hr class="w-25 mx-auto bg-danger"/>
                </div>
                <div class="row">
                    @foreach($courseCategory->courseCategories as $courseCategoryx)
                        <div class="col-md-3">
                            <div class="categories-item rounded-0" >
                                <a href="{{ route('front.category-courses', ['slug' => $courseCategoryx->slug]) }}">
                                    <img src="{{ asset(isset($courseCategoryx->image) ? $courseCategoryx->image : 'frontend/logo/biddabari-card-logo.jpg') }}" alt="Categories" class="w-100 border-0" style="height: 200px">
                                </a>
                                <div class="content">
                                    <a href="{{ route('front.category-courses', ['slug' => $courseCategoryx->slug]) }}">
                                        <i class="{{ $courseCategoryx->icon ?? 'flaticon-web-development' }}"></i>
                                        <h3>{{ $courseCategoryx->name ?? 'No Title' }}</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($courseCategory->courses)>0)
        <div class="courses-area-two section-bg pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center mb-45">
                    <!--   <span>কোর্স সমূহ</span>-->
                    <h2>{{ $courseCategory->name }} কোর্স সমূহ</h2>
                    <hr class="w-25 mx-auto bg-danger">
                </div>
                <div class="row">
                    @foreach($courseCategory->courses as $course)
                        <div class="col-lg-4 col-md-6">
                            <div class="courses-item">
                                <a href="{{ route('front.course-details', [ 'slug' => $course->slug]) }}">
                                    <img src="{{ asset(file_exists_obs($course->banner) ? $course->banner : 'frontend/logo/biddabari-card-logo.jpg') }}" alt="Courses" class="w-100" style="height: 230px"/>
                                </a>
                                <div class="content">
                                    <h3><a href="{{ route('front.course-details', ['slug' => $course->slug]) }}">{{ $course->title }}</a></h3>
                                    <ul class="course-list">
                                        {{--                                        <li><i class="ri-time-fill"></i> 06 hr</li>--}}
                                        <li><i class="ri-vidicon-fill"></i> {{ $course->total_note ?? 0 }} lectures</li>
                                        <li><i class="ri-file-pdf-line"></i> {{ $course->total_pdf ?? 0 }} PDF</li>
                                        <li><i class="ri-a-b"></i> {{ $course->total_exam ?? 0 }} Exam</li>
                                        <li><i class="ri-store-3-line"></i>{{ $course->total_live ?? 0 }} live class</li>
                                    </ul>

                                    <div class="custome_dis_course_price">
                                        @if($course->discount_type == 1 || $course->discount_type == 2)
                                        <span class="course-price"> ৳ <del>{{ $course->price }} </del> </span>
                                        <span class="dis-course-amount">৳ {{ $course->price-$course->discount_amount }}</span>
                                        @else
                                        <span class="dis-course-amount"> ৳ {{ $course->price }} </span>
                                        @endif
                                    </div>
                                    <div class="bottom-content">
                                        <a href="{{ route('front.course-details', [ 'slug' => $course->slug]) }}" class="btn btn-warning">বিস্তারিত দেখুন</a>
                                        <div class="rating ">
                                            @php
                                                $date = date('Y-m-d H:i')
                                            @endphp
												@php
													$discountAmount = $course->discount_type == 1 ? $course->discount_amount : ($course->price * $course->discount_amount)/100;
													$totalAmount = $course->price - (isset($discountAmount) ? $discountAmount : 0);
												@endphp
                                            @if($course->order_status == 'false')
                                                @if($course->admission_last_date > $date)
												                 <a href="{{ route('front.checkout', ['type' => 'course', 'slug' => $course->slug]) }}"
												class="btn btn-warning btn-block" >কোর্সটি কিনুন</a>

{{--													   <form action="{{ route('front.place-course-order', ['course_id' => $course->id]) }}" method="post">--}}
{{--														@csrf--}}
{{--														<input type="hidden" name="course_id" value="{{ $course->id }}" />--}}
{{--														<input type="hidden" name="total_amount" value="{{ $totalAmount }}" />--}}
{{--														<input type="hidden" name="used_coupon" value="0">--}}
{{--														<input type="hidden" name="coupon_code" value="">--}}
{{--														<input type="hidden" name="coupon_amount" value="">--}}
{{--														<input type="hidden" name="ordered_for" value="course">--}}
{{--														<input type="hidden" name="rc" value="{{ $_GET['rc'] ?? '' }}">--}}
{{--														<input type="hidden" name="payment_method" value="ssl">--}}
{{--														<input type="submit" class="btn btn-warning btn-block" value="কোর্সটি কিনুন">--}}
{{--														</form>--}}

                                                @else
                                                    <a class="btn btn-warning">ভর্তির সময় শেষ</a>
                                                @endif
                                            @elseif($course->order_status == 'pending')
                                                <a href="javascript:void(0)" class="text-warning">Pending</a>
                                            @elseif($course->order_status == 'true')
                                                <a href="javascript:void(0)" class="">Active</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="courses-area-two section-bg pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h2>কোনো কোর্স চালু হয়নি।  খুব দ্রুত কোর্স চালু হবে। </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
