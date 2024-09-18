@extends('frontend.student-master')

@section('student-body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2> {!! $course->title !!}</h2>
                    <hr class="w-25 mx-auto bg-danger" />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="courses-details-tab-content">
                            <div class="courses-details-accordion">
                                <ul class="accordion">
                                    @if (!empty($course->courseSections))
                                        @forelse($course->courseSections as $courseSection)
                                            <li class="accordion-item">
                                                <a class="accordion-title f-s-26" href="javascript:void(0)">
                                                    <i class="ri-add-fill"></i>
                                                    {{ $courseSection->title }}
                                                </a>
                                                @if (!empty($courseSection->courseSectionContents))
                                                    <div class="accordion-content">
                                                        @foreach ($courseSection->courseSectionContents as $courseSectionContent)
                                                            @if ($courseSectionContent->content_type == 'pdf')
                                                                <a href="javascript:void(0)"
                                                                    data-content-id="{{ $courseSectionContent->id }}"
                                                                    class="w-100 show-pdf">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                            PDF --}}
                                                                            {{--                                                                            <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20">
                                                                                {{--                                                                                <i class="fa-regular fa-file-pdf"></i> --}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/pdf.jpg"
                                                                                    alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'video')
                                                                <a href="javascript:void(0)" class="w-100 show-video-modal"
                                                                    data-title="{{ $courseSectionContent->title }}"
                                                                    data-has-class-xm="{{ $courseSectionContent->has_class_xm }}"
                                                                    data-complete-class-xm="{{ $courseSectionContent->classXmStatus }}"
                                                                    data-video-link="{{ $courseSectionContent->video_vendor == 'youtube' ? explode('https://www.youtube.com/watch?v=', $courseSectionContent->video_link)[1] : $courseSectionContent->video_link }}"
                                                                    data-video-vendor="{{ $courseSectionContent->video_vendor }}"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                                Video --}}
                                                                            {{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20"><i
                                                                                    class="fa-solid fa-video"></i>
                                                                                {{ $courseSectionContent->title }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'note')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                                Note --}}
                                                                            {{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20"><i
                                                                                    class="fa-regular fa-note-sticky"></i>
                                                                                {{ $courseSectionContent->title }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'live')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                                Go Live --}}
                                                                            {{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20">
                                                                                {{--                                                                                    <i class="fa-solid fa-tower-broadcast"></i> --}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/live-icon.jpg"
                                                                                    alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'link')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                                Regular Link --}}
                                                                            {{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20"><i
                                                                                    class="fa-solid fa-link"></i>
                                                                                {{ $courseSectionContent->title }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'assignment')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                        Assignment File --}}
                                                                            {{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p> --}}
                                                                            <p class="f-s-20">
                                                                                {{--                                                                                    <i class="fa-regular fa-copy"></i> --}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/Assignment.jpg"
                                                                                    alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'exam')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            <p class="f-s-20">
                                                                                {{--                                                                                    <i class="fa-regular fa-note-sticky"></i> --}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/MCQ.jpg"
                                                                                    alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if ($courseSectionContent->content_type == 'written_exam')
                                                                <a href="javascript:void(0)" class="w-100 get-text-data"
                                                                    data-content-id="{{ $courseSectionContent->id }}">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
                                                                            {{--                                                                        Written Exam --}}
                                                                            <p class="f-s-20">
                                                                                {{--                                                                                    <i class="fa-regular fa-paste"></i> --}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/Written-exam-icon.jpg"
                                                                                    alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="accordion-item">
                                                <a class="accordion-title" href="javascript:void(0)">
                                                    No Content Available Yet
                                                </a>
                                            </li>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="" id="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="commonPrintModel" data-bs-backdrop="static" data-modal-parent="courseContentModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-body p-0">
                        <div class="" id="printHere"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- old video model --}}
    {{-- <div class="modal fade video-modal" id="videoModal" data-bs-backdrop="static" data-modal-parent="courseContentModal" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Watch Class Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_video()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-body p-0">
                        <div class="private d-none">
                            <video class="w-100 video" height="500" controls="controls" controlist="nodownload">
                                <source id="privatVid" src="//samplelib.com/lib/preview/mp4/sample-5s.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="youtube d-none">
                            <div class="video-container video_mobile_res" >
                                <div class="video-foreground">

                                    <div id="video"></div>
                                </div>
                            </div>


                        </div>
                        <div class="vimeo d-none">
                            <div style="padding:56.25% 0 0 0;position:relative;">
                                <iframe id="vimeoPlayer" src="" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="mt-4 ms-4">
                            <a href="" target="_blank" class="btn btn-success see-answer">See Answer</a>
                        </div>
                        <div class="mt-4">
                            <div id="videoCommentDiv">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- new video model --}}
    <div class="modal fade video-modal" id="videoModal" data-bs-backdrop="static"
        data-modal-parent="courseContentModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; 5px;">
                    <h5 class="modal-title px-3" id="exampleModalLabel">Watch Class Video</h5>
                    <button type="button" class="btn-close px-3" data-bs-dismiss="modal" onclick="close_video()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="p-0">
                        <div class="private d-none">
                            <video class="w-100 video" height="500" controls="controls" controlist="nodownload">
                                <source id="privatVid" src="//samplelib.com/lib/preview/mp4/sample-5s.mp4"
                                    type="video/mp4">
                            </video>
                        </div>
                        <div class="youtube">
                            <div class="video-container video_mobile_res">
                                <div class="video-foreground">
                                    <div class="plyr__video-embed" id="player">
                                        <iframe id="play-now" src="" allowfullscreen allowtransparency
                                            allow="autoplay"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="vimeo d-none">
                            <div style="padding:56.25% 0 0 0;position:relative;">
                                <iframe id="vimeoPlayer" src=""
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0"
                                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div> --}}
                        {{-- <div class="mt-4 ms-4">
                            <a href="" target="_blank" class="btn btn-success see-answer">See Answer</a>
                        </div>
                        <div class="mt-4">
                            <div id="videoCommentDiv">

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show-pdf-modal" id="pdfModal" data-bs-backdrop="static"
        data-modal-parent="courseContentModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Class Pdf</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-body p-0" id="pdfContentPrintDiv">
                        <div class="row">
                            <div class="col-12">
                                <p>
                                    <a href="" class="float-end" download id="pdfDownloadLink"></a>
                                </p>
                            </div>
                        </div>
                        <div class="my-box pe-3 mx-auto">
                            <div id="pdf-container">
                                <div id="zoom-controls" class="text-center">
                                    <button id="zoom-out" class="btn btn-sm btn-info"><i
                                            class="fa fa-minus"></i></button>
                                    <button id="zoom-in" class="btn btn-sm btn-primary"><i
                                            class="fa fa-plus"></i></button>
                                    <button id="zoom-reset" class="btn btn-sm btn-secondary">Reset Zoom</button>
                                    <span id="zoom-percent">100</span>
                                </div>
                                <div id="pages"></div>
                            </div>
                            {{-- <div id="pspdfkit" style="width: 100%; height: 100vh"></div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    {{-- connect to the plyr css --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        /* Hide YouTube Controls and Share Options */
        .plyr__video-embed iframe {
            pointer-events: none;
        }

        /* Additional CSS to block unwanted interactions */
        .plyr__video-embed {
            position: relative;
            overflow: hidden;
            border: 1px solid #eeeeee !important;
        }

        /* Transparent overlay to block interactions */
        .plyr__video-embed::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 100;
            pointer-events: none;
        }
    </style>
    <style>
        .mcq-xm th {
            font-size: 24px
        }

        .mcq-xm td {
            font-size: 22px
        }

        .written-xm th {
            font-size: 24px
        }

        .written-xm td {
            font-size: 22px
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <!--<link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/pdfannotate.css">-->
    <!--<link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/styles.css">-->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}backend/ppdf/css/pdfviewer.jquery.css" /> --}}
    <style>
        .pdf-toolbar {
            display: none;
        }

        .aks-video-player {
            width: 99% !important;
        }
    </style>
    <style>
        .my-box {
            width: 100% !important;
        }

        .canvas-container,
        canvas {
            width: 100% !important;
            margin-top: 10px !important;
            height: auto;
        }

        .video-container {
            width: 100% !important;
            height: 447px;
            overflow: hidden;
            position: relative;
            /* padding-bottom: 56.25%; */
            /* padding-top: 25px; */
            /*height: 0;*/
        }

        .video-container iframe {
            position: absolute;
            /* top: -60px; */
            left: 0;
            width: 100%;
            /* height: calc(80% + 100px); */
            /* height: 500px!important; */
        }

        .video-foreground {
            pointer-events: auto;
        }

        #watchOnYoutubeWaterMark {
            height: 47px;
            width: 173px;
            background-color: transparent;
            position: absolute;
            bottom: 8%;
            left: 0;
        }

        #rightSideYoutubeWaterMark {
            height: 36px;
            width: 67px;
            background-color: transparent;
            position: absolute;
            right: 6%;
            bottom: 7%;
        }
    </style>
    <style>
        /*review section*/
        .no-pad p {
            margin-bottom: 2px !important;
        }

        .comment-user-image {
            border-radius: 60%;
            width: 40px;
            height: 40px;
        }

        .com-img-box {
            /*height: 78px;*/
            width: 56px;
        }

        .main-comment p {
            margin-bottom: 2px !important;
        }

        .sub-replay p {
            margin-bottom: 2px !important;
        }

        .bb-1px {
            border-bottom: 1px solid black;
        }

        .ytp-impression-link {
            display: none !important;
        }
    </style>

    <style>
        #pages {
            text-align: center;
        }

        .page {
            width: 100% !important;
            margin: 10px;
            box-shadow: 0px 0px 3px #000;
            animation: pageIn 1s ease;
            transition: all 1s ease, width 0.2s ease;
        }

        @keyframes pageIn {
            0% {
                transform: translateX(0px);
                opacity: 0;
            }

            100% {
                transform: translateX(0px);
                opacity: 1;
            }
        }

        #zoom-in {}

        #zoom-percent {
            display: inline-block;
        }

        #zoom-percent::after {
            content: "%";
        }

        #zoom-out {}
    </style>


