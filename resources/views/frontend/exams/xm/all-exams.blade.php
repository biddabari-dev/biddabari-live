@extends('frontend.master')

@section('body')
    <div class="courses-area-two section-bg ">
        <div class="container bg-white ">
            <div class="row">
                @if(isset($masterExam))
                    <div class="col-md-12 mb-3 pt-5" >
                        <div class="text-center mb-5">
                            <a href="javascript:void(0)" class="btn border-main-color"><span class="fw-bolder fs-2">সকল এক্সাম সমূহ একসাথে কিনুন </span></a>
                        </div>
                        <div class="row ">
                            <!-- <div class="col-md-3">
                                <div class="">
                                    <img src="{{ asset(isset($masterExam) && !empty($masterExam->banner) ? $masterExam->banner : 'frontend/logo/biddabari-card-logo.jpg') }}" alt="" class="img-fluid " />
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="card card-body">
                                <div class="">
                                    <img src="{{ asset(isset($masterExam) && !empty($masterExam->banner) ? $masterExam->banner : 'frontend/logo/biddabari-card-logo.jpg') }}" alt="" class="img-fluid " />
                                </div>
                                    <h1 class="text-center mb-0">{{ $masterExam->title }}</h1>
                                    <p class="mb-0 f-s-22">{{ $masterExam->sub_title }}</p>
                                    <div class="mt-3">
                                        <div id="textContainer">
                                            <div id="mainText">
                                                {!! str()->words(strip_tags($masterExam->description), 20) !!}
                                                <span id="seeMore" style="cursor: pointer; color: orange">See More</span>
                                            </div>
                                            <div id="additionalText">
                                                {!! $masterExam->description !!}
                                                <span id="seeLess" style="display: none; cursor: pointer; color: orange">See Less</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <div class="row">
                                        @foreach($masterExam->batchExamSubscriptions as $subscription)
                                            <div class="col-md-6 mt-2">
                                                <div class="card card-body">
                                                <p class="f-s-26 mb-0">Package Name: {{ $subscription->package_title }}</p>
                                                    @if(!empty($subscription->discount_end_date) && \Illuminate\Support\Carbon::now()->between(dateTimeFormatYmdHi($subscription->discount_start_date), dateTimeFormatYmdHi($subscription->discount_end_date)))
                                                        <p class="f-s-26 mb-0">Price: <del>{{ $subscription->price }}</del> <span>{{ $subscription->price - $subscription->discount_amount }}</span> TK</p>
                                                    @else
                                                        <p class="f-s-26 mb-0">Price: <span>{{ $subscription->price }}</span> TK</p>
                                                    @endif
                                                    <p class="f-s-26 mb-0">Duration: {{ $subscription->package_duration_in_days }} days</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-12 mt-4">
                                            <div>
                                                @if($masterExam->purchase_status == 'true' || $masterExam->purchase_status == 'pending')
                                                    <button type="button" class="btn btn-block w-100 btn-outline-success" >{{ $masterExam->purchase_status == 'true' ? 'Purchased' : 'Pending' }}</button>
                                                @else
                                                    <button type="button" class="btn btn-block w-100 btn-outline-success open-modal" data-xm-id="{{ $masterExam->id }}">Order Now</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-12 pt-5" style="background-color: rgba(140,200,10, .1)">
                    <div class="text-center mb-5">
                        <a href="javascript:void(0)" class="btn border-main-color"><span class="fw-bolder fs-2">আমাদের এক্সাম সমূহ</span></a>
                    </div>
                    <div class="row">


                        <div class="col-md-12">
                            <div>
                                <ul class="nav nav-pills all-course-page-nav-pills text-center">
                                    <li class="nav-item mb-3"><button type="button" class="nav-link active border-danger btn py-0 mx-2 text-dark" style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#allCourses" ><span class="f-s-35">All Exams</span></button></li>
                                    @foreach($examCategories as $index => $examCategory)
                                        <li class="nav-item mb-3"><button type="button" class="nav-link border-danger btn py-0 mx-2 text-dark" style="border: 1px solid #F18C53" data-bs-toggle="pill" data-bs-target="#{{ 'id'.$index }}"><span class="f-s-35">{{ $examCategory->name }}</span></button></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-5">
                                    @foreach($examCategories as $key => $examCategory)
                                        @if($key == 0)
                                            <div class="tab-pane px-1 fade show active" id="allCourses">
                                                <div class="row">
                                                        @foreach($allExams as $batchExam)
                                                            @include('frontend.exams.xm.include-batch-exams', $batchExam)
                                                        @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <div class="tab-pane fade" id="{{ 'id'.$key }}">
                                            <div class="row">
                                                @if(count($examCategory->batchExams) < 0)
                                                    @forelse($examCategory->batchExams as $batchExam)
                                                        @include('frontend.exams.xm.include-batch-exams', $batchExam)
                                                    @empty
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="min-height: 300px">
                                                                <h2>কোনো এক্সাম চালু হয়নি। খুব দ্রুত এক্সাম চালু হবে। </h2>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Purcase Exams</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="printHere">
                    <div class="courses-details-area p-b-20">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-body">
                                        <!-- <div class="text-center">
                                            <img style="max-height: 250px" id="xmImage" src="{{ asset('frontend/logo/biddabari-card-logo.jpg') }}" alt="exam-image-text" class="img-fluid" />
                                        </div> -->
                                        <div class="mt-3">
                                            <!-- <h2 id="catName">catName</h2> -->
                                            <div class="row mt-2 xm-details-row">

                                                <div class="col-md-12">
                                                    <span id="description"></span>
                                                </div>
                                                <div class="col-md-12 mt-3" id="xmPackages">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                        <tr>
                                                            <th>Package Name</th>
                                                            <th>Price</th>
                                                            <th>Duration</th>
                                                            <th>Discount</th>
                                                            <th>Valid Till</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Package One</td>
                                                            <td>Price: 100Tk</td>
                                                            <td>Duration: 100Tk</td>
                                                            <td>Discount: 100Tk</td>
                                                            <td>Valid Till: 22-23-5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Package One</td>
                                                            <td>Price: 100Tk</td>
                                                            <td>Duration: 100Tk</td>
                                                            <td>Discount: 100Tk</td>
                                                            <td>Valid Till: 22-23-5</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .xm-details-row p{
            font-size: 25px!important;
        }
        .xm-payment-div p{
            font-size: 20px!important;
        }
    </style>
    <style>
        #textContainer {
            overflow: hidden;
        }

        #additionalText {
            display: none;
        }
    </style>
