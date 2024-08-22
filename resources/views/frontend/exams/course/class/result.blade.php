@extends('frontend.master')

@section('body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body align-items-center" >
                            <div class=" text-center">
                                <div>
                                    <h2 class="text-secondary">{{ $exam->title }}</h2>
                                    <span class="fw-bold f-s-26">Biddabari</span>
                                </div>
                                <div class="">
                                    <div class="text-center" style="display: inline-block;">
                                        <span class="text-primary f-s-22">Question: </span><small class="f-s-22">{{ count($exam->questionStoresForClassXm) }}</small>
                                    </div>
                                    <div class="text-center ms-3" style="display: inline-block;">
                                        <span class="text-primary f-s-22">Pass Mark: </span><small class="f-s-22">{{ $exam->exam_pass_mark  }}</small>
                                    </div>
                                    <div class="text-center ms-3" style="display: inline-block;">
                                        <span class="text-primary f-s-22">Total Mark: </span><small class="f-s-22">{{ count($exam->questionStoresForClassXm) * $exam->exam_per_question_mark }}</small>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="text-center me-3" style="display: inline-block;">
                                        <span class="text-primary f-s-22">Positive Mark: </span><small
                                            class="f-s-22">{{ ($examResult->total_right_ans) }}</small>
                                    </div>
                                    <div class="text-center" style="display: inline-block;">
                                        <span class="text-primary f-s-22">Negative Mark: </span><small
                                            class="f-s-22">{{ ($examResult->total_wrong_ans) }}</small>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <div class="me-4">
                                    <span class="fw-bold f-s-30">Your Mark : </span> <strong class="fw-bold f-s-45
                                    @if ($exam->exam_pass_mark > $examResult->result_mark)
                                        text-danger

                                    @else
                                        text-success
                                    @endif
                                    ">{{ $examResult->result_mark }}</strong> <br>
                                    @if ($exam->exam_pass_mark > $examResult->result_mark)
                                        <span class="f-s-45 text-danger">Failed</span>
                                    @else
                                        <span class="f-s-45 text-success">Pass</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($exam->exam_pass_mark > $examResult->result_mark)
                                        <div class="fail-div">
                                            <div class="text-center">
                                                <img src="{{ asset('/') }}backend/assets/images/xm-ressult/feeling.png" alt="" class="img-fluid" style="height: 150px" />
                                                <h3 class="text-primary">Sorry.... You failed in the exam</h3>
                                            </div>
                                        </div>
                                        @elseif($exam->exam_pass_mark < $examResult->result_mark)
                                        <div class="win-div">
                                            <div class="text-center">
    {{--                                            <img src="{{ asset('/') }}backend/assets/images/xm-ressult/download.png" alt="" class="img-fluid" style="height: 500px" />--}}
                                                <img src="https://img.freepik.com/free-vector/employees-celebrating-business-success-with-huge-trophy_1150-37475.jpg" alt="" class="img-fluid" style="height: 150px" />
                                                <h3 class="text-primary">Hurray.... You Passed in the exam</h3>
                                            </div>
                                        </div>
                                        @endif
                                        <div>
                                            <h3>Go Back to :</h3>
                                            {{-- <a href="{{ route('front.home') }}" class="btn btn-outline-success">HomePage</a> --}}
                                            <a href="{{ route('front.student.course-contents', ['course_id' => $exam->courseSection->course->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}" class="btn btn-outline-success">Go Back</a>
                                            <a href="{{ route('front.student.show-course-class-exam-answers', ['content_id' => $exam->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}" class="btn btn-outline-success">Show Answer</a>
                                            {{-- <a href="{{ route('front.student.show-course-class-exam-ranking', ['content_id' => $exam->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}"
                                                class="btn btn-outline-success">See Ranking</a> --}}
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        {{--setTimeout(function () {--}}
        {{--    window.location = "{{ route('front.student.course-contents', ['course_id' => $exam->courseSection->course->id, 'slug' => str_replace(' ', '-', $exam->title)]) }}";--}}
        {{--}, 2000)--}}
    </script>
@endsection
