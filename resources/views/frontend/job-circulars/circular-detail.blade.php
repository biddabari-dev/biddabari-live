@extends('frontend.master')

@section('body')
    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 style="color: black">{{ $circular->post_title }}</h2>
                    <div class="blog-details-content pr-20">
                        <div class="blog-preview-img text-center">
                            <img src="{{ asset(!empty($circular->image) ? $circular->image : 'frontend/assets/images/biddabari-image.jpg') }}" alt="Circular Details" class="img-fluid">
                        </div>

                        @push('style')
                            <link rel="stylesheet"
                                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/pdfannotate.css">
                            <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/pdf-draw/styles.css">
                            <style>
                                /*.canvas-container, canvas { width: 100%!important; margin-top: 10px!important;}*/
                            </style>
                        @endpush

                        @push('script')
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
                            <script>
                                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';
                            </script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
                            <script src="{{ asset('/') }}backend/assets/plugins/pdf-draw/arrow.fabric.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
                            <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
                            <script src="{{ asset('/') }}backend/assets/plugins/pdf-draw/pdfannotate.js"></script>
                            <script>



                                @if (isset($circular))
                                    var pdf = new PDFAnnotate("pdf-container",
                                            "{{ !empty($circular->featured_pdf) ? asset($circular->featured_pdf) : '' }}", {
                                            @elseif (isset($circular) && !empty($circular->featured_pdf))
                                                var pdf = new PDFAnnotate("pdf-container",
                                                    "{{ !empty($circular->featured_pdf) ? asset($circular->featured_pdf) : '' }}", {
                                                    @endif





                                                    onPageUpdated(page, oldData, newData) {
                                                        console.log(page, oldData, newData);
                                                    },
                                                    ready() {
                                                        console.log("Plugin initialized successfully");
                                                    },
                                                    scale: 1.5,
                                                    pageImageCompression: "SLOW", // FAST, MEDIUM, SLOW(Helps to control the new PDF file size)
                                                });

                                            function changeActiveTool(event) {
                                                var element = $(event.target).hasClass("tool-button") ?
                                                    $(event.target) :
                                                    $(event.target).parents(".tool-button").first();
                                                $(".tool-button.active").removeClass("active");
                                                $(element).addClass("active");
                                            }

                                            function enableSelector(event) {
                                                event.preventDefault();
                                                changeActiveTool(event);
                                                pdf.enableSelector();
                                            }

                                            function enablePencil(event) {
                                                event.preventDefault();
                                                changeActiveTool(event);
                                                pdf.enablePencil();
                                            }

                                            function enableAddText(event) {
                                                event.preventDefault();
                                                changeActiveTool(event);
                                                pdf.enableAddText();
                                            }

                                            function enableAddArrow(event) {
                                                event.preventDefault();
                                                changeActiveTool(event);
                                                pdf.enableAddArrow();
                                            }

                                            function addImage(event) {
                                                event.preventDefault();
                                                pdf.addImageToCanvas()
                                            }

                                            function enableRectangle(event) {
                                                event.preventDefault();
                                                changeActiveTool(event);
                                                pdf.setColor('rgba(255, 0, 0, 0.3)');
                                                pdf.setBorderColor('blue');
                                                pdf.enableRectangle();
                                            }

                                            function deleteSelectedObject(event) {
                                                event.preventDefault();
                                                pdf.deleteSelectedObject();
                                            }

                                            function savePDF() {
                                                // pdf.savePdf();
                                                pdf.savePdf("written-ans"); // save with given file name
                                            }

                                            function clearPage() {
                                                pdf.clearActivePage();
                                            }

                                            function showPdfData() {
                                                var string = pdf.serializePdf();
                                                $('#dataModal .modal-body pre').first().text(string);
                                                PR.prettyPrint();
                                                $('#dataModal').modal('show');
                                            }

                                            $(function() {
                                                $('.color-tool').click(function() {
                                                    $('.color-tool.active').removeClass('active');
                                                    $(this).addClass('active');
                                                    color = $(this).get(0).style.backgroundColor;
                                                    pdf.setColor(color);
                                                });

                                                $('#brush-size').change(function() {
                                                    var width = $(this).val();
                                                    pdf.setBrushSize(width);
                                                });

                                                $('#font-size').change(function() {
                                                    var font_size = $(this).val();
                                                    pdf.setFontSize(font_size);
                                                });
                                            });
                            </script>
                            @endpush 




                            <div class="">
                                <div class="">
                                    <p>Published By: {{ $circular->user->name }} at
                                        {{ \Carbon\Carbon::parse($circular->created_at)->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <p class="text-muted">{{ $circular->job_title }}</p>
                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <p class="mb-0">Vacancy</p>
                                    <p class="mb-0">{{ $circular->vacancy }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-0">Publish Date</p>
                                    <p class="mb-0">{{ $circular->publish_date }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-0">Expire Date</p>
                                    <p class="mb-0">{{ $circular->expire_date }}</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                {!! $circular->description !!}
                            </div>

                            <div class="article-share">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="article-social-icon">
                                            <ul class="social-icon">
                                                <li class="title">Share :</li>
                                                <li>
                                                    <a href="https://www.facebook.com/" target="_blank">
                                                        <i class="ri-facebook-fill"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/" target="_blank">
                                                        <i class="ri-twitter-fill"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.pinterest.com/" target="_blank">
                                                        <i class="ri-instagram-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="side-bar-widget">
                            <h3 class="title">Recent posts</h3>
                            <div class="widget-popular-post">
                                @forelse($recentPosts as $recentPost)
                                    <article class="item">
                                        <a href="{{ route('front.job-circular-details', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}"
                                            class="thumb">
                                            <img src="{{ asset(isset($recentPost->image) ? $recentPost->image : 'frontend/assets/images/biddabari-image.jpg') }}"
                                                height="76" width="80" alt="Post">
                                        </a>
                                        <div class="info">
                                            <p>{{ \Carbon\Carbon::parse($recentPost->created_at)->isoFormat('D MMMM, YYYY') }}
                                            </p>
                                            <h4 class="title-text">
                                                <a
                                                    href="{{ route('front.job-circular-details', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">
                                                    {{ str()->words($recentPost->post_title, 8) }}
                                                </a>
                                            </h4>
                                        </div>
                                    </article>
                                @empty
                                    <article class="item">
                                        <p>No Circulars Available</p>
                                    </article>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