@endpush

@section('js')
    {{--    note --}}
    <script>
        $(document).on('click', '.get-text-data', function() {
            var contentId = $(this).attr('data-content-id');
            $.ajax({
                url: "{{ route('front.student.get-text-type-content') }}",
                method: "GET",
                data: {
                    content_id: contentId
                },
                success: function(data) {
                    // console.log(data);
                    $('#printHere').html(data);
                    $('#commonPrintModel').modal('show');
                }
            })
        })

        function checkHasClassXm(elementObject) {
            var hasClassXm = elementObject.attr('data-has-class-xm');
            var isClassXmComplete = elementObject.attr('data-complete-class-xm');
            if (isClassXmComplete == 1) {
                return true;
            } else {
                if (hasClassXm == 0) {
                    return true;
                } else {
                    $.ajax({
                        url: "{{ route('front.student.show-class-exam-ajax') }}",
                        method: "GET",
                        data: {
                            content_id: elementObject.attr('data-content-id')
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#printHere').html(data);
                            $('#commonPrintModel').modal('show');
                        }
                    })
                }
            }
        }
    </script>

    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        // Function to disable right-click
        function disableContextMenu(e) {
            e.preventDefault();
        }
        // Function to disable developer tools and prevent copying
        function disableDeveloperTools(e) {
            if (e.ctrlKey || e.key === 'F12') {
                e.preventDefault();
            }
        }
        // Global variable to store the Plyr instance
        let player;

        $(document).on('click', '.show-video-modal', function() {
            var status = checkHasClassXm($(this));
            var has_exam = $(this).data('has-class-xm');
            var title = $(this).data('title');
            //console.log('title...........', title);

            if (has_exam != 1) {
                $('.see-answer').hide();
            }

            if (status == true) {
                var contentId = $(this).attr('data-content-id');
                var videoVendor = $(this).attr('data-video-vendor');
                var videoLink = $(this).attr('data-video-link');
                // console.log('videoLink............', videoLink);

                // Construct the correct embed URL based on the video vendor
                var embedUrl = (videoVendor == 'youtube') ?
                    'https://www.youtube.com/embed/' + videoLink +
                    '?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1' :
                    videoLink;

                // Update the src attribute dynamically
                $('#play-now').attr('src', embedUrl);
                if (videoVendor == 'youtube') {
                    $('.see-answer').attr('href', '/student/show-course-class-exam-answers/' + contentId + '/' +
                        title);
                }

                // Initialize Plyr player instance
                if (player) {
                    player.destroy(); // Destroy the previous instance to avoid conflicts
                }
                player = new Plyr('#player', {
                    controls: [
                        'play-large',
                        'play',
                        'fast-forward',
                        'progress',
                        'current-time',
                        'duration',
                        'settings',
                        'fullscreen',
                    ],
                    settings: ['quality', 'speed'],
                    youtube: {
                        controls: 0,
                        noCookie: true,
                        rel: 0,
                        modestbranding: 1,
                    }
                });
                // Wait for the Plyr player to be ready and then access the YouTube player
                player.on('ready', (event) => {
                    const youtubePlayer = event.detail.plyr.embed; // Access the YouTube player object

                    // Check if the YouTube player is ready and set the quality
                    youtubePlayer.addEventListener('onReady', () => {
                        youtubePlayer.setPlaybackQuality(
                            'hd720'); // Set the desired quality (e.g., 'hd720', 'hd1080')
                    });
                });

                $('.video-modal').modal('show'); // Show the modal
            } else {
                return false;
            }

            // Disable right-click, text selection, and developer tools when modal is open
            document.addEventListener('contextmenu', disableContextMenu);
            document.body.style.userSelect = 'none';
            document.addEventListener('keydown', disableDeveloperTools);
        });

        // Clear the src and destroy the player when the modal is hidden
        $('.video-modal').on('hidden.bs.modal', function() {
            if (player) {
                player.destroy(); // Destroy the Plyr instance
                player = null; // Reset the player variable
            }
            $('#play-now').attr('src', ''); // Clear the src to stop video playback

            document.removeEventListener('contextmenu', disableContextMenu);
            document.body.style.userSelect = '';
            document.removeEventListener('keydown', disableDeveloperTools);

        });
    </script>

    <script>
        function close_video() {
            $("#video").empty();
        }
    </script>

    <!--pdf-->
    {{-- <script src="{{ asset('/') }}backend/ppdf/js/pdfviewer.jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.worker.js';
        // Function to load and render the PDF
        function loadPDF(pdflink) {
            document.querySelector("#pages").innerHTML = "";
            zoomReset();
            fetch(pdflink)
                .then(response => response.arrayBuffer())
                .then(function(data) {
                    var typedarray = new Uint8Array(data);

                    pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                        console.log("The PDF has", pdf.numPages, "page(s).");

                        for (var i = 0; i < pdf.numPages; i++) {
                            (function(pageNum) {
                                pdf.getPage(pageNum).then(function(page) {
                                    var viewport = page.getViewport({
                                        scale: 2.0
                                    });
                                    var pageNumDiv = document.createElement("div");
                                    pageNumDiv.className = "pageNumber";
                                    pageNumDiv.innerHTML = "Page " + pageNum;

                                    var canvas = document.createElement("canvas");
                                    canvas.className = "page";
                                    canvas.title = "Page " + pageNum;

                                    document.querySelector("#pages").appendChild(pageNumDiv);
                                    document.querySelector("#pages").appendChild(canvas);

                                    canvas.height = viewport.height;
                                    canvas.width = viewport.width;

                                    var context = canvas.getContext('2d');
                                    var renderContext = {
                                        canvasContext: context,
                                        viewport: viewport
                                    };

                                    page.render(renderContext).promise.then(function() {
                                        console.log('Page rendered');
                                    });

                                });
                            })(i + 1);
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Error loading PDF:', error);
                });
        }

        // Zoom functions
        var curWidth = 60;

        function zoomIn() {
            if (curWidth < 150) {
                curWidth += 10;
                document.querySelector("#zoom-percent").innerHTML = curWidth;
                const pages = document.querySelectorAll(".page");

                pages.forEach(function(page) {
                    const style = document.createElement('style');
                    style.innerHTML = `.page { width: ${curWidth}% !important; }`;
                    document.head.appendChild(style);
                });
            }
        }

        function zoomOut() {
            if (curWidth > 20) {
                curWidth -= 10;
                document.querySelector("#zoom-percent").innerHTML = curWidth;
                const pages = document.querySelectorAll(".page");

                pages.forEach(function(page) {
                    const style = document.createElement('style');
                    style.innerHTML = `.page { width: ${curWidth}% !important; }`;
                    document.head.appendChild(style);
                });
            }
        }


        function zoomReset() {
            curWidth = 100;
            document.querySelector("#zoom-percent").innerHTML = curWidth;
            const pages = document.querySelectorAll(".page");
            pages.forEach(function(page) {
                const style = document.createElement('style');
                style.innerHTML = `.page { width: ${curWidth}% !important; }`;
                document.head.appendChild(style);
            });
        }

        // Bind event listeners when DOM is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#zoom-in").addEventListener("click", zoomIn);
            document.querySelector("#zoom-out").addEventListener("click", zoomOut);
            document.querySelector("#zoom-reset").addEventListener("click", zoomReset);
        });

        // Handle zoom via keyboard input
        window.onkeypress = function(e) {
            if (e.code === "Equal") zoomIn();
            if (e.code === "Minus") zoomOut();
        };

        // Load PDF dynamically when a link is clicked
        $(document).on('click', '.show-pdf', function(event) {
            event.preventDefault();
            var sectionContentId = $(this).attr('data-content-id');

            $.ajax({
                url: base_url + "student/show-pdf/" + sectionContentId, // Fetch PDF info dynamically
                method: "GET",
                success: function(data) {
                    var pdflink = '';
                    if (data.sectionContent.pdf_link) {
                        pdflink = data.sectionContent.pdf_link;
                    } else if (data.sectionContent.pdf_file) {
                        pdflink =
                            'https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com/' +
                            data.sectionContent.pdf_file;
                    } else {
                        pdflink = 'default-document.pdf'; // Fallback if no PDF is provided
                    }

                    // Load the PDF dynamically using the link from the server
                    loadPDF(pdflink);

                    // Handle the download button visibility and content
                    if (data.sectionContent.can_download_pdf == 1) {
                        $('#pdfDownloadLink')
                            .attr('href', pdflink)
                            .html('Download Now')
                            .attr('class', 'btn btn-success btn-sm float-end me-4 mt-2');
                    } else {
                        $('#pdfDownloadLink')
                            .attr('href', '#')
                            .html('')
                            .attr('class', '');
                    }

                    // Show the modal with the PDF viewer
                    $('.show-pdf-modal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching PDF data:', error);
                }
            });
        });
    </script>
    </script>


    <script>
        function LoadCss(url) {
            var link = document.createElement("link");
            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = url;
            document.getElementsByTagName("head")[0].appendChild(link);
        }

        function LoadScript(url) {
            var script = document.createElement('script');
            script.setAttribute('src', url);
            script.setAttribute('async', false);
            document.body.appendChild(script);
        }
    </script>
@endsection
