<div class="col-md-4 col-sm-6 px-1 open-modal" data-xm-id="{{ $batchExam->id }}" style="cursor: pointer;">
    <div class="courses-item pb-0">
        {{--                                <a href="{{ route('front.category-exams', ['xm_cat_id' => $batchExam->id, 'name' => $batchExam->name]) }}">--}}

        <img src="{{ !empty($batchExam->banner) ? asset($batchExam->banner) : asset('/frontend/logo/biddabari-card-logo.jpg') }}" alt="Batch Exams" class="w-100" style="height: 230px"/>
        <div class="courses-item">
            <div class="content">
                <div class=" pt-3">
                    <h3>{{ $batchExam->title }}</h3>
                </div>
                <ul class="course-list">
                    {{-- <li><i class="ri-time-fill"></i> 06 hr</li>--}}
                    @php
                        $total_pdf = 0;

                        $total_exam = 0;

                        $exam_section = DB::table('batch_exam_sections')->where('batch_exam_id',$batchExam->id)->get();

                        foreach ($exam_section as $value) {
                            # code...
                            $sections = DB::table('batch_exam_section_contents')->where('batch_exam_section_id',$value->id)->get();

                            foreach ($sections as $content) {
                                # code...
                                if ($content->content_type == 'pdf') {
                                    # code...
                                    $total_pdf += 1;
                                }elseif ($content->content_type == 'exam') {
                                    # code...
                                    $total_exam += 1;
                                }
                            }

                        }
                    @endphp
                    <li><i class="ri-a-b"></i> {{ $total_exam ?? 0 }} Exam</li>
                    <li><i class="ri-file-pdf-line"></i> {{ $total_pdf ?? 0 }} PDF</li>
                </ul>
            </div>

            <div class="d-flex px-3 pb-3">
                {{--                                        <span class="me-auto">Price: {{ $batchExam->price }} BDT</span> <br>--}}
                @if($batchExam->purchase_status == 'true')
                 <a href="{{route('front.student.batch-exam-contents',$batchExam->id)}}">Purchased</a>
                    <!--<button type="button" class="btn text-success ms-auto">Purchased</button>-->
                @elseif($batchExam->purchase_status == 'pending')
                    <button type="button" class="btn text-success ms-auto">Pending</button>
                @else
                <button type="button" class="btn btn-outline-success btn-sm ms-auto " >বিস্তারিত দেখুন</button>
                    <!--<button type="button" class="btn btn-outline-success btn-sm ms-auto " >View</button>-->
                @endif
            </div>
        </div>

    </div>
</div>
