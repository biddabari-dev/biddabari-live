@extends('frontend.master')
@section('robots', 'noindex')
@section('body')
<div class="courses-area-two section-bg p-t-50" style="">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="billing-sildbar pl-20  rounded-0">
                    <div class="billing-totals">
                        <h3 class="text-center py-3">Checkout Summary</h3>
                        <ul>
                            <li>
                                Product Name :

                                <span>{{ $cartContents->title }}</span>

                            </li>
                            <li>
                                Product Price
                                @if ($cartContents->discount_amount != null )
                                <span>BDT {{ $cartContents->price - $cartContents->discount_amount }}</span>
                                @else
                                <span>BDT {{ $cartContents->price }}</span>
                                @endif:
                            </li>
                            <li id="couponLi" class="d-none">Coupon <span>BDT <b id="couponAmount"></b></span></li>

                            <form action="{{ route('front.common-order', ['model_id' => $cartContents->id]) }}"
                                  method="post" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden" name="model_id" value="{{ $cartContents->id }}">
                                <input type="hidden" name="course_id" value="{{ $cartContents->id }}">
                                <input type="hidden" name="total_amount" value="{{ $cartContents->price - $cartContents->discount_amount }}">
                                <input type="hidden" name="used_coupon" value="0">
                                <input type="hidden" name="coupon_code" value="">
                                <input type="hidden" name="coupon_amount" value="">
                                <input type="hidden" name="ordered_for" value="product">
                                <input type="hidden" name="rc" value="{{ $_GET['rc'] ?? '' }}">

                                <li>
                                    <div class="row checkout_log">
                                        <div class="col-md-12 ">
                                            <label for="paidTo">Your Name</label>
                                            <input type="text" id="paidTo" onkeydown="return /[a-zA-Z ]/i.test(event.key)" required name="name" class="form-control"
                                                   placeholder="Enter your name" value="{{ auth()->check() ? auth()->user()->name : '' }}" {{--{{ auth()->check() && !empty(auth()->user()->name) ? 'readonly' : '' }}--}}  />
                                            @if(!auth()->check()) <span class="text-danger f-s-18 float-start">আপনার এই নামে বইটির অর্ডার গ্রহণ হবে।</span> @endif
                                            @error('paid_to')<span class="text-danger"></span>@enderror
                                        </div>
                                        <div class="col-md-12 ">
                                            <label for="paidTo">Full Address</label>
                                            <textarea type="text" required name="shipping_address" class="form-control" cols="30" rows="1"
                                                   placeholder="জেলা,থানা ও সম্পূর্ণ ঠিকানা দিন। গ্রাম/শহর, বাসা নং (পাশে কোন বাজার থাকলে নাম লিখুন)"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" >Phone No</label>
                                            <input type="text" pattern="^01[3-9]\d{8}$" title="Please enter a valid phone number"  onkeypress="return isNumberKey(event)" id="phone" name="mobile" required class="form-control"
                                                   placeholder="Enter your phone no" value="{{ auth()->check() ? auth()->user()->mobile : '' }}" {{--{{ auth()->check() && !empty(auth()->user()->mobile) ? 'readonly' : '' }}--}} />
                                            @if(!auth()->check()) <span class="text-danger f-s-18 float-start">আপনার সক্রিয় মোবাইল নম্বর লিখুন</span> @endif
                                            @error('mobile')<span class="text-danger"></span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirmPhone" >Confirm Phone No</label>
                                            <input type="text" format="" onkeypress="return isNumberKey(event)" id="confirmPhone" name="confirm_mobile" required class="form-control"
                                                   placeholder="Enter your phone no" value="{{ auth()->check() ? auth()->user()->mobile : '' }}" {{--{{ auth()->check() && !empty(auth()->user()->mobile) ? 'readonly' : '' }}--}} />
                                                   @if(Session::has('error'))
                                                   <span class="text-danger f-s-18 float-start">{{ Session::get('error') }}</span>
                                                    @endif
                                        </div>
                                    </div>
                                </li>


                                <li>
                                    <div class="row">
                                        <div class="col-md-6 checkout_contact">
                                            <div class="contact-info-card">
                                                <i class="ri-whatsapp-line"></i>
                                                <h5>প্রয়োজনে WhatsApp করুন।</h5>
                                                <p><a href="https://wa.me/8801896060860">+8801896060860</a></p>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6 checkout_contact">
                                            <div class="contact-info-card">
                                                <i class="ri-phone-fill"></i>
                                                <h5>প্রয়োজনে এজেন্ট এর সাথে কথা বলুন</h5>
                                                <p><a href="tel:+8801896060800">+8801896060860-65</a></p>
                                            </div>
                                        </div> -->
                                    </div>
                                </li>
                                <li>
                                    <div class="bkash_payment d-flex justify-content-between">

                                        <div class="d-flex">
                                            <input type="radio" id="direct-bank-transfer" class="me-2" value="bkash"
                                                   name="payment_method" checked>
                                            <label for="direct-bank-transfer">বিকাশ পেমেন্ট মেথড</label>
                                        </div>
                                        <div class="pay_method_icon ">
                                            <img src="{{asset('frontend')}}/assets/images/bkash_logo.webp" style="height: 45px; width: 120px">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="others_payment d-flex justify-content-between">
                                        <div class="d-flex">
                                            <input type="radio" id="paypal" name="payment_method" class="me-2" value="ssl"  />
                                            <label for="paypal">অন্যান্য পেমেন্ট মেথড</label>
                                        </div>
                                        <div class="pay_method_icon text-align-end">
                                            <img src="{{asset('frontend')}}/assets/images/others_logo.jpg" style="height: 45px; width: 120px">
                                        </div>
                                    </div>
                                </li>

                                <button type="submit" class="default-btn w-100 bg-danger">পেমেন্ট করুন</button>
                            </form>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('js')
<script>
    $(document).on('click', '#checkBtn', function () {
        var couponCode = $('#couponCode').val();
        var courseId = $('input[name="course_id"]').val();
        var currentTotal = $('input[name="total_amount"]').val();
        $.ajax({
            url: "{{ route('front.check-coupon') }}",
            method: "GET",
            data: { coupon_code: couponCode, course_id: courseId, current_total: currentTotal },
            success: function (data) {
                console.log(data);
                if (data.status == 'true') {
                    toastr.success(data.message);
                    // $('input[name="total_amount"]').val(data.currentTotal);
                    // $('input[name="used_coupon"]').val(1);
                    $('input[name="coupon_code"]').val(couponCode);
                    $('input[name="coupon_amount"]').val(data.coupon.discount_amount);
                    $('#finalPrice').text(data.currentTotal);
                    $('#couponAmount').text(data.coupon.discount_amount);
                    $('#couponLi').removeClass('d-none');
                } else if (data.status == 'false') {
                    toastr.error(data.message);
                }
            }
        })
    })
</script>
<script>

</script>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
        }
</script>


<script>
    window.onload = () => {
        const myInput = document.getElementById('confirmPhone');
        myInput.onpaste = e => e.preventDefault();
    }
</script>
@endsection
