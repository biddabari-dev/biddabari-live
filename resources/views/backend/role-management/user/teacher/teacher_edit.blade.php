@extends('backend.master')

@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="profile-img-main rounded">
                                    <img src="{{ !empty($teacher->image) ? asset($teacher->image) : 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png' }}"
                                        alt="img" class="m-0 p-1 rounded hrem-6" style="height: 90px; width: 90px;" />
                                </div>
                                <div class="ms-4">
                                    <h4>{{ !empty($teacher) ? $teacher->first_name . ' ' . $teacher->last_name : $teacher->user->name }}
                                    </h4>
                                    <p class="text-muted mb-2">Member Since:
                                        {{ \Illuminate\Support\Carbon::parse($teacher->user->created_at)->format('F Y') }}
                                    </p>
                                    <a href="mailto:{{ $teacher->user->email }}" class="btn btn-secondary btn-sm"><i
                                            class="fa fa-envelope"></i> E-mail</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li><a href="#editProfile" class="active show" data-bs-toggle="tab">Edit Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="profileMain">
                    <div class="card">
                        <div class="card-body border-0 video-gallery">  
                            <form class="form-horizontal" action="{{ route('teachers_profile.update', $teacher->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="user_id"
                                    value="{{ !empty($teacher) ? $teacher->user->id : '' }}" />
                                <div class="row mb-4">
                                    <p class="mb-4 text-17">Personal Info</p>
                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label">User Name</label>
                                            <input type="text" class="form-control" id="username" name="name"
                                                value="{{ $teacher->user->name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="first_name"
                                                placeholder="First Name"
                                                value="{{ !empty($teacher) ? $teacher->first_name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="lastname" class="form-label">last Name</label>
                                            <input type="text" class="form-control" id="lastname"
                                                placeholder="Last Name" name="last_name"
                                                value="{{ !empty($teacher) ? $teacher->last_name : '' }}">
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="designation" class="form-label">Designation</label>
                                            <input type="text" class="form-control" id="designation"
                                                placeholder="Designation" readonly value="{{ $teacher->subject }}" />
                                        </div>
                                    </div> --}}

                                      <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="subject" class="form-label">Designation</label>
                                            {{-- <input type="text" class="form-control" id="subject" name="subject"
                                                placeholder="Designation"
                                                value="{{ !empty($teacher) ? $teacher->subject : '' }}"> --}}
                                                    <textarea class="form-control" id="subject" rows="2" name="subject" placeholder="Designation">{!! !empty($teacher->subject) ? $teacher->subject : '' !!}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <p class="mb-4 text-17">Contact Info</p>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Email" value="{{ $teacher->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="website" class="form-label">Website</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="website"
                                                placeholder="Website" name="website"
                                                value="{{ !empty($teacher) ? $teacher->website : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Phone</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="phoneNumber"
                                                placeholder="phone number" readonly name="mobile"
                                                value="{{ !empty($teacher) ? $teacher->mobile : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Image</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="image"
                                                accept="image/*" />

                                                <div class="col-md-6 mt-2">
                                                    @if(isset($teacher))
                                                        <div>
                                                            <img src="{{ asset($teacher->image) }}" id="courseImagePreview" style="height: 60px; width: 70px" />
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Teacher Intro Video</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="teacher_intro_video"
                                                value="{{ !empty($teacher) ? $teacher->teacher_intro_video : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Teacher Intro Video</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="teacher_intro_video"  placeholder="Teacher Intro Video Youtube Link "
                                                value="{{ !empty($teacher) ? $teacher->teacher_intro_video : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Teacher Intro Banner</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="teacher_intro_banner"
                                                accept="image/*" />

                                                <div class="col-md-6 mt-2">
                                                    @if(isset($teacher))
                                                        <div>
                                                            <img src="{{ asset($teacher->teacher_intro_banner) }}" id="courseImagePreview" style="height: 60px; width: 70px" />
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="address" class="form-label">Present Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="address" rows="2" name="present_address" placeholder="Address">{!! !empty($teacher) ? $teacher->present_address : '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <p class="mb-4 text-17">Teacher Demo Videos</p>

                                {{-- <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Demo Video 1</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="demo_video_1"
                                                value="{{ !empty($teacher) ? $teacher->demo_video_1 : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Short Classes Video 1</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="demo_video_1" placeholder="Teacher Short Classess Video 1 Youtube Link"
                                                value="{{ !empty($teacher) ? $teacher->demo_video_1 : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Short Classes Banner 1</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="demo_banner_1"
                                                accept="image/*" />

                                                <div class="col-md-6 mt-2">
                                                    @if(isset($teacher))
                                                        <div>
                                                            <img src="{{ asset($teacher->demo_banner_1) }}" id="courseImagePreview" style="height: 60px; width: 70px" />
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>

                               

                                {{-- <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Demo Video 2</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="demo_video_2"
                                                value="{{ !empty($teacher) ? $teacher->demo_video_2 : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Short Classes Video 2</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="demo_video_2" placeholder="Teacher Short Classess Video 2 Youtube Link"
                                                value="{{ !empty($teacher) ? $teacher->demo_video_2 : '' }}"
                                                accept="video/*" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="phoneNumber" class="form-label">Short Classes Banner 2</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="demo_banner_2"
                                                accept="image/*" />

                                                <div class="col-md-6 mt-2">
                                                    @if(isset($teacher))
                                                        <div>
                                                            <img src="{{ asset($teacher->demo_banner_2) }}" id="courseImagePreview" style="height: 60px; width: 70px" />
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>

                               
                                <p class="mb-4 text-17">Social Info</p>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="twitter" class="form-label">Twitter</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="twitter"
                                                placeholder="twitter" name="twitter"
                                                value="{{ !empty($teacher) ? $teacher->twitter : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="facebook"
                                                placeholder="facebook" name="facebook"
                                                value="{{ !empty($teacher) ? $teacher->facebook : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="linkedin"
                                                placeholder="linkedin" name="linkedin"
                                                value="{{ !empty($teacher) ? $teacher->linkedin : '' }}">
                                        </div>
                                    </div>
                                </div>
                              
                                <p class="mb-4 text-17 ">About Yourself</p>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="github" class="form-label">Teacher Introduction</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="biographicalInfo" rows="4" name="github"
                                                placeholder="Teacher introduction">{!! !empty($teacher) ? $teacher->github : '' !!}</textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label for="biographicalInfo" class="form-label">Biographical Info</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="biographicalInfo" rows="4" name="description" placeholder="">{!! !empty($teacher) ? $teacher->description : '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        @can('teacher-profile-update')
                                            <div class="col-md-3 mx-auto">
                                                <input type="submit" class="btn btn-success" value="Update">
                                            </div>
                                        @endcan
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
