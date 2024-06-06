<div>
    {{-- Stop trying to control. --}}
    <div class="courses-area-two section-bg" style="">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="billing-sildbar pl-20  rounded-0">
                        <div class="billing-totals">
                            <h3 class="text-center py-3">Checkout Summary</h3>
                            <ul>
                                <li>Course Name : <span>{{ $course->title }}</span></li>
                                <li>Course Price <span>BDT {{ $reqFor == 'course' ? ($course->price ?? 0) : 0 }}</span>
                                </li>
                                <li id="couponLi" class="d-none">Coupon <span>BDT <b id="couponAmount"></b></span></li>

                                <form action="{{ route('front.common-order', ['model_id' => $course->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="model_id" value="{{ $course->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="total_amount"
                                        value="{{ $course->total_amount_after_discount ?? $course->price }}">
                                    <input type="hidden" name="used_coupon" value="0">
                                    <input type="hidden" name="coupon_code" value="">
                                    <input type="hidden" name="coupon_amount" value="">
                                    <input type="hidden" name="ordered_for" value="{{ $reqFor ?? 'course' }}">
                                    <input type="hidden" name="rc" value="{{ $_GET['rc'] ?? '' }}">

                                    <li>
                                        <div class="row checkout_log">
                                            <div class="col-md-12 py-2">
                                                <label for="paidTo">Student Name</label>
                                                <input type="text" id="paidTo" name="name" class="form-control"
                                                    placeholder="Enter your name" />
                                                @error('paid_to')<span class="text-danger"></span>@enderror
                                            </div>
                                            <div class="col-md-6 py-2">
                                                <label for="phone">Phone No</label>
                                                <input type="number" id="phone" name="mobile" class="form-control"
                                                    placeholder="Enter your phone no" />
                                                @error('mobile')<span class="text-danger"></span>@enderror
                                            </div>
                                            <div class="col-md-6 py-2">
                                                <label for="confirmPhone">Confirm Phone No</label>
                                                <input type="number" id="confirmPhone" name="confirm_mobile"
                                                    class="form-control" placeholder="Enter your phone no" />
                                                @error('confirm_mobile')<span class="text-danger"></span>@enderror
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-md-6 checkout_coupon">
                                                <label for="couponCode">Coupon Code</label>

                                                <div class="input-group">
                                                    <input type="text" placeholder="Coupon Code" id="couponCode"
                                                        class="form-control" />
                                                    <label for="couponCode" class="input-group-text" id="checkBtn"
                                                        style="cursor: pointer">Apply</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 checkout_contact">
                                                <div class="contact-info-card">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <h5>এজেন্ট এর সাথে কথা বলুন</h5>
                                                    <p><a href="tel:+8801896060800">+8801896060800</a></p>
                                                </div>
                                            </div>
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
                                                <img src="{{asset('frontend')}}/assets/images/bkash_logo.webp">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="others_payment d-flex justify-content-between">
                                            <div class="d-flex">
                                                <input type="radio" id="paypal" name="payment_method" class="me-2"
                                                    value="ssl">
                                                <label for="paypal">অন্যান্য পেমেন্ট মেথড</label>
                                            </div>
                                            <div class="pay_method_icon text-align-end">
                                                <img src="{{asset('frontend')}}/assets/images/others_logo.jpg">
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <button type="submit" class="default-btn">পেমেন্ট করুন</button>
                                </form>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>