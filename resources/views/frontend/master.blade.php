<!doctype html>
<html lang="en">

<head>
    @php $css_rand=rand(111,999); @endphp

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="@yield('robots', 'index')">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="description"        content="@yield('meta-description')" />
    <meta property="keywords"        content="@yield('meta-keywords')" />
    <link rel="canonical" href="@yield('meta-url')"/>
    {{--     for facebook --}}
    <meta property="og:url"                content="@yield('og-url')"/>
    <meta property="og:description"        content="@yield('meta-description')" />
    <meta property="og:image"              content="https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com/@yield('og-image')" />
    <meta property="og:image:width"        content="200"/>
    <meta property="og:image:height"       content="286"/>
    <meta name="facebook-domain-verification" content="g7t7phde3zn27hgjb1iaxlm67f8hdv" />
    {{--     for facebook --}}


    {!! isset($siteSettings->default_seo_code_on_header) ? $siteSettings->default_seo_code_on_header : '' !!}
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/plugins.css">

    <link rel="icon" type="image/png" href="{{ asset('/') }}frontend/logo/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/news-tinker/style.min.css" />
    <link rel="stylesheet" href="/frontend/assets/css/iconplugins.css">

    <link rel="stylesheet" href="/frontend/assets/css/style.css">

    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/responsive.css">

    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/theme-dark.css">

    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom.css?v={{ $css_rand }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- slick slide css -->
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


    <title>@yield('title')</title>

    <!-- HELPER CSS -->
    <link href="{{ asset('/') }}backend/assets/css/helper.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="{{ asset('/') }}frontend/assets/images/favicon.png">
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/news-tinker/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/custom-my-mod.css">

    {{-- ------------Video Gallery------------ --}}
    <link rel="stylesheet" href="https://cdn.rawgit.com/dimsemenov/Magnific-Popup/master/dist/magnific-popup.css">
    {{-- ------------Video Gallery------------ --}}



    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .box-shadow {
            box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.75);
            -webkit-box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.75);
        }
    </style>
    <style>
        .student-panel-menu li a { color: white; font-size: 20px;}
        .student-panel-menu li:hover a { color: #85AF54!important;}
        .st-menu-active { color: #85AF54!important; }
        .content-shadow{box-shadow: 0px 0px 25px #D6D6D6;}
    </style>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #F18345;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: black;
        }

    </style>
    @stack('style')




</head>
<body>

@include('frontend.includes.header')


@yield('body')

@include('frontend.includes.footer')

<a href="https://m.me/1652435885033225" class="go-messenger active" target="blank">
    <div class=""><i class="fa-brands fa-facebook-messenger"></i></div>
</a>

<!-- Messenger Chat Plugin Code -->
<!--<div id="fb-root"></div>-->
<!-- Messenger Chat Plugin Code -->


<script src="{{ asset('/') }}frontend/assets/js/jquery.min.js"></script>

<!--<script src="{{ asset('/') }}frontend/assets/js/plugins.js"></script>-->

<script src="{{ asset('/') }}frontend/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/meanmenu.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/ajaxchimp.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/form-validator.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/contact-form-script.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/magnific-popup.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/aos.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/odometer.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/appear.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}frontend/assets/js/tweenMax.min.js" type="text/javascript"></script>



<script src="{{ asset('/') }}frontend/assets/js/custom.js"></script>


<script src="{{ asset('/') }}frontend/assets/news-tinker/acmeticker.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/multi-countdown.js"></script>



<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>


@yield('js')

    <!-- slick slide cdn -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- slick slide cdn -->

{{--custom js--}}
<script  src="{{ asset('/') }}frontend/assets/js/my-custom-mod.js"></script>
{{--<script defer src="{{ asset('/') }}frontend/assets/js/my-custom-mod.min.js"></script>--}}

{{-- ----------Video Gallery------------------ --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://cdn.rawgit.com/dimsemenov/Magnific-Popup/master/dist/jquery.magnific-popup.js"></script>


<script>
    $(document).ready(function() {
        $('.video-gallery').magnificPopup({
            delegate: 'a',
            type: 'iframe',
            gallery: {
                enabled: true
            }
        });
    });
</script>

{{-- ----------Video Gallery------------------ --}}

<!-- Toastr Css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Sweet Alert -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet" />
<!-- Toastr JS -->
{{-- <script async src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Sweet Alert JS -->
<script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
@if(Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif
@if(Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
@endif
@if(Session::has('customError'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{ Session::get('customError') }}",
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    </script>
@endif



<script>
    let base_url = {!! json_encode(url('/')) !!}+'/';
</script>

<script>
    function addSimpleProCard(spid) {
        console.log(spid);
        var formcls = '.addSimpleCardFrom'+spid;
        var formurl = $(formcls).attr('action');
        var formurl = $(formcls).attr('action');
        // var cart= $('#cart_amount').text('sar');

    }
</script>

@stack('script')

{!! isset($siteSettings) ? $siteSettings->default_seo_code_on_footer : '' !!}
</body>
</html>
