@extends('frontend.master')

@section('body')
    {{ \Illuminate\Support\Facades\Session::put('course_redirect_url', \Illuminate\Support\Facades\Request::url()) }}

    <div class="terms-conditions-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h1>Terms and Conditions</h1>
                <hr class="w-25 mx-auto bg-danger" />
            </div>
            <div class="row p-t-20">
                <div class="col-lg-12">
                    <div class="card ab-shadow">
                        <div class="single-content py-3 px-3 ">
                            <p class="f-s-16">Last Updated: 31 July, 2024</p>
                            <h2>Welcome to Biddabari</h2>
                            <p>These terms and conditions outline the rules and regulations for the use of Biddabari's
                                Website and Services, located at biddabari.com </p>
                            <p>By accessing this website and/or purchasing our courses, we assume you accept these terms and
                                conditions. Do not continue to use Biddabari if you do not agree to all the terms and
                                conditions stated on this page.</p>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>Introduction</h2>
                            <p>These Terms and Conditions constitute a legally binding agreement made between you, whether
                                personally or on behalf of an entity (“you”) and Biddabari (“we,” “us” or “our”), concerning
                                your access to and use of the biddabari.com website as well as any other media form, media
                                channel, mobile website, or mobile application related, linked, or otherwise connected
                                thereto (collectively, the “Site”).</p>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>Intellectual Property Rights</h2>
                            <p>Unless otherwise stated, Biddabari and/or its licensors own the intellectual property rights
                                for all material on Biddabari. All intellectual property rights are reserved. You may access
                                this from Biddabari for your own personal use subjected to restrictions set in these terms
                                and conditions.</p>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>User Representations</h2>
                            <p>By using the Site, you represent and warrant that:</p>
                            <ul>
                                <li class="color_black">All registration information you submit will be true, accurate,
                                    current, and complete.</li>
                                <li class="color_black">You will maintain the accuracy of such information and promptly
                                    update such registration information as necessary.</li>
                                <li class="color_black">You have the legal capacity and you agree to comply with these Terms
                                    and Conditions.</li>
                            </ul>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>User Registration</h2>
                            <p>You may be required to register with the Site. You agree to keep your password confidential
                                and will be responsible for all use of your account and password. We reserve the right to
                                remove, reclaim, or change a username you select if we determine, in our sole discretion,
                                that such username is inappropriate, obscene, or otherwise objectionable.</p>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>Courses and Payments</h2>
                            <ul>
                                <li class="color_black">Biddabari offers various online courses, which are available for
                                    purchase through the Site.</li>
                                <li class="color_black">All prices are listed on the Site and are subject to change at any
                                    time without notice.</li>
                                <li class="color_black">Payment for courses must be made in full before access to the course
                                    is granted.We accept Digital payment.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Refund Policy</h2>
                            <p>We offer a 2 days money-back guarantee on our courses, starting from the date of purchase. If
                                you are not satisfied with the course, you may request a refund by contacting our support
                                team at <a href="https://biddabari.com/contact-us"> Contact Us </a> .</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>User Content</h2>
                            <ul>
                                <li class="color_black">Certain areas of the Site may allow users to post comments,
                                    feedback, or other content ("User Content").</li>
                                <li class="color_black">You retain ownership of any intellectual property rights that you
                                    hold in that User Content.</li>
                                <li class="color_black">By posting User Content to the Site, you grant Biddabari a
                                    non-exclusive, royalty-free, worldwide, perpetual license to use, reproduce, modify,
                                    adapt, publish, translate, create derivative works from, distribute, and display such
                                    content.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Prohibited Activities</h2>
                            <p>You may not access or use the Site for any purpose other than that for which we make the Site
                                available. The Site may not be used in connection with any commercial endeavors except those
                                that are specifically endorsed or approved by us.</p>
                            <h3 class="fw-bold">Prohibited activities include, but are not limited to:</h3>
                            <ul>
                                <li class="color_black">Systematically retrieving data or other content from the Site to
                                    create or compile, directly or indirectly, a collection, compilation, database, or
                                    directory without written permission from us.</li>
                                <li class="color_black">Making any unauthorized use of the Site, including collecting
                                    usernames and/or email addresses of users by electronic or other means for the purpose
                                    of sending unsolicited email, or creating user accounts by automated means or under
                                    false pretenses.</li>
                                <li class="color_black">Engaging in unauthorized framing of or linking to the Site.</li>
                                <li class="color_black">Tricking, defrauding, or misleading us and other users, especially
                                    in any attempt to learn sensitive account information such as user passwords.</li>
                            </ul>
                        </div>

                        <div class="single-content py-3 px-3 ">
                            <h2>Termination</h2>
                            <p>We may terminate or suspend your access to the Site without prior notice or liability, for
                                any reason whatsoever, including without limitation if you breach the Terms. Upon
                                termination, your right to use the Site will immediately cease.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Limitation of Liability</h2>
                            <p>In no event shall Biddabari nor its directors, employees, partners, agents, suppliers, or
                                affiliates, be liable for any indirect, incidental, special, consequential, or punitive
                                damages, including without limitation, loss of profits, data, use, goodwill, or other
                                intangible losses, resulting from:</p>
                            <ul>
                                <li class="color_black">● Your use or inability to use the Site;</li>
                                <li class="color_black">● Any unauthorized access to or use of our servers and/or any
                                    personal information stored therein;</li>
                                <li class="color_black">● Any interruption or cessation of transmission to or from the Site.
                                </li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Governing Law</h2>
                            <p>These Terms shall be governed and construed in accordance with the laws of Bangladesh,
                                without regard to its conflict of law provisions.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Contact Us</h2>
                            <p>If you have any questions about these Terms, please contact us at <a
                                    href="https://biddabari.com/contact-us"> Contact Us </a></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row p-t-20">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h1>Refund Policy</h1>
                        <hr class="w-25 mx-auto bg-danger" />
                    </div>
                    <div class="card ab-shadow">
                        <div class="single-content py-3 px-3 ">
                            <p class="f-s-16">Last Updated: 1st August, 2024</p>
                            <h2>Introduction</h2>
                            <p>At <span class="fw-bold">Biddabari</span>, we strive to provide our students with
                                high-quality educational content. We understand that there may be circumstances where a
                                refund is necessary. This Refund Policy outlines the terms and conditions under which
                                refunds for our paid courses are processed. </p>
                            <p>By accessing this website and/or purchasing our courses, we assume you accept these terms and
                                conditions. Do not continue to use Biddabari if you do not agree to all the terms and
                                conditions stated on this page.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Eligibility for Refunds</h2>
                            <p>Students who purchase our paid courses are eligible to apply for a refund under the following
                                conditions: </p>
                            <ul>
                                <li class="color_black">The refund request must be made within 48 hours of purchasing the
                                    course.</li>
                                <li class="color_black">A written request for the refund must be sent to our official email
                                    address at <span class="fw-bold"><a href="mailto:info@biddabari.com">info@biddabari.com.</a></span></li>
                                <li class="color_black">The request must include a valid reason for seeking the refund.</li>
                            </ul>
                        </div>
                     
                        <div class="single-content py-3 px-3 ">
                            <h2>Valid Reasons for Refund</h2>
                            <p>Refund requests will be considered valid for reasons such as: </p>
                            <ul>
                                <li class="color_black">Technical issues that prevent access to the course content.</li>
                                <li class="color_black">Course content not being as described or advertised</li>
                                <li class="color_black">Other legitimate reasons as determined by our support team.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>How to Request a Refund</h2>
                            <p>To request a refund, please follow these steps:</p>
                            <ul>
                                <li class="color_black">Send an email to <span class="fw-bold"><a href="mailto:info@biddabari.com">info@biddabari.com.</a></span>
                                    within 48 hours of your purchase.</li>
                                <li class="color_black">Include your full name, Registration Number used for the purchase
                                    and the course name</li>
                                <li class="color_black">Provide a detailed explanation of the reason for the refund request.
                                </li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Processing Refunds</h2>
                            <ul>
                                <li class="color_black">Once we receive your refund request, our support team will review it
                                    and determine if it meets our refund criteria.</li>
                                <li class="color_black">If your request is approved, we will process the refund to the
                                    original method of payment within 7 business days</li>
                                <li class="color_black">You will receive an email confirmation once the refund has been
                                    processed.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Non-Refundable Items</h2>
                            <ul>
                                <li class="color_black">The following items are not eligible for refunds:</li>
                                <li class="color_black">Courses that have been accessed or substantially used</li>
                                <li class="color_black">Courses purchased more than 48 hours ago.</li>
                                <li class="color_black">Any additional fees or services associated with the course.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Changes to This Refund Policy</h2>
                            <p>We reserve the right to modify this Refund Policy at any time. Any changes will be posted on
                                this page with an updated effective date. We encourage you to review this policy
                                periodically to stay informed about our refund practices.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Contact Us</h2>
                            <p>If you have any questions or concerns about this Refund Policy, please contact us at:</p>
                            <h4>Biddabari</h4>
                            <p>Email: <span class="fw-bold"><a href="mailto:info@biddabari.com">info@biddabari.com.</a></span></p>
                            <p>Phone: <a href="tel:+8801896060800">+8801896060800</a></p>
                            <p>Address: 6th Floor, Jashore Malik Shamiti Vobon, Gausul Azam Super-Market, Nilkhet,
                                Dhaka-1205</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
