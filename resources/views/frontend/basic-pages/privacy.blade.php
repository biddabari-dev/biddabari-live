@extends('frontend.master')

@section('body')
    {{ \Illuminate\Support\Facades\Session::put('course_redirect_url', \Illuminate\Support\Facades\Request::url()) }}
    <div class="privacy-policy-area py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1> Privacy Policy </h1>
                <hr class="w-25 mx-auto bg-danger" />
            </div>
            <div class="row p-t-20">
                <div class="col-lg-12">

                    <div class="card ab-shadow">
                        <div class="single-content py-3 px-3 ">
                            {{-- <h1>Privacy Policy</h1> --}}
                            <p class="f-s-16">Last Updated: May 29, 2024</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Introduction</h2>
                            <p>Welcome to Biddabari. We are committed to protecting your personal information and your right
                                to privacy. If you have any questions or concerns about this privacy policy or our practices
                                with regards to your personal information, please <a
                                    href="https://biddabari.com/contact-us">Contact us</a>.</p>

                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Information We Collect</h2>
                            <p><span class="fw-bold">Personal Information:</span> When you visit our website, register,
                                place an order, or interact with us in other ways, we may collect the following personal
                                information from you:</p>
                            <ul>
                                <li class="color_black">Name </li>
                                <li class="color_black">Email address</li>
                                <li class="color_black">Phone number</li>
                                <li class="color_black">Location</li>
                            </ul>
                            <p><span class="fw-bold">Usage Data:</span> We also collect information automatically when you
                                navigate through our site. This may include:</p>
                            <ul>
                                <li class="color_black">IP address </li>
                                <li class="color_black">Browser type and version</li>
                                <li class="color_black">Operating system and platform</li>
                                <li class="color_black">Access times and dates</li>
                            </ul>
                            <p>Cookies and Tracking Technologies: We may use cookies and similar tracking technologies to
                                track the activity on our service and hold certain information. You can instruct your
                                browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do
                                not accept cookies, you may not be able to use some portions of our service.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>How We Collect Information</h2>
                            <p>We collect information from you in various ways, including:</p>
                            <ul>
                                <li class="color_black"><span class="fw-bold"> interactions:</span> When you provide
                                    information by filling in forms on our website.</li>
                                <li class="color_black"><span class="fw-bold"> Automated technologies:</span> When you
                                    navigate through our website, we use automatic data collection technologies to collect
                                    certain information about your equipment, browsing actions, and patterns.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>How We Use Your Information</h2>
                            <p>We use the information we collect for various purposes, including to:</p>
                            <ul>
                                <li class="color_black">Provide, operate, and maintain our website</li>
                                <li class="color_black">Improve, personalize, and expand our website</li>
                                <li class="color_black">Understand and analyze how you use our website</li>
                                <li class="color_black">Develop new products, services, features, and functionality</li>
                                <li class="color_black">Communicate with you, either directly or through one of our
                                    partners, including for customer service, to provide you with updates and other
                                    information relating to the website, and for marketing and promotional purposes</li>
                                <li class="color_black">Process your transactions and manage your orders</li>
                                <li class="color_black">Send you emails</li>
                                <li class="color_black">Find and prevent fraud</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>How We Share Your Information</h2>
                            <p>We do not sell, trade, or otherwise transfer your personal information to outside parties
                                except as described below:</p>
                            <ul>
                                <li class="color_black"><span class="fw-bold">Service Providers:</span> We may share your
                                    information with third-party vendors, service providers, contractors, or agents who
                                    perform services for us or on our behalf and require access to such information to do
                                    that work.</li>
                                <li class="color_black"><span class="fw-bold">Business Transfers:</span> We may share or
                                    transfer your information in connection with, or during negotiations of, any merger,
                                    sale of company assets, financing, or acquisition of all or a portion of our business to
                                    another company.</li>
                                <li class="color_black"><span class="fw-bold">Legal Obligations:</span> We may disclose your
                                    information where we are legally required to do so in order to comply with applicable
                                    law, governmental requests, a judicial proceeding, court order, or legal process.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Data Storage and Security</h2>
                            <p>We store your data on secure servers and implement appropriate technical and organizational
                                measures to ensure a level of security appropriate to the risk. However, no electronic
                                transmission over the Internet or information storage technology can be guaranteed to be
                                100% secure, and we cannot guarantee its absolute security.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Your Rights</h2>
                            <p>Depending on your location, you may have the following rights regarding your personal
                                information:</p>
                            <ul>
                                <li class="color_black"><span class="fw-bold">Access:</span> You have the right to request a
                                    copy of the personal data we hold about you.</li>
                                <li class="color_black"><span class="fw-bold">Correction:</span> You have the right to
                                    request that we correct any personal data that you believe is inaccurate or complete
                                    information you believe is incomplete.</li>
                                <li class="color_black"><span class="fw-bold">Deletion:</span> You have the right to request
                                    that we erase your personal data, under certain conditions.</li>
                                <li class="color_black"><span class="fw-bold">Objection:</span> You have the right to object
                                    to our processing of your personal data, under certain conditions.</li>
                                <li class="color_black"><span class="fw-bold">Restriction:</span> You have the right to
                                    request that we restrict the processing of your personal data, under certain conditions.
                                </li>
                                <li class="color_black"><span class="fw-bold">Portability:</span> You have the right to
                                    request that we transfer the data that we have collected to another organization, or
                                    directly to you, under certain conditions.</li>
                            </ul>
                            <p>To exercise any of these rights, please contact us.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Cookies Policy</h2>
                            <p>We use cookies to enhance your experience on our website. Cookies are files with small
                                amounts of data that are commonly used as anonymous unique identifiers. You can control your
                                cookie settings via your browser settings.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Third-Party Services</h2>
                            <p>We may use third-party service providers to moni tor and analyze the use of our service.
                                These third parties have access to your personal data only to perform these tasks on our
                                behalf and are obligated not to disclose or use it for any other purpose.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Changes to This Privacy Policy</h2>
                            <p>We may update our privacy policy from time to time. We will notify you of any changes by
                                posting the new privacy policy on this page. You are advised to review this privacy policy
                                periodically for any changes. Changes to this privacy policy are effective when they are
                                posted on this page.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Children’s Privacy</h2>
                            <p>Our educational services are designed to be accessible to learners of all ages, including
                                children under the age of 13. Protecting the privacy of young children is especially
                                important to us:</p>
                            <ul>
                                <li class="color_black"><span class="fw-bold">Parental Consent:</span> We require verifiable
                                    parental consent before collecting any personal information from children under 13.
                                    Parents or guardians must provide their consent by registering on behalf of the child or
                                    through other consent mechanisms we have in place.</li>
                                <li class="color_black"><span class="fw-bold">Data Collection:</span> We only collect the
                                    minimum amount of personal information necessary to provide our educational services.
                                    This may include information such as the child's name, age, and email address (or that
                                    of their parent or guardian).</li>
                                <li class="color_black"><span class="fw-bold">Use of Information:</span> The information
                                    collected from children under 13 is used solely for educational purposes, to provide a
                                    personalized learning experience, and to communicate with parents or guardians.</li>
                                <li class="color_black"><span class="fw-bold">Disclosure of Information:</span> We do not
                                    share personal information of children under 13 with third parties without parental
                                    consent, except as necessary to provide our services or as required by law.</li>
                                <li class="color_black"><span class="fw-bold">Parental Rights:</span> Parents and guardians
                                    have the right to review their child's personal information, request that we delete it,
                                    and refuse to allow any further collection or use of their child's information. To
                                    exercise these rights, please contact us.</li>
                                <li class="color_black"><span class="fw-bold">Removal of Information:</span> If we become
                                    aware that we have inadvertently collected personal information from a child under 13
                                    without proper consent, we will take steps to delete that information promptly from our
                                    servers.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>International Data Transfers</h2>
                            <p>Your information, including personal data, may be transferred to — and maintained on —
                                computers located outside of your state, province, country, or other governmental
                                jurisdiction where the data protection laws may differ from those of your jurisdiction.</p>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Legal Basis for Processing Data (For GDPR Compliance)</h2>
                            <p>If you are from the European Economic Area (EEA), our legal basis for collecting and using
                                personal information described in this privacy policy depends on the personal data we
                                collect and the specific context in which we collect it. We may process your personal data
                                because:</p>
                            <ul>
                                <li class="color_black">We need to perform a contract with you.</li>
                                <li class="color_black">You have given us permission to do so.</li>
                                <li class="color_black">The processing is in our legitimate interests and it's not
                                    overridden by your rights.</li>
                                <li class="color_black">To comply with the law.</li>
                            </ul>
                        </div>
                        <div class="single-content py-3 px-3 ">
                            <h2>Contact Us</h2>
                            <p>If you have any questions about this privacy policy, please contact us by visiting this page
                                on our website: <a href="https://biddabari.com/contact-us">Contact us</a>.</p>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
