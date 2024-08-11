@extends('frontend.master')

@section('body')
<link rel="stylesheet" href="https://cdn.rawgit.com/dimsemenov/Magnific-Popup/master/dist/magnific-popup.css">
<style>
    .section-header {
  text-align: center;
  margin: 60px auto 20px auto;

  font-size: 48px;
  font-weight: 700;
  text-transform: uppercase;
  color: #222;
}

.section-header-underline {
  border: 1px solid #222;
  width: 3rem;
  margin: 0 auto;
  margin-bottom: 30px;
}

.video-gallery {
  position: relative;
  margin: 0 auto;
  max-width: 1000px;
  text-align: center;
}

.video-gallery .gallery-item {
  position: relative;
  float: left;
  overflow: hidden;
  margin: 10px 1%;
  min-width: 320px;
  max-width: 580px;
  max-height: 360px;
  width: 48%;
  background: #000;
  cursor: pointer;
}

.video-gallery .gallery-item img {
  position: relative;
  display: block;
  opacity: .45;
  width: 105%;
  height: 300px;
  transition: opacity 0.35s, transform 0.35s;
  transform: translate3d(-23px, 0, 0);
  backface-visibility: hidden;
}

.video-gallery .gallery-item .gallery-item-caption {
  padding: 2em;
  color: #fff;
  text-transform: uppercase;
  font-size: 1.25em;
}

.video-gallery .gallery-item .gallery-item-caption,
.video-gallery .gallery-item .gallery-item-caption > a {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.video-gallery .gallery-item h2 {
  font-weight: 300;
  overflow: hidden;
  padding: 0.5em 0;
}


.video-gallery .gallery-item h2,
.video-gallery .gallery-item p {
  position: relative;
  margin: 0;
  z-index: 10;
}

.video-gallery .gallery-item p {
  letter-spacing: 1px;
  font-size: 68%;

  padding: 1em 0;
  opacity: 0;
  transition: opacity 0.35s, transform 0.35s;
  transform: translate3d(10%, 0, 0);
}

.video-gallery .gallery-item:hover img {
  opacity: .3;
  transform: translate3d(0, 0, 0);

}

.video-gallery .gallery-item .gallery-item-caption {
  text-align: left;
}

.video-gallery .gallery-item h2::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 15%;
  height: 1px;
  background: #fff;
  
  transition: transform 0.3s;
  transform: translate3d(-100%, 0, 0);
}

.video-gallery .gallery-item:hover h2::after {
  transform: translate3d(0, 0, 0);
}

.video-gallery .gallery-item:hover p {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}

@media screen and (max-width: 50em) {
  .video-gallery .gallery-item {
    display: inline-block;
    float: none;
    margin: 10px auto;
    width: 100%;
  }
}