@endpush

@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @if($errors->any())
        <script>
            $(function () {
                $('#staticBackdrop').modal('show');
            })
        </script>
    @endif
    <script>
        $(function () {
            $('.select2').select2();
            @if(isset($_GET['rc']) && isset($_GET['bxid']) && $_GET['bxid'] != '' && $_GET['rc'] != '')

                batchExamDetailsShowModal({!! $_GET['bxid'] !!})
            @endif
        })
    </script>

    <script>
        $(document).on('click', '.open-modal', function () {
            var xmId = $(this).attr('data-xm-id');
            batchExamDetailsShowModal(xmId);
        })
        function batchExamDetailsShowModal(xmId)
        {
            $.ajax({
                url: base_url+"category-exams/"+xmId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    // if ( data.exam.banner != null)
                    // {
                    //     $('#xmImage').attr('src', data.exam.banner);
                    // } else {
                    //     $('#xmImage').attr('src','/frontend/logo/biddabari-card-logo.jpg');
                    // }
                    // $('#catName').text(data.exam.title);
                    $('#price').text(data.exam.price);
                    // $('#description').html(data.exam.description);

                    $('#xmCardForm').attr('action', base_url+'student/order-exam/'+xmId);

                    var div = '';
                    div += '<h3 class="text-center">Available Packages for this Exam</h3>\n' +
                        '                                                    <div class="row">\n';
                    $.each(data.exam.batch_exam_subscriptions, function (key, val) {
                        div += '<div class="col-md-4 mt-3">\n' +
                            '<div class="card card-body">\n' +
                            '<img src="/frontend/logo/biddabari-card-logo.jpg" alt="" class="card-img-top" style="height: 150px">\n'+
                            '       <h3 class="f-s-30">'+val.package_title+'</h3>\n' +
                            '       <p class="f-s-20 p-0 m-0">RegularPrice: <span class="f-s-24">'+val.price+'</span> Tk</p>\n' +
                            '       <p class="f-s-20 p-0 m-0">Duration: <span class="f-s-24">'+val.package_duration_in_days+'</span> Days</p>\n';
                        if(val.discount_amount > 0 && val.discount_amount != null)
                        {
                            div += '       <p class="f-s-20 p-0 m-0">Discount: <span class="f-s-24">'+val.discount_amount+'</span> Tk</p>\n' +
                                '       <p class="f-s-20 p-0 m-0">Current Price: <span class="f-s-24">'+(val.price - val.discount_amount)+'</span> Tk</p>\n' +
                                '       <p class="f-s-20 p-0 m-0">Valid Till: '+val.discount_end_date.split(" ")[0]+'</p>\n' ;
                        }

                        div += '<div class="bottom-content">'+
                            '<a href="checkout/batch_exam/'+data.exam.title.replaceAll(" ", "-")+'?si='+val.id+'" class="btn btn-warning" style="float: right;">বিস্তারিত দেখুন</a>'+
                        '</div>'+
                        '   </div>\n'+    
                            '   </div>\n';
                    })
                    div += '                                                    </div>';
                    $('#xmPackages').empty().append(div);
                    var label = '';
                    $.each(data.exam.batch_exam_subscriptions, function (index, value) {
                        if (index == 0)
                        {
                            label += '<label for="pak'+index+'" class=""><input type="radio" class="select-package" checked name="batch_exam_subscription_id" data-package-sell-price="'+(value.price - value.discount_amount)+'" value="'+value.id+'" id="pak'+index+'"> <span class="f-s-23"> &nbsp;'+value.package_title+' ('+(value.price - value.discount_amount)+'tk for '+value.package_duration_in_days+' days)</span></label><br/>';
                            $('#totalAmount').val(value.price - value.discount_amount);
                        } else {

                            label += '<label for="pak'+index+'" class=""><input type="radio" class="select-package" name="batch_exam_subscription_id" data-package-sell-price="'+(value.price - value.discount_amount)+'" value="'+value.id+'" id="pak'+index+'"> <span class="f-s-23"> &nbsp;'+value.package_title+' ('+(value.price - value.discount_amount)+'tk for '+value.package_duration_in_days+' days)</span></label><br/>';
                        }
                    });
                    $('#selectPackages').empty().append(label);

                    if (data.enrollStatus == 'true' || data.enrollStatus == 'pending')
                    {
                        if (!$('#checkEnroll').hasClass('d-none'))
                        {
                            $('#checkEnroll').addClass('d-none');
                            $('.msgPrint').html('<p class="fw-bolder f-s-22">You already enrolled this Exam.</p>');
                        }
                    } else {
                        if ($('#checkEnroll').hasClass('d-none'))
                        {
                            $('#checkEnroll').removeClass('d-none');
                            $('#msgPrint').empty();
                        }
                    }
                    $('#staticBackdrop').modal('show');
                }
            })
        }
        $(document).on('click', '.select-package', function () {
            var sellPrice = $(this).attr('data-package-sell-price');
            $('#totalAmount').val(sellPrice);
        })
    </script>
    <script>
        $(function () {
            showHidePaymentMethod();
        })
        $(document).on('click', 'input[name="payment_method"]', function () {
            showHidePaymentMethod();
        });
        function showHidePaymentMethod() {
            var paymentMethod = $('input[name="payment_method"]:checked').val();
            if (paymentMethod == 'cod')
            {
                if ($('.payment-cod').hasClass('d-none'))
                {
                    $('.payment-cod').removeClass('d-none');
                }

            } else if (paymentMethod == 'ssl')
            {
                $('.payment-cod').addClass('d-none');
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var mainText = $('#mainText');
            var additionalText = $('#additionalText');
            var seeMoreButton = $('#seeMore');
            var seeLessButton = $('#seeLess');

            // Show additional text when "See More" is clicked
            seeMoreButton.on('click', function() {
                additionalText.show();
                seeMoreButton.hide();
                seeLessButton.show();
            });

            // Hide additional text when "See Less" is clicked
            seeLessButton.on('click', function() {
                additionalText.hide();
                seeMoreButton.show();
                seeLessButton.hide();
            });
        });
    </script>
@endsection
