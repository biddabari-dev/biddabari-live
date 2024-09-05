@extends('frontend.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('/') }}backend/ppdf/css/pdfviewer.jquery.css" />
    <style>
        .pdf-toolbar {
            display: none;
        }

        #pdf-container {
            overflow: scroll;
            height: 500px;
        }
    </style>
@endpush
@section('body')
    <div class="courses-area-two section-bg py-5">
        <div class="container">
            <div class="section-title text-center mb-3">
                <!--   <span>কোর্স সমূহ</span>-->
                <h1> সকল নোটিশ সমূহ</h1>
                <hr class="w-25 mx-auto bg-danger" />
            </div>
            <div class="row">
                <div class="col-md-8">
                    @if (count($notices) > 0)
                        @forelse($notices as $key => $notice)
                            @if (isset($_GET['notice-id']))
                                @if ($notice->id == $_GET['notice-id'])
                                    <div class="courses-item notice-content">
                                        <div class="content ">
                                            <h2><a href="javascript:void(0)">{{ $notice->title }}</a></h2>
                                            @if (isset($notice->image))
                                                <div class="row">
                                                    <div class="col-md-6 mx-auto">


                                                    </div>
                                                </div>
                                            @endif
                                            <span class="dis-course-amount">{!! $notice->body !!}</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="courses-item notice-content">
                                    <div class="content ">
                                        <h3><a href="javascript:void(0)">{{ $notices[0]->title }} </a></h3>
                                        @if (isset($notices[0]->image))
                                            <div class="row">
                                                <div class="mx-auto">
                                                    <div id="pdf-container" data-link="{{ asset($notices[0]->image) }}"
                                                        style="width: 100%; height: 800px;"></div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @break
                        @endif
                    @empty
                        <div class="courses-item notice-content">
                            <div class="content ">
                                <p><a href="javascript:void(0)">No Notices Published Yet.</a></p>
                            </div>
                        </div>
                    @endforelse
                @endif

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header py-0" style="background-color: #F18345;">
                        <h2 class="text-center text-white f-s-38 mb-0">Latest Notices</h2>
                    </div>
                    @forelse($notices as $notice)
                        <div class="card-body py-2 border-bottom">
                            <!-- Notice link triggers JavaScript function to load the PDF -->
                            <a href="javascript:void(0);" class="w-100"
                                onclick="loadPDF('{{ asset($notice->image) }}', '{{ $notice->title }}')">
                                <div class="row">
                                    <div class="col-md-2 px-0">
                                        <!-- PDF icon for the notice -->
                                        <i class="fa-solid fa-file-pdf pl-2"
                                            style="font-size: 50px; color: red;"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <!-- Display the date and title of the notice -->
                                            <span class="text-muted">{{ showDateFormatTwo($notice->created_at) }}</span>
                                            <h3 class="f-s-20 p-0">{{ $notice->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="card-body">
                            <p><a href="javascript:void(0)">No Notices Published Yet.</a></p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!--ppdf-->
<!-- Include necessary scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script src="{{ asset('/') }}backend/ppdf/js/pdfviewer.jquery.js"></script>

<!-- Adobe PDF Viewer SDK -->
<script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>

<script>
    $(document).ready(function() {
        // Wait for the Adobe SDK to be loaded
        if (typeof AdobeDC === "undefined") {
            window.addEventListener('adobe_dc_view_sdk.ready', function() {
                initializeAdobeViewer();
            });
        } else {
            initializeAdobeViewer();
        }
    });

    function initializeAdobeViewer() {
        var pdflink = $("#pdf-container").data('link');
        var k = 'bf8a4943b5194d16ab2870cbfb4ee5e9';
        // Initialize Adobe PDF Viewer
        var adobeDCView = new AdobeDC.View({
            clientId: k,
            divId: "pdf-container"
        });

        // Preview the PDF file
        adobeDCView.previewFile({
            content: {
                location: {
                    url: pdflink
                }
            },
            metaData: {
                fileName: "pdfviewer.pdf"
            }
        }, {
            embedMode: "IN_LINE", // Other options: "FULL_WINDOW", "SIZED_CONTAINER"
            showAnnotationTools: false, // Disable annotation tools
            showDownloadPDF: false, // Disable PDF download
            showPrintPDF: false // Disable PDF print
        });
    }
</script>

<script>
    // Load PDF using Adobe PDF Viewer SDK
    function loadPDF(pdfUrl, title) {
        // Check if the Adobe SDK is ready
        var k = 'bf8a4943b5194d16ab2870cbfb4ee5e9';
        if (typeof AdobeDC !== "undefined") {
            // Initialize Adobe Viewer
            var adobeDCView = new AdobeDC.View({clientId: k, divId: "pdf-container"});

            // Load the PDF file
            adobeDCView.previewFile(
                {
                    content: {location: {url: pdfUrl}}, // Use the URL of the selected PDF
                    metaData: {fileName: title}
                },
                {
                    embedMode: "IN_LINE", // Embed the PDF in the specified container
                    showAnnotationTools: false, // Disable annotation tools
                    showDownloadPDF: false,     // Disable PDF download
                    showPrintPDF: false         // Disable PDF print
                }
            );
        } else {
            console.error("AdobeDC is not defined. Make sure the Adobe PDF Viewer SDK script is loaded correctly.");
        }
    }

    $(document).ready(function() {
        // Automatically load the first notice's PDF when the page is loaded
        var firstPdfLink = $("#pdf-container").data('link');
        if (firstPdfLink) {
            loadPDF(firstPdfLink, 'Notice');
        }
    });
</script>

@endsection
