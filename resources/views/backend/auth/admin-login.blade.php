<!doctype html>
<html lang="en" dir="ltr">
<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Noa - Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="laravel admin template, bootstrap admin template, admin dashboard template, admin dashboard, admin template, admin, bootstrap 5, laravel admin, laravel admin dashboard template, laravel ui template, laravel admin panel, admin panel, laravel admin dashboard, laravel template, admin ui dashboard">

    <!-- TITLE -->
    <title>BiddaBari - Admin Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/') }}frontend/logo/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/') }}frontend/logo/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/') }}frontend/logo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/') }}frontend/logo/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}frontend/logo/favicon/favicon-16x16.png">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('/') }}backend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('/') }}backend/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('/') }}backend/assets/css/skin-modes.css" rel="stylesheet" />



    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('/') }}backend/assets/plugins/icons/icons.css" rel="stylesheet" />

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('/') }}backend/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/assets/switcher/demo.css" rel="stylesheet">
<style>
        #viewPass {
            position: absolute;
            top: 20%;
            right: 2%;
        }
    </style>
</head>


<body class="ltr login-img">



<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{ asset('/') }}backend/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>


<!-- PAGE -->
<div class="page">
    <div>
        <!-- CONTAINER OPEN -->
        <div class="col col-login mx-auto text-center">
            <a href="{{ url('/') }}" class="text-center">
                <img src="{{ asset('/') }}frontend/logo/logo-md.svg" class="header-brand-img" alt="site logo" style="height: 80px">
            </a>
        </div>
        <div class="container-login100">
            <div class="wrap-login100 p-0">






                <div class="card-body">
                    <form class="login100-form validate-form auth-div" id="authModalForm" action="{{ route('login') }}" method="post">
                        @csrf
									<span class="login100-form-title">
										Login
									</span>
                        <div class="wrap-input100 validate-input mobile-div" data-order="0" data-active="1" data-bs-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="mobile" placeholder="Mobile Number">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="fa-regular fa-envelope" aria-hidden="true"></i>
										</span>
                        </div>
                        <div class="wrap-input100 validate-input otp-div d-none" data-order="1" data-bs-validate = "OTP is required: 1234">
                            <input class="input100" id="otpInput" type="number" placeholder="Enter OTP">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="fa-regular fa-envelope" aria-hidden="true"></i>
										</span>
                        </div>
                        <div class="wrap-input100 validate-input name-div d-none" data-order="2" data-bs-validate="Input Your Name">
                            <input class="input100" type="text" name="name" placeholder="Name">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="fa-regular fa-envelope" aria-hidden="true"></i>
										</span>
                        </div>
                        <div class="wrap-input100 validate-input password-div d-none" data-order="3" data-bs-validate = "Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span id="viewPass" class="btn btn-sm border show-pass"><i class="fa-solid fa-eye"></i></span>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="fa-solid fa-lock" aria-hidden="true"></i>
										</span>
                            <div class="mt-3">
                                <a href="{{ route('forgot-user-password') }}" class="float-end" style="color: black; ">Forgot Password?</a>
                            </div>
                        </div>
{{--                        <div class="text-end pt-1">--}}
{{--                            <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary ms-1">Forgot Password?</a></p>--}}
{{--                        </div>--}}
{{--                        <div class="container-login100-form-btn">--}}
{{--                            <button type="submit" class="login100-form-btn btn-primary">--}}
{{--                                Login--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="text-center pt-3">--}}
{{--                            <p class="text-dark mb-0">Not a member?<a href="{{ route('register') }}" class="text-primary ms-1">Create an Account</a></p>--}}
{{--                        </div>--}}
                    </form>
                </div>
                <div class="card-footer">
{{--                    <div class="d-flex justify-content-center my-3">--}}
{{--                        <a href="javascript:void(0)" class="social-login  text-center me-4">--}}
{{--                            <i class="fa-brands fa-google"></i>--}}
{{--                        </a>--}}
{{--                        <a href="javascript:void(0)" class="social-login  text-center me-4">--}}
{{--                            <i class="fa-brands fa-facebook"></i>--}}
{{--                        </a>--}}
{{--                        <a href="javascript:void(0)" class="social-login  text-center">--}}
{{--                            <i class="fa-brands fa-twitter"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <button type="button" class="btn btn-primary prev d-none w-100">Previous</button>
                    <button type="button" class="btn btn-primary next w-100">Next</button>
                </div>





{{--                <div class="card" style="width: 100%">--}}
{{--                    <div class="card-header">--}}
{{--                        <h1 class="card-title fs-5" id="exampleModalLabel">Login</h1>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="" method="post" id="authModalForm">--}}
{{--                            @csrf--}}
{{--                            <div class="auth-div">--}}
{{--                                <div class="row mobile-div" data-order="0" data-active="1">--}}
{{--                                    <label for="" class="col-md-4">Mobile</label>--}}
{{--                                    <div class="col-md-8">--}}
{{--                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" />--}}
{{--                                        <span class="text-danger" id="name"></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row otp-div d-none" data-order="1" >--}}
{{--                                    <label for="" class="col-md-4">Enter OTP</label>--}}
{{--                                    <div class="col-md-8">--}}
{{--                                        <input type="number" id="otpInput" class="form-control" placeholder="Enter OTP" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row name-div mt-3 d-none" data-order="2">--}}
{{--                                    <label for="" class="col-md-4">Name</label>--}}
{{--                                    <div class="col-md-8">--}}
{{--                                        <input type="text" name="name" class="form-control" placeholder="Name" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row password-div mt-3 d-none" data-order="3">--}}
{{--                                    <label for="" class="col-md-4">Password</label>--}}
{{--                                    <div class="col-md-8">--}}
{{--                                        <input type="password" name="password" class="form-control" placeholder="Password" />--}}
{{--                                        <span class="text-danger" id="password"></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                        <button type="button" class="btn btn-primary prev d-none">Previous</button>--}}
{{--                        <button type="button" class="btn btn-primary next">Next</button>--}}
{{--                    </div>--}}
{{--                </div>--}}





            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!-- End PAGE -->


<!-- JQUERY JS -->
<script src="{{ asset('/') }}backend/assets/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('/') }}backend/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('/') }}backend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('/') }}backend/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- STICKY JS -->
<script src="{{ asset('/') }}backend/assets/js/sticky.js"></script>



<!-- COLOR THEME JS -->
<script src="{{ asset('/') }}backend/assets/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('/') }}backend/assets/js/custom.js"></script>

<!-- SWITCHER JS -->
<script src="{{ asset('/') }}backend/assets/switcher/js/switcher.js"></script>

{{--toastr assets--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.next', function () {
        event.preventDefault();
        var getClassDivOrder = $('.auth-div').find('[data-active="1"]').attr('data-order');
        var mobileNumber = $('.auth-div input[name="mobile"]').val();
        if (getClassDivOrder == 0)
        {


            $.ajax({
                url: "{{ route('front.send-otp') }}",
                method: "POST",
                dataType: "JSON",
                data: {mobile:mobileNumber},
                 beforeSend:function (){
                    $('.next').attr('disabled','disabled');
                },
                success: function (data) {
                    // console.log('send otp: '+data);
                    // if (data.status == 'success')
                    if (data.status == 'success')
                    {
                        $('.mobile-div').addClass('d-none').attr('data-active', '');

                        if (data.user_status == 'exist')
                        {
                            $('.password-div').removeClass('d-none').attr('data-active', 1);
                              $('.next').attr('disabled',false);
                            $('.next').removeClass('next').addClass('submit').text('Login').attr('data-status', 'login');
                        } else if (data.user_status == 'not_exist')
                        {
                            $('.otp-div').removeClass('d-none').attr('data-active', 1);
                            toastr.success('You will get otp shortly. Please input Otp correctly.');
                        }
                          $('.next').attr('disabled',false);



                        // $('.otp-div').removeClass('d-none').attr('data-active', 1);
                        // toastr.success('You will get otp shortly. Please input Otp correctly.');
                        // $('.mobile-div').addClass('d-none').attr('data-active', '');
                        // $('.otp-div').removeClass('d-none').attr('data-active', 1);
                    } else {
                        toastr.error('something went wrong. Please check your mobile Number & try again.');
                    }
                }
            })
        } else if (getClassDivOrder == 1)
        {
            var otpNumber = $('#otpInput').val();

            $.ajax({
                url: "{{ route('front.verify-otp') }}",
                method: "POST",
                dataType: "JSON",
                data: {otp:otpNumber, mobile_number:mobileNumber},
                success: function (data) {
                    // console.log('sarowar');
                    // console.log(data);
                    if (data.status == 'success')
                    {
                        $('.otp-div').addClass('d-none').attr('data-active', '');
                        if (data.user_status == 'exist')
                        {
                            $('.password-div').removeClass('d-none').attr('data-active', 1);
                            $('.next').removeClass('next').addClass('submit').text('Login').attr('data-status', 'login');
                        } else if (data.user_status == 'not_exist')
                        {
                            $('.name-div').removeClass('d-none').attr('data-active', 1);
                            $('.password-div').removeClass('d-none').attr('data-active', 1);
                            $('.next').removeClass('next').addClass('submit').text('Register').attr('data-status', 'register');
                        }
                        // $('#registerForm').submit();
                    } else {
                        console.log('something went wrong. Please try again.');
                    }
                }
            })
        }
    })
    $(document).on('click', '.submit', function () {
        event.preventDefault();
        var formData = $('#authModalForm').serialize();
        var authStatus = $(this).attr('data-status');
        var ajaxUrl = '';
        if (authStatus == 'login')
        {
            ajaxUrl = "{{ route('login') }}";
        } else if (authStatus == 'register')
        {
            ajaxUrl = "{{ route('register') }}"
        }
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            dataType: "JSON",
            data: formData,
            success: function (data) {
                console.log(data);
                if (data.status == 'success')
                {
                    toastr.success('Your are successfully logged in the website.');
                    window.location.href = data.url;
                    // window.location.reload();
                } else if (data.status == 'error')
                {
                    toastr.error('Something went wrong. Please try again');
                }
            },
            error: function (errors) {
                if (errors.responseJSON)
                {

                    var allErrors = errors.responseJSON.errors;
                    for (key in allErrors)
                    {
                        $('#'+key).empty().append(allErrors[key]);
                    }
                }
            }
        })
    })
</script>
<script>
    $(document).on('click', '#viewPass', function () {
        if ($(this).hasClass('show-pass'))
        {
            $('input[name="password"]').attr('type', 'text');
            $(this).removeClass('show-pass').addClass('hide-pass');
        } else if ($(this).hasClass('hide-pass'))
        {
            $('input[name="password"]').attr('type', 'password');
            $(this).removeClass('hide-pass').addClass('show-pass');
        }
    })
</script>

@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        toastr.error("{{ \Illuminate\Support\Facades\Session::get('error') }}");
    </script>
@endif
</body>
</html>