</style>
    <div class="instructors-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="instructors-details-img">
                        <img src="{{ asset(isset($teacher->image) ? $teacher->image : 'https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg') }}"
                            alt="Instructor" />
                        <h3 class="f-s-39  ">{{ $teacher->first_name . ' ' . $teacher->last_name }}</h3>

                        <ul class="social-link">
                            <li class="social-title">Follow me:</li>
                            <li>
                                <a href="{{ $teacher->facebook }}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $teacher->twitter }}" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $teacher->linkedin }}" target="_blank">
                                    <i class="ri-linkedin-line"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="text_justify f-s-20">
                        {{Str::limit( $teacher->github, 430)}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="instructors-details-content pl-20">
                        @if (!empty($teacher->teacher_intro_video ))
                        <div class="">
                            <h3 class="f-s-39">Teacher’s Intro & Special Tips</h3>
                            <div class="top_slide_video_content">
                                <video class="border-0" style="width: 100%!important;" controls>
                                    <source src="{{ asset($teacher->teacher_intro_video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            @if (!empty($teacher->demo_video_1 || $teacher->demo_video_2))
                            <h3 class="f-s-39"> Short Classes</h3>
                            @endif
                            @if (!empty($teacher->demo_video_1 ))
                            <div class="col-md-6">
                                <div class="top_slide_video_content">
                                    <video class="border-0" style="width: 100%!important;" controls>
                                        <source src="{{ asset($teacher->demo_video_1) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            @endif
                            @if (!empty($teacher->demo_video_2))
                            <div class="col-md-6">
                                <div class="top_slide_video_content">
                                    <video class="border-0" style="width: 100%!important;" controls>
                                        <source src="{{ asset($teacher->demo_video_2) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- <h3 class="f-s-39">{{ $teacher->first_name. ' ' . $teacher->last_name }}</h3> --}}
                        {{-- <span class="sub-title f-s-24">{{ $teacher->subject }}</span> --}}
                        {{-- <ul>
                            <li class="f-s-22 mb-0">Phone number: <span><a href="tel:{{ $teacher->mobile }}">{{ $teacher->mobile }} </a></span></li>
                            <li class="f-s-22 mb-0">Email: <span><a href="mailto:{{ $teacher->email }}"><span class="__cf_email__">{{ $teacher->email }}</span></a></span></li>
                            <li class="f-s-22 mb-0">Website: <span><a href="{{ $teacher->website }}" target="_blank">{{ $teacher->website }}</a></span></li>
                        </ul> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="content">
                        <h1 class="section-header">Video Gallery</h1>
                        <div class="section-header-underline"></div>
                        <div class="video-gallery">
                          <div class="gallery-item">
                            <img src="https://i.pinimg.com/originals/75/f9/97/75f997ee6acf59dc51bbea05eae36677.jpg" alt="North Cascades National Park" />
                            <div class="gallery-item-caption">
                              <div>
                                <h2>North Cascades</h2>
                                <p>The mountains are calling</p>
                              </div>
                              <a class="vimeo-popup" href="https://vimeo.com/3653567"></a>
                            </div>
                          </div>
                      
                          <div class="gallery-item ">
                            <img src="https://cdn.davemorrowphotography.com/wp-content/uploads/2016/08/Mount-Rainier-Star-Photography-Workshops-and-Tours-Header-900x394.jpg" alt="Mt. Rainier" />
                            <div class="gallery-item-caption">
                              <div>
                                <h2>Mt. Rainier</h2>
                                <p>14410 feet of adventure</p>
                              </div>
                              <a class="vimeo-popup" href="https://vimeo.com/179049611"></a>
                            </div>
                          </div>
                      
                          <div class="gallery-item">
                            <img src="https://wqtcq1f34a8kduuv3sc0e76o-wpengine.netdna-ssl.com/wp-content/uploads/2018/06/12394537_web1_180620-pdn-goat-web.jpg" alt="Olympic National Park" />
                            <div class="gallery-item-caption">
                              <div>
                                <h2>Olympic National Park</h2>
                                <p>Mountains, rain forests, wild coastlines</p>
                              </div>
                              <a class="vimeo-popup" href="https://vimeo.com/108785446"></a>
                            </div>
                          </div>
                      
                          <div class="gallery-item">
                            <img src="https://www.sciencenewsforstudents.org/sites/default/files/main/articles/cvob0070_openerfree.jpg" alt="Mount St. Helens" />
                            <div class="gallery-item-caption">
                              <div>
                                <h2>Mount St. Helens</h2>
                                <p>The one and only</p>
                              </div>
                              <a class="vimeo-popup" href="https://vimeo.com/171540296"></a>
                            </div>
                          </div>
                      
                        </div>
                      </div>
                </div>
                @if (!empty($teacher->description))
                    <h3 class="f-s-32 text-danger py-3">শিক্ষার্থীদের জন্য কিছু গুরুত্বপূর্ণ কথা :</h3>
                    <div class="f-s-20">
                        {!! $teacher->description !!}
                    </div>
                @endif
            </div>
        </div>
    </div>


    {{-- <div class="courses-area pb-70">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Find Latest courses</h2>

            </div>
            <div class="row">
                @foreach ($latestCourses as $latestCourse)
                    <div class="col-lg-4 col-md-6">
                        <div class="courses-item">
                            <a
                                href="{{ route('front.course-details', ['id' => $latestCourse->id, 'slug' => $latestCourse->slug]) }}">
                                <img src="{{ asset(file_exists_obs($latestCourse->banner) ? $latestCourse->banner : '/frontend/logo/biddabari-card-logo.jpg') }}"
                                    alt="Courses" style="width: 100%; height: 200px" />
                            </a>
                            <div class="content">
                                <div class="price-text">BDT. {{ $latestCourse->price }}</div>
                                <h3><a
                                        href="{{ route('front.course-details', ['id' => $latestCourse->id, 'slug' => $latestCourse->slug]) }}">{{ $latestCourse->title }}</a>
                                </h3>
                                <ul class="course-list">
                                    <li><i class="ri-time-fill"></i> {{ $latestCourse->total_hours }} min</li>
                                    <li><i class="ri-vidicon-fill"></i> {{ $latestCourse->total_video }} lectures</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdn.rawgit.com/dimsemenov/Magnific-Popup/master/dist/jquery.magnific-popup.js"></script>

    <script>
        $(document).ready(function() {
  $('.video-gallery').magnificPopup({
  delegate: 'a', 
  type: 'iframe',
  gallery:{
    enabled:true
  }
});
});
    </script>
@endsection
