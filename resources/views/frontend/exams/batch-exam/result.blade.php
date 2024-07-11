@extends('frontend.master')

@section('body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body align-items-center" >
                            <div class="text-center">
                                <div>
                                    <h2 class="text-secondary">{{ $exam->title }}</h2>
                                    <span class="fw-bold f-s-26">Biddabari</span>
                                </div>
                                <div class="text-center">
                                    <div class="" style="display: inline-block">
                                        <span class="text-primary f-s-22">Question: </span><small class="f-s-22">{{ count($exam->questionStores) }}</small>
                                    </div>
                                    @if($exam->content_type == 'exam')
                                        <div class="ms-3" style="display: inline-block">
                                            <span class="text-primary f-s-22">Pass Mark: </span><small class="f-s-22">{{ $exam->exam_pass_mark  }}</small>
                                        </div>
                                        <div class="ms-3" style="display: inline-block">
                                            <span class="text-primary f-s-22">Total Mark: </span><small class="f-s-22">{{ $exam->exam_total_questions * $exam->exam_per_question_mark }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($exam->content_type == 'exam')
                            <div class="text-center mt-3">
                                <div class="me-4">
                                    <strong class="fw-bold f-s-45
                                    @if ($exam->exam_pass_mark > $examResult->result_mark)
                                        text-danger

                                    @else
                                        text-success
                                    @endif
                                    ">{{ $examResult->result_mark }}</strong> <br>
                                    @if ($examResult->status == 'pass')
                                        <span class="f-s-45 text-success">({{ $examResult->status == 'pass' ? 'Pass' : 'Failed' }})</span>
                                    @else
                                        <span class="f-s-45 text-danger">({{ $examResult->status == 'pass' ? 'Pass' : 'Failed' }})</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-body mt-3">
                            @if($exam->content_type == 'exam')
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($examResult->status == 'fail')
                                        <div class="fail-div">
                                            <div class="text-center">
                                                <img src="{{ asset('/') }}backend/assets/images/xm-ressult/feeling.png" alt="" class="img-fluid" style="height: 300px" />
                                                <h3 class="text-primary">Sorry.... You failed in the exam</h3>
                                            </div>
                                        </div>
                                        @elseif($examResult->status == 'pass')
                                        <div class="win-div">
                                            <div class="text-center">
    {{--                                            <img src="{{ asset('/') }}backend/assets/images/xm-ressult/download.png" alt="" class="img-fluid" style="height: 500px" />--}}
                                                <img src="https://img.freepik.com/free-vector/employees-celebrating-business-success-with-huge-trophy_1150-37475.jpg" alt="" class="img-fluid" style="height: 300px" />
                                                <h3 class="text-primary">Hurray.... You Passed in the exam</h3>
                                            </div>
                                        </div>
                                        @endif
                                        <div>
                                            <h3>Go Back to :</h3>
                                            <a href="{{ route('front.student.batch-exam-contents', ['xm_id' => $exam->batchExamSection->batchExam->id, 'master' => base64_encode($exam->batchExamSection->batchExam->is_master_exam), 'slug' => str_replace(' ', '-', $exam->batchExamSection->batchExam->title)]) }}" class="btn btn-outline-success">Go Back</a>
                                            {{-- <a href="{{ route('front.student.dashboard') }}" class="btn btn-outline-success">Student Dashboard</a> --}}
{{--                                            <a href="{{ route('front.student.show-course-exam-ranking', ['content_id' => $exam->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}" class="btn btn-outline-success">Show Ranking</a>--}}
                                        </div>
                                    </div>
                                </div>
                            @elseif($exam->content_type == 'written_exam')
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center">Your Answer Submitted Successfully. Our Trainer will mark your answer very soon.</h3>
                                    <div>
                                        <h3>Go Back to :</h3>
                                        {{-- <a href="{{ route('front.home') }}" class="btn btn-outline-success">HomePage</a> --}}
                                        <a href="{{ route('front.student.batch-exam-contents', ['course_id' => $exam->courseSection->course->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}" class="btn btn-outline-success">Go Back</a>
{{--                                        <a href="{{ route('front.student.show-course-exam-ranking', ['content_id' => $exam->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}" class="btn btn-outline-success">Show Ranking</a>--}}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
