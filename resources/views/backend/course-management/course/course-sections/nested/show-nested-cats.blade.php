<ol class="dd-list list-group">
    @foreach($sectionContents as $kk => $sectionContent)
        <li class="dd-item list-group-item" data-id="{{ $sectionContent['id'] }}" >
            <div class="dd-handle" >
                @if($sectionContent->content_type == 'pdf')
                    {{--                    <i class="fa-regular fa-file-pdf"></i>--}}
                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/pdf.jpg" alt="pdf icon" class="img-16" />
                @endif
                @if($sectionContent->content_type == 'video')
                    <i class="fa-solid fa-video"></i>
                @endif
                @if($sectionContent->content_type == 'note')
                    <i class="fa-regular fa-note-sticky"></i>
                @endif
                @if($sectionContent->content_type == 'live')
                    {{--                    <i class="fa-solid fa-tower-broadcast"></i>--}}
                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/live-icon.jpg" alt="pdf icon" class="img-16" />
                @endif
                @if($sectionContent->content_type == 'link')
                    <i class="fa-solid fa-link"></i>
                @endif
                @if($sectionContent->content_type == 'assignment')
                    {{--                    <i class="fa-regular fa-copy"></i>--}}
                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/Assignment.jpg" alt="pdf icon" class="img-16" />
                @endif
                @if($sectionContent->content_type == 'testmoj')
                    <i class="fa-regular fa-copy"></i>
                @endif
                @if($sectionContent->content_type == 'exam')
                    {{--                    <i class="fa-regular fa-note-sticky"></i>--}}
                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/MCQ.jpg" alt="pdf icon" class="img-16" />
                @endif
                @if($sectionContent->content_type == 'written_exam')
                    {{--                    <i class="fa-regular fa-paste"></i>--}}
                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/Written-exam-icon.jpg" alt="pdf icon" class="img-16" />
                @endif
                {{ $sectionContent['title'] }}
            </div>
            <div class="dd-option-handle">
                @if($sectionContent->content_type == 'exam' || $sectionContent->content_type == 'written_exam')
                    <a href="{{ route('content-exam-ranking-download-page',['req_from' => 'course', 'content_id' => $sectionContent->id]) }}" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-primary" title="Download Rankings">
                        <i class="fe fe-printer"></i>
                    </a>
                    <a href="{{ route('show-xm-attendance',['req_from' => 'course', 'content_id' => $sectionContent->id]) }}" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-primary" title="Student Attendance">
                        <i class="fe fe-users"></i>
                    </a>
                @endif
                @if($sectionContent->content_type == 'video')
                    <a href="{{ route('content-exam-ranking-download-page',['req_from' => 'course_class_exam', 'content_id' => $sectionContent->id]) }}" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-primary" title="Download Rankings">
                        <i class="fe fe-printer"></i>
                    </a>
                    <a href="{{ route('show-xm-attendance',['req_from' => 'course_class_exam', 'content_id' => $sectionContent->id]) }}" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-primary" title="Student Attendance">
                        <i class="fe fe-users"></i>
                    </a>
                @endif
                @if($sectionContent->content_type == 'pdf' || $sectionContent->content_type == 'video')
                    <a href="" data-course-id="{{ $sectionContent->id }}" data-content-type="{{ $sectionContent->content_type }}" @if($sectionContent->content_type == 'pdf') data-pdf-url="{{ isset($sectionContent->pdf_link) ? $sectionContent->pdf_link : (isset($sectionContent->pdf_file) ? $sectionContent->pdf_file : '') }}" @endif @if($sectionContent->content_type == 'video') data-video-vendor="{{ $sectionContent->video_vendor }}" data-video-url="{{ $sectionContent->video_link }}" @endif class="btn btn-sm mt-1 btn-warning show-pdf-video-btn" title="View Pdf Or Video" >
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endif
                {{-- neamat --}}

                @if($sectionContent->content_type == 'video')
                    @php
                        $exists = \App\Models\Backend\Course\CategoryWIseAssignVideo::where('section_content_id', $sectionContent->id)->exists();
                    @endphp
                    @if($exists)
                    <a href="" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm bg-black text-white delete-video-modal-btn" title="Video is already assigned to a free category">
                        <i class="fa fa-tags"></i>
                    </a>
                    @else
                    <a href="" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-blue add-video-modal-btn" title="Video Assign To Free Category">
                        <i class="fa fa-tags"></i>
                    </a>
                    @endif
                @endif
                @can('add-question-to-course-section-content')
                    @if($sectionContent->content_type == 'exam' || $sectionContent->content_type == 'written_exam')
                        {{--                            <a href="" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-warning view-participants" title="View Participants">--}}
                        {{--                                <i class="fa-solid fa-eye"></i>--}}
                        {{--                            </a>--}}
                        <a href="" data-section-content-id="{{ $sectionContent->id }}" data-xm-type="{{ $sectionContent->content_type }}" class="btn btn-sm btn-primary add-question-modal-btn" title="Add Exam Questions">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif
                @endcan
                @can('add-question-to-course-section-content-class')
                    @if($sectionContent->has_class_xm == 1)
                        <a href="" data-section-content-id="{{ $sectionContent->id }}" data-xm-of="{{ $sectionContent->course_section_content_id }}" class="btn btn-sm btn-secondary add-class-question-modal-btn" title="Add Class Exam Questions">
                            <i class="fa-solid fa-plus-circle"></i>
                        </a>
                    @endif
                @endcan
                @can('show-course-section-content')
                    <a href="" data-section-content-id="{{ $sectionContent->id }}" class="btn btn-sm btn-success show-btn" title="Show Course">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endcan
                @can('edit-course-section-content')
                    <button type="button" data-section-content-id="{{ $sectionContent->id }}" class="btn btn-sm btn-warning section-content-edit-btn" title="Edit Section Content">
                        <i class="fa-solid fa-edit"></i>
                    </button>
                @endcan
                @can('delete-course-section-content')
                    <form class="d-inline" action="{{ route('course-section-contents.destroy', $sectionContent->id) }}" method="post" >
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger data-delete-form" title="Delete Course Section Content">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endcan
            </div>

{{--            @include('backend.course-management.course.course-sections.nested.show-nested-cats', ['sectionContents' => $sectionContent->courseSectionContents, 'child' => 1])--}}
        </li>
    @endforeach
</ol>
