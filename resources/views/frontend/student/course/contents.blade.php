@extends('frontend.student-master')

@section('student-body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2> {!! $course->title !!}</h2>
                    <hr class="w-25 mx-auto bg-danger"/>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="courses-details-tab-content">
                            <div class="courses-details-accordion">
                                <ul class="accordion">
                                    @if(!empty($course->courseSections))
                                        @forelse($course->courseSections as $courseSection)
                                            <li class="accordion-item">
                                                <a class="accordion-title f-s-26" href="javascript:void(0)">
                                                    <i class="ri-add-fill"></i>
                                                    {{ $courseSection->title }}
                                                </a>
                                                @if(!empty($courseSection->courseSectionContents))
                                                    <div class="accordion-content">
                                                        @foreach($courseSection->courseSectionContents as $courseSectionContent)
                                                            @if($courseSectionContent->content_type == 'pdf')
                                                                <a href="javascript:void(0)" data-content-id="{{ $courseSectionContent->id }}"  class="w-100 show-pdf">
                                                                    <div class="accordion-content-list pt-2 pb-0">
                                                                        <div class="accordion-content-left">
{{--                                                                            PDF--}}
{{--                                                                            <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                            <p class="f-s-20">
{{--                                                                                <i class="fa-regular fa-file-pdf"></i>--}}
                                                                                <img src="{{ asset('/') }}backend/assets/images/icons-bb/pdf.jpg" alt="pdf icon" class="img-16" />
                                                                                {{ $courseSectionContent->title }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'video')
                                                                    <a href="javascript:void(0)" class="w-100 show-video-modal" data-title="{{ $courseSectionContent->title }}" data-has-class-xm="{{ $courseSectionContent->has_class_xm }}" data-complete-class-xm="{{ $courseSectionContent->classXmStatus }}" data-video-link="{{ $courseSectionContent->video_vendor == 'youtube' ? explode('https://www.youtube.com/watch?v=', $courseSectionContent->video_link)[1] : $courseSectionContent->video_link }}" data-video-vendor="{{ $courseSectionContent->video_vendor }}" data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
{{--                                                                                Video--}}
{{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                                <p class="f-s-20"><i class="fa-solid fa-video"></i> {{ $courseSectionContent->title }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'note')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data"  data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
{{--                                                                                Note--}}
{{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                                <p class="f-s-20"><i class="fa-regular fa-note-sticky"></i> {{ $courseSectionContent->title }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'live')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data" data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
{{--                                                                                Go Live--}}
{{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                                <p class="f-s-20">
{{--                                                                                    <i class="fa-solid fa-tower-broadcast"></i>--}}
                                                                                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/live-icon.jpg" alt="pdf icon" class="img-16" />
                                                                                    {{ $courseSectionContent->title }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'link')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data"  data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
{{--                                                                                Regular Link--}}
{{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                                <p class="f-s-20"><i class="fa-solid fa-link"></i> {{ $courseSectionContent->title }}</p>
                                                                            </div>
                                                                          </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'assignment')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data"  data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
                                                                                {{--                                                                        Assignment File--}}
{{--                                                                                <p class="f-s-20"><i class="ri-file-text-line"></i> {{ $courseSectionContent->title }}</p>--}}
                                                                                <p class="f-s-20">
{{--                                                                                    <i class="fa-regular fa-copy"></i>--}}
                                                                                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/Assignment.jpg" alt="pdf icon" class="img-16" />
                                                                                    {{ $courseSectionContent->title }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'exam')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data"  data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
                                                                                <p class="f-s-20">
{{--                                                                                    <i class="fa-regular fa-note-sticky"></i>--}}
                                                                                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/MCQ.jpg" alt="pdf icon" class="img-16" />
                                                                                    {{ $courseSectionContent->title }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                            @endif
                                                            @if($courseSectionContent->content_type == 'written_exam')
                                                                    <a href="javascript:void(0)" class="w-100 get-text-data"  data-content-id="{{ $courseSectionContent->id }}">
                                                                        <div class="accordion-content-list pt-2 pb-0">
                                                                            <div class="accordion-content-left">
                                                                                {{--                                                                        Written Exam--}}
                                                                                <p class="f-s-20">
{{--                                                                                    <i class="fa-regular fa-paste"></i>--}}
                                                                                    <img src="{{ asset('/') }}backend/assets/images/icons-bb/Written-exam-icon.jpg" alt="pdf icon" class="img-16" />
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
    <div class="modal fade" id="commonPrintModel" data-bs-backdrop="static" data-modal-parent="courseContentModal" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" >
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
    <div class="modal fade video-modal" id="videoModal" data-bs-backdrop="static" data-modal-parent="courseContentModal" >
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
                        <div class="youtube">
                            <div class="video-container video_mobile_res" >
                                <div class="video-foreground">
                                        <div class="plyr__video-embed" id="player">
                                            <iframe id="play-now" src="" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                        </div>
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
    </div>


    <div class="modal fade show-pdf-modal" id="pdfModal" data-bs-backdrop="static" data-modal-parent="courseContentModal" >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" >
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
                        <div class="my-box px-3 mx-auto mt-5" >
                            <div id="pdf-container"></div>
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
        .mcq-xm th {font-size: 24px}
        .mcq-xm td {font-size: 22px}
        .written-xm th {font-size: 24px}
        .written-xm td {font-size: 22px}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <!--<link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/pdfannotate.css">-->
    <!--<link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/styles.css">-->


    <link rel="stylesheet" href="{{ asset('/') }}backend/ppdf/css/pdfviewer.jquery.css"/>
    <style>
        .pdf-toolbar {display: none;}
        #pdf-container {overflow: scroll; height: 500px;}
        .aks-video-player { width: 99%!important;}
    </style>
    <style>
        .my-box { width: 100%!important;}
        .canvas-container, canvas {
            width: 100%!important;
            margin-top: 10px!important;
            height:auto;

               /* .my-box { width: 100%!important;} */
        /*.canvas-container, canvas { */
            /* width: 100%!important; */
        /*     margin-top: 10px!important;}*/
        /*    @media screen and (max-width: 768px){*/
        /*    #pdfContentPrintDiv {overflow: scroll;}*/
        /*}*/


        }
        /*.canvas{*/
        /*     overflow:scroll !important;*/
        /*}*/

        .video-container{
            width:100%!important;
            height: 440px;
            overflow:hidden;
            position:relative;


            padding-bottom: 56.25%;
            padding-top: 25px;
            /*height: 0;*/
        }
        .video-container iframe{
            position: absolute;
            top: -60px;
            left: 0;
            width: 100%;
            /*height: calc(80% + 100px);*/
            /* height: 500px!important; */
        }
        .video-foreground{
            pointer-events:auto;
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
            margin-bottom: 2px!important;
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
            margin-bottom: 2px!important;
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

    {{-- <link type="text/css" rel="stylesheet" href="https://unpkg.com/aksvideoplayer@1.0.0/dist/aksVideoPlayer.min.css"> --}}
@endpush

@section('js')


{{--    note--}}
<script>
    $(document).on('click', '.get-text-data', function () {
        var contentId = $(this).attr('data-content-id');
        $.ajax({
            url:"{{ route('front.student.get-text-type-content') }}",
            method: "GET",
            data: {content_id:contentId},
            success: function (data) {
                // console.log(data);
                $('#printHere').html(data);
                $('#commonPrintModel').modal('show');
            }
        })
    })
    function checkHasClassXm(elementObject) {
        var hasClassXm = elementObject.attr('data-has-class-xm');
        var isClassXmComplete = elementObject.attr('data-complete-class-xm');
        if (isClassXmComplete == 1)
        {
            return true;
        } else {
            if (hasClassXm == 0)
            {
                return true;
            } else {
                $.ajax({
                    url:"{{ route('front.student.show-class-exam-ajax') }}",
                    method: "GET",
                    data: {content_id:elementObject.attr('data-content-id')},
                    success: function (data) {
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
        $(document).on('click', '.open-video-modal', function () {
            var status = checkHasClassXm($(this));
            var has_exam = $(this).data('has-class-xm');
            var title = $(this).data('title');
            if (has_exam != 1) {
                $('.see-answer').hide();
            }

            if (status == true)
            {
                var contentId = $(this).attr('data-content-id');
                $.ajax({
                    url: base_url+'get-video-comments/'+contentId+'/course_content',
                    method: "GET",
                    // data: {content_id:elementObject.attr('data-content-id')},
                    success: function (data) {
                        // console.log(data);
                        $('#videoCommentDiv').html(data);
                    }
                })
                var videoVendor = $(this).attr('data-video-vendor');
                var videoLink = $(this).attr('data-video-link');
                if (videoVendor == 'youtube')
                {
                    var videoUrl = '';
                    $.ajax({
                        url: 'https://ytstream-download-youtube-videos.p.rapidapi.com/dl?id='+videoLink,
                        method: "GET",
                        contentType: "application/json",
                        headers: {"X-RapidAPI-Host":"ytstream-download-youtube-videos.p.rapidapi.com","X-RapidAPI-Key": "1060b8398cmsh0fa736b29e6e50ep11b5aajsn1e379b06e042"},
                        success: function (response) {
                            // console.log(response);
                            if (response.status == 'OK' && response.id == videoLink)
                            {
                                console.log(response.formats);

                                $.each(response.formats, function (key, value) {
                                    if (value.itag == "22")
                                    {
                                        videoUrl    = value.url;
                                    }
                                    else {
                                        videoUrl    = value.url;
                                    }
                                })
                                $("#video").empty().aksVideoPlayer({
                                     file: [
                                        {
                                            file: videoUrl,
                                            label: "1080p"
                                        },
                                        {
                                            file: videoUrl,
                                            label: "720p"
                                        },
                                        {
                                            file: videoUrl,
                                            label: "540p"
                                        },
                                        {
                                            file: videoUrl,
                                            label: "360p"
                                        },
                                        {
                                            file: videoUrl,
                                            label: "240p"
                                        }
                                    ],
                                    // width: $(this).parent().height(),
                                    height: $(this).parent().width(),
                                    poster: "",
                                    forward: true, // video forward button
                                    forwardValue: 10,
                                });
                            }
                        }
                    })

                    $('.youtube').removeClass('d-none');
                    $('.private').addClass('d-none');
                    $('.vimeo').addClass('d-none');
                    $('.see-answer').attr('href','/student/show-course-class-exam-answers/'+contentId+'/'+title)
                    $('.video-modal').modal('show');
                } else if (videoVendor == 'private')
                {
                    $('.private').removeClass('d-none');
                    $('.youtube').addClass('d-none');
                    $('.vimeo').addClass('d-none');
                    $('#privatVid').attr('src', videoLink);
                    $('.video-modal').modal('show');
                } else if (videoVendor == 'vimeo')
                {
                    $('.private').removeClass('d-none');
                    $('.youtube').addClass('d-none');
                    $('.vimeo').addClass('d-none');
                     $('#vimeoPlayer').attr('src', 'https://player.vimeo.com/video/'+videoLink+'?h=627084a88d&autoplay=0&loop=1&title=0&byline=0&portrait=0');
                    // $('#vimeoPlayer').attr('src', 'https://player.vimeo.com/video/'+videoLink+');
                    $('.video-modal').modal('show');
                }

            } else {
                return false;
            }
        })

        $(function(){
            // Disable right-click for the entire page
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            // Disable text selection
            document.body.style.userSelect = 'none';

            // Disable access to developer tools and prevent copying via key events
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.key === 'F12') {
                    e.preventDefault();
                }
            });
        });
        // Global variable to store the Plyr instance
        let player;

        $(document).on('click', '.show-video-modal', function () {
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
                var embedUrl = (videoVendor == 'youtube')
                    ? 'https://www.youtube.com/embed/' + videoLink + '?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1'
                    : videoLink;

                // Update the src attribute dynamically
                $('#play-now').attr('src', embedUrl);
                if (videoVendor == 'youtube') {
                    $('.see-answer').attr('href', '/student/show-course-class-exam-answers/' + contentId + '/' + title);
                }

                // Initialize Plyr player instance
                if (player) {
                    player.destroy(); // Destroy the previous instance to avoid conflicts
                }
                player = new Plyr('#player', {
                    controls: [
                        'play-large',
                        'rewind',
                        'play',
                        'fast-forward',
                        'progress',
                        'current-time',
                        'duration',
                        'mute',
                        'volume',
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
                        youtubePlayer.setPlaybackQuality('hd720'); // Set the desired quality (e.g., 'hd720', 'hd1080')
                    });
                });

                $('.video-modal').modal('show'); // Show the modal
            } else {
                return false;
            }

            // Disable right-click for the entire page
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            // Disable text selection
            document.body.style.userSelect = 'none';

            // Disable access to developer tools and prevent copying via key events
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.key === 'F12') {
                    e.preventDefault();
                }
            });
        });

        // Clear the src and destroy the player when the modal is hidden
        $('.video-modal').on('hidden.bs.modal', function () {
            if (player) {
                player.destroy(); // Destroy the Plyr instance
                player = null; // Reset the player variable
            }
            $('#play-now').attr('src', ''); // Clear the src to stop video playback
        });

        // Clear the src when the modal is hidden to stop the video playback
        $('.video-modal').on('hidden.bs.modal', function () {
            $('#play-now').attr('src', ''); // Clear the src to stop video playback
        });

    </script>

    <script>
        function close_video(){
            $("#video").empty();
        }
    </script>

    <script>
        $(document).on('click', '.ytp-cued-thumbnail-overlay', function () {
            alert('hi');
        })
        $(document).on('click', 'iframe', function () {
            alert('hiii');
        })
    </script>







    <!--ppdf-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script src="{{ asset('/') }}backend/ppdf/js/pdfviewer.jquery.js"></script>
    <script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>


    <script>
        $(document).on('click', '.show-pdf', function () {

            event.preventDefault();
            var sectionContentId = $(this).attr('data-content-id');
            $.ajax({
                // url: base_url+"student/show-pdf/"+sectionContentId,
                url: base_url+"student/show-pdf/"+sectionContentId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    var pdflink = '';
                    if(data.sectionContent.pdf_link != null )
                    {
                        pdflink = data.sectionContent.pdf_link;
                    } else {
                        pdflink = 'https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com/'+data.sectionContent.pdf_file;
                    }
                    $('#pdf-container').empty();

                    k = 'bf8a4943b5194d16ab2870cbfb4ee5e9';


                    // $('#pdf-container').pdfViewer(pdflink);
                    var adobeDCView = new AdobeDC.View({clientId: k, divId: "pdf-container"});
                    adobeDCView.previewFile(
                    {
                        content:   {location: {url: pdflink}},
                        metaData: {fileName: "pdfviewer.pdf"},
                    },
                    {
                        embedMode: "IN_LINE",
                        showAnnotationTools: false,
                        showDownloadPDF: false,
                        showPrintPDF: false,
                    }
            );

                    if(data.sectionContent.can_download_pdf == 1 )
                    {
                        $('#pdfDownloadLink').attr('href', pdflink).html('Download Now').attr('class', 'btn btn-success btn-sm float-end me-4 mt-2');
                    } else {
                        $('#pdfDownloadLink').attr('href', '').html('').attr('class', '');
                    }
                    $('.show-pdf-modal').modal('show');
                }
            })

        })


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

