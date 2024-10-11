@extends('frontend.master')

@section('title')
    Biddabari - ভিডিও ক্লাস ও পরীক্ষা – একদম ফ্রি
@endsection

@section('body')
    <div class="courses-area-two section-bg py-5 bg-white">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="section-title text-center">
                    <h2 class="">{{ $category->name }}<span class="test-danger f-s-24"
                            style="display:inline; margin:0; padding: 0;"> প্রস্তুতি </span> </h2>
                    <hr class="w-25 mx-auto bg-danger" />
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills all-course-page-nav-pills text-center">
                        <li class="nav-item mb-3">
                            <button class="nav-link active border-danger btn py-0 mx-2 text-dark" style="border: 1px solid"
                                data-bs-toggle="pill" data-bs-target="#freeClass">
                                <span class="f-s-30 f-s-24">ফ্রি ক্লাস করুন</span>
                            </button>
                        </li>
                        <li class="nav-item mb-3">
                            <button class="nav-link border-danger btn py-0 mx-2 text-dark"
                                style="border: 1px solid #F18C53;" data-bs-toggle="pill"
                                data-bs-target="#freeExams">
                                <span class="f-s-30 f-s-24">ফ্রি পরীক্ষা দিন</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active px-1" id="freeClass">
                    <div class="card card-body border-0 rounded-0">
                        <div class="row">
                            @forelse ($results as $item)
                                @php
                                    $url = $item->categoryVideo->video_link ?? '';
                                    $videoId = '';
                                    if ($url) {
                                        $urlComponents = parse_url($url);
                                        if (isset($urlComponents['query'])) {
                                            parse_str($urlComponents['query'], $query);
                                            $videoId = $query['v'] ?? ''; // Fallback if 'v' is not set
                                        }
                                    }
                                @endphp
                                @if (!empty($item->categoryVideo->video_link))
                                    <div class="col-md-6 col-lg-6 p-2">
                                        <div class="card video-container" style="border: 3px solid #ec9511;">
                                            <div class="video-foreground">
                                                <div class="plyr__video-embed" id="player">
                                                    <iframe
                                                        src="https://www.youtube.com/embed/{{ $videoId }}?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1"
                                                        allowfullscreen allowtransparency allow="autoplay"></iframe>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-md-12">
                                    <div class="card card-body">
                                        <h2 class="text-center">No Classes Available yet.</h2>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="freeExams">
                    <div class="card card-body border-0 rounded-0">
                        <div class="row">
                            @forelse ($exams as $exam)
                                @php $batchExam = $exam->categoryExam;  @endphp
                                @if (!empty($batchExam->id))
                                    @if (auth()->check())
                                    <div class="col-md-4 col-sm-6 px-1 open-modal" data-xm-id="{{ $batchExam->id }}"
                                        style="cursor: pointer;">
                                        <a href="" data-course-id="{{ $batchExam->id }}"
                                            onclick="event.preventDefault(); document.getElementById('freeCourseOrderForm').submit()">
                                            <div class="courses-item pb-0">
                                                <img src="{{ !empty($batchExam->banner) ? asset($batchExam->banner) : asset('/frontend/logo/biddabari-card-logo.jpg') }}"
                                                    alt="Batch Exams" class="w-100" style="height: 230px" />
 
                                                <div class="courses-item">
                                                    <div class="content">
                                                        <div class=" pt-3">
                                                            <h3>{{ $batchExam->title }}</h3>
                                                        </div>
                                                        <ul class="course-list">
                                                            {{-- <li><i class="ri-time-fill"></i> 06 hr</li> --}}
                                                            @php

                                                                $total_exam = 0;
                                                                $exam_section = DB::table('batch_exam_sections')
                                                                    ->where('batch_exam_id', $batchExam->id)
                                                                    ->get();

                                                                foreach ($exam_section as $value) {
                                                                    # code...
                                                                    $sections = DB::table(
                                                                        'batch_exam_section_contents',
                                                                    )
                                                                        ->where('batch_exam_section_id', $value->id)
                                                                        ->get();

                                                                    foreach ($sections as $content) {
                                                                        # code...
                                                                        if ($content->content_type == 'exam') {
                                                                            # code...
                                                                            $total_exam += 1;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <li><i class="ri-a-b"></i> {{ $total_exam ?? 0 }} টি পরীক্ষা
                                                            </li>

                                                        </ul>
                                                    </div>

                                                    <div class="d-flex px-3 pb-3">
                                                        <span
                                                            class="default-btn bg-default-color order-free-course">পরীক্ষা
                                                            দিন</span>
                                                        <form
                                                            action="{{ route('front.place-free-course-order', ['course_id' => $batchExam->id]) }}"
                                                            method="post" id="freeCourseOrderForm">
                                                            @csrf
                                                            <input type="hidden" name="ordered_for" value="batch_exam">
                                                        </form>
                                                    </div>
                                                </div>
                                        </a>
                                    @else
                                    <div class="col-md-4 col-sm-6 px-1 open-modal" data-xm-id="{{ $batchExam->id }}"
                                        style="cursor: pointer;">
                                        <a href="{{ route('login') }}" data-course-id="{{ $batchExam->id }}">
                                            <div class="courses-item pb-0">
                                                <img src="{{ !empty($batchExam->banner) ? asset($batchExam->banner) : asset('/frontend/logo/biddabari-card-logo.jpg') }}"
                                                    alt="Batch Exams" class="w-100" style="height: 230px" />

                                                <div class="courses-item">
                                                    <div class="content">
                                                        <div class=" pt-3">
                                                            <h3>{{ $batchExam->title }}</h3>
                                                        </div>
                                                        <ul class="course-list">
                                                            {{-- <li><i class="ri-time-fill"></i> 06 hr</li> --}}
                                                            @php

                                                                $total_exam = 0;
                                                                $exam_section = DB::table('batch_exam_sections')
                                                                    ->where('batch_exam_id', $batchExam->id)
                                                                    ->get();

                                                                foreach ($exam_section as $value) {
                                                                    # code...
                                                                    $sections = DB::table(
                                                                        'batch_exam_section_contents',
                                                                    )
                                                                        ->where(
                                                                            'batch_exam_section_id',
                                                                            $value->id,
                                                                        )
                                                                        ->get();

                                                                    foreach ($sections as $content) {
                                                                        # code...
                                                                        if ($content->content_type == 'exam') {
                                                                            # code...
                                                                            $total_exam += 1;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <li><i class="ri-a-b"></i> {{ $total_exam ?? 0 }} টি
                                                                পরীক্ষা
                                                            </li>

                                                        </ul>
                                                    </div>

                                                    <div class="d-flex px-3 pb-3">
                                                        <span
                                                            class="default-btn bg-default-color order-free-course">পরীক্ষা
                                                            দিন</span>
                                                        <form
                                                            action="{{ route('front.place-free-course-order', ['course_id' => $batchExam->id]) }}"
                                                            method="post" id="freeCourseOrderForm">
                                                            @csrf
                                                            <input type="hidden" name="ordered_for"
                                                                value="batch_exam">
                                                        </form>
                                                    </div>
                                                </div>
                                        </a>
                                    @endif

                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h2 class="text-center">No Exam Available yet.</h2>
                        </div>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@push('style')
    @include('plyr.plyr_css')
    <style>
        @media only screen and (min-width: 320px) and (max-width: 480px) {
            .f-s-24{
                font-size: 24px !important;
            }
        }

    </style>
@endpush
@section('js')
    @include('plyr.plyr_scripts')
@endsection
