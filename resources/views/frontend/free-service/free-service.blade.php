@extends('frontend.master')

@section('title')
Biddabari - All Course 
@endsection

@section('body')


    <div class="courses-area-two section-bg py-5 bg-white">
        <div class="container">
            <div class="col-md-12">
                <div class="card card-body border-0 rounded-0">
                    
                    <div> 
                        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <h2><button class="nav-link f-s-26 active" id="" data-bs-toggle="pill" data-bs-target="#freeCourses" type="button" role="tab" aria-controls="pills-home" aria-selected="true">ফ্রি কোর্সসমূহ</button></h2>
                            </li>
                            <li class="nav-item" role="presentation">
                                <h2><button class="nav-link f-s-26" id="" data-bs-toggle="pill" data-bs-target="#freeExams" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">ফ্রি পরীক্ষা সমূহ</button></h2>
                            </li>
                        </ul>
                        
                        <div class="tab-content mt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="freeCourses" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row a">
                                    <ul class="nav nav-pills all-course-page-nav-pills text-center mt-2">
                                        <li class="nav-item mb-3"><button type="button" class="nav-link active border-danger btn py-0 mx-2 text-dark " style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#allCourses" ><span class="f-s-25">All Running Courses</span></button></li>
                                        @foreach($courseCategories as $index => $courseCategory)
                                            <li class="nav-item mb-3"><button type="button" class="nav-link border-danger btn py-0 mx-2 text-dark" style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#{{ 'id'.$index }}"><span class="f-s-25">{{ $courseCategory->name }}</span></button></li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content mt-5">
                                        @foreach($courseCategories as $key => $courseCategory)
                                            @if($key == 0)
                                                <div class="tab-pane px-1 fade show active" id="allCourses">
                                                    <div class="row">
            
                                                        @foreach($allCourses as $allIndex => $singleCourse)
                                                            @include('frontend.courses.include-courses-course', ['course' => $singleCourse])
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="tab-pane fade" id="{{ 'id'.$key }}">
                                                @if(count($courseCategory->courseCategories) > 0)
                                                    <div class="row pb-5">
                                                        @foreach($courseCategory->courseCategories as $courseSubCategory)
                                                            <div class="col-md-4">
                                                                <a href="{{ route('front.free-category-courses', ['slug' => $courseSubCategory->slug]) }}" class="w-100">
                                                                    <div class="categories-item rounded-0">
                                                                        <img src="{{ asset(!empty($courseSubCategory->image) ? $courseSubCategory->image : 'frontend/logo/biddabari-card-logo.jpg') }}" alt="Categories" class="w-100 border-0" style="height: 240px">
                                                                        <div class="content" style="min-height: 80px">
                                                                            <span class="float-start border rounded-circle p-3" style="">
                                                                                <i class="flaticon-web-development "></i>
                                                                            </span>
                                                                            <h3 class="float-start ms-3 mt-3">{{ $courseSubCategory->name ?? 'Course Category' }}</h3>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    @if(count($courseCategory->courses) > 0)
                                                        @forelse($courseCategory->courses as $course)
                                                            @if ($course->is_paid == 0)
                                                                @include('frontend.courses.include-free-courses-course', ['course' => $course])   
                                                            @endif
                                                        @empty
                                                        <div class="col-md-12">
                                                            <div class="text-center">
                                                                <h2>কোনো কোর্স চালু হয়নি।  খুব দ্রুত কোর্স চালু হবে। </h2>
                                                            </div>
                                                        </div>
                                                        @endforelse
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="freeExams" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mt-3">
                                    <ul class="nav nav-pills all-course-page-nav-pills text-center">
                                        <li class="nav-item mb-3"><button type="button" class="nav-link active border-danger btn py-0 mx-2 text-dark" style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#allExams" ><span class="f-s-35">All Exams</span></button></li>
                                        @foreach($examCategories as $index => $examCategory)
                                            <li class="nav-item mb-3"><button type="button" class="nav-link border-danger btn py-0 mx-2 text-dark" style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#{{ 'exam-id'.$index }}"><span class="f-s-35">{{ $examCategory->name }}</span></button></li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content mt-5">
                                        @foreach($examCategories as $key => $examCategory)
                                            @if($key == 0)
                                                <div class="tab-pane px-1 fade show active" id="allExams">
                                                    <div class="row">
                                                            @foreach($allExams as $batchExam)
                                                                @include('frontend.exams.xm.include-batch-exams', $batchExam)
                                                            @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="tab-pane fade" id="{{ 'exam-id'.$key }}">
                                                <div class="row">
                                                    @if(count($examCategory->batchExams) > 0)
                                                        @forelse($examCategory->batchExams as $batchExam)
                                                            @include('frontend.exams.xm.include-batch-exams', $batchExam)
                                                        @empty
                                                            <div class="col-md-12">
                                                                <div class="text-center" style="min-height: 300px">
                                                                    <h2>কোনো এক্সাম চালু হয়নি। খুব দ্রুত এক্সাম চালু হবে। </h2>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
