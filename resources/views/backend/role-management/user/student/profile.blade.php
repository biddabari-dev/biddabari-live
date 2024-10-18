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
                                    <img src="{{ !empty($student->image) ? asset($student->image) : 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png' }}"
                                        alt="img" class="m-0 p-1 rounded hrem-6" style="height: 90px; width: 90px;" />
                                </div>
                                <div class="ms-4">
                                    <h4>{{ !empty($student) ? $student->first_name . ' ' . $student->last_name : $student->name }}
                                    </h4>
                                    <p class="text-muted mb-2">Member Since:
                                        {{ \Illuminate\Support\Carbon::parse($student->created_at)->format('d-M-Y') }}</p>
                                    {{--                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-rss"></i> Follow</a> --}}
                                    <a href="mailto:{{ $student->email }}" class="btn btn-secondary btn-sm"><i
                                            class="fa fa-envelope"></i> E-mail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-md-flex flex-wrap justify-content-lg-end">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li><a href="#profileMain" class="active show" data-bs-toggle="tab">Profile</a></li>
                                    <li><a href="#allOrders" data-bs-toggle="tab">All Orders</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="profileMain">
                    <div class="card">
                        <div class="card-body p-0">

                            <div class="border-top"></div>
                            <div class="table-responsive p-5">
                                <h3 class="card-title">Personal Info</h3>
                                <table class="table row table-bordered ">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Full Name :</strong>
                                                {{ !empty($student) ? $student->first_name . ' ' . $student->last_name : $student->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email :</strong> {{ $student->email ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone :</strong> {{ $student->mobile ?? '' }} </td>
                                        </tr>

                                    </tbody>
                                    <tbody class="col-lg-12 col-xl-6 p-0 border-top-0">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="allOrders">
                    <div class="card">
                        <div class="card-body border-0 table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>OIN.</th>
                                        <th>Order For</th>
                                        <th>Order Name</th>
                                        <th>Total Price</th>
                                        <th>Paid</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                        <th>Order At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allOrders as $item)
                                    <tr>
                                        <td>{{ $item->order_invoice_number }}</td>
                                        <td>{{ $item->ordered_for }}</td>
                                        @if($item->course !=null)
                                            <td>{{ $item->course->title }}</td>
                                        @elseif($item->batch_exam !=null)
                                            <td>{{ $item->batch_exam->title }}</td>
                                        @elseif($item->product !=null)
                                            <td>{{ $item->product->title }}</td>
                                        @else
                                            <td>{{ 'No Order' }}</td>
                                        @endif
                                        <td>{{ number_format($item->total_amount) }}</td>
                                        <td>{{ number_format($item->paid_amount) }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ date('d.m.Y h:i A', strtotime($item->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
