@extends('backend.master')

@section('title', 'Course Students')

@section('body')
    <div class="row py-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="float-start text-white">{{ $course->title }} Students</h4>
                    <a href="{{ route('courses.index') }}" title="Back to Courses" class="rounded-circle text-white border-5 text-light f-s-22 btn position-absolute end-0 m-r-80"><i class="fa-solid fa-arrow-left"></i></a>
                    @can('assign-course-student')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#coursesModal" class="rounded-circle text-white border-5 text-light f-s-22 btn position-absolute end-0 me-4"><i class="fa-solid fa-circle-plus"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#transferCourseStudentsModal" class="rounded-circle text-white border-5 text-light f-s-22 btn position-absolute end-0 m-r-50"><i class="fe fe-users"></i></button>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table" id="file-datatable">
                        <thead>
                        <tr>
{{--                            <th>#</th>--}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($course))
{{--                            @foreach($course->students as $key => $student)--}}
                            @foreach($students as $key => $student)
{{--                                @if($key <= 1000)--}}
                                    <tr>
                                        @if(isset($student['students'][0]['first_name']))
                                            <td>{{ $student['students'][0]['first_name'] }}</td>
                                            @else
                                            <td></td>
                                        @endif
                                         @if(isset($student['students'][0]['email']))
                                        <td>{{ $student['students'][0]['email'] }}</td>
                                        @else
                                            <td></td>
                                         @endif
                                          @if(isset($student['students'][0]['mobile']))
                                        <td>{{ $student['students'][0]['mobile'] }}</td>
                                        @else
                                            <td></td>
                                         @endif
                                        <!--<td>{{ $student['status'] == 1 ? 'Active' : 'Inactive' }}</td>-->
                                         @if(isset($student['students'][0]['status']))
                                        <td>{{ $student['students'][0]['status'] == 1 ? 'Active' : 'Inactive' }}</td>
                                        @else
                                            <td></td>
                                         @endif
                                        <td>
{{--                                            <a href="" data-course-id="{{ $course->id }}" class="btn btn-sm btn-warning edit-btn" title="Edit Course">--}}
{{--                                                <i class="mdi mdi-circle-edit-outline"></i>--}}
{{--                                            </a>--}}
                                            @can('detach-course-student')
                                                <form class="d-inline" action="{{ route('detach-student', $course->id) }}" method="post" onsubmit="return confirm('Are you sure to Detach this Student from this course?')">                                            @csrf
                                                    <input type="hidden" name="student_id" value="{{ $student['student_id'] }}">
                                                    <button type="submit" class="btn btn-sm btn-danger data-delete-form" title="Detach Student from this Course?">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
{{--                                @else--}}
{{--                                    @break--}}
{{--                                @endif--}}
                            @endforeach
                        @endif
                        </tbody>
                    </table>
{{--                    {{ $students->links() }}--}}
{{--                    {{ $dataTable->table() }}--}}


{{--                    data table by reza vai starts--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered" id="file_export">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Mobile</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th style="width: 120px;">Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @if(!empty($course))--}}
{{--                                @foreach($course as $key=>$item)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $loop->iteration }}</td>--}}
{{--                                        <td>{{$item->user_name??''}}</td>--}}
{{--                                        <td>{{$item->user_email??''}}</td>--}}
{{--                                        <td>{{$item->user_mobile??''}}</td>--}}
{{--                                        <td class="">{{$item->student_status == 1 ? 'Active' : 'De-active'}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="" data-course-id="{{ $item->course_id }}" class="btn btn-sm btn-warning edit-btn" title="Edit Course">--}}
{{--                                                <i class="mdi mdi-circle-edit-outline"></i>--}}
{{--                                            </a>--}}
{{--                                            @can('detach-course-student')--}}
{{--                                                <form class="d-inline" action="{{ route('detach-student', $item->course_id) }}" method="post" onsubmit="return confirm('Are you sure to Detach this Student from this course?')">                                            @csrf--}}
{{--                                                    <input type="hidden" name="student_id" value="{{ $item->student_id }}">--}}
{{--                                                    <button type="submit" class="btn btn-sm btn-danger" title="Detach Student from this Course?">--}}
{{--                                                        <i class="fa-solid fa-trash"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            @endcan--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}

{{--                </div>--}}
                    {{--                    data table by reza vai ends--}}
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade modal-div" id="coursesModal" data-modal-parent="coursesModal" >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" id="modalForm">
                    <form action="{{ route('assign-new-student', ['course_id' => $course->id]) }}" method="post" enctype="multipart/form-data" id="coursesForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Students</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        {{--                    <input type="hidden" name="category_id" >--}}
                        <div class="modal-body">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-6 mt-2 select2-div">
                                        <label for="">Assign Students</label>
                                        {{--                                    <input type="number" name="paid_amount" class="form-control" placeholder="Search Student">--}}
                                        <select name="student_id" required class="form-control js-example-basic-single select2-style1"  data-placeholder="Assign Student" >
                                            <option label="Assign Students"></option>
                                            {{--                                        @if(isset($students))--}}
                                            {{--                                            @foreach($students as $student)--}}
                                            {{--                                                <option value="{{ $student->id }}" >{{ $student->user->mobile }}</option>--}}
                                            {{--                                            @endforeach--}}
                                            {{--                                        @endif--}}
                                        </select>
                                        <span class="text-danger" id="student_id">{{ $errors->has('student_id') ? $errors->first('student_id') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">Payment Amount</label>
                                        <input type="number" name="paid_amount" class="form-control" placeholder="Payment Amount">
                                        <span class="text-danger" id="paid_amount">{{ $errors->has('paid_amount') ? $errors->first('paid_amount') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">Total Amount</label>
                                        <input type="number" name="total_amount" readonly class="form-control" value="{{ \App\helper\ViewHelper::getModelPriceAfterDiscount('course', $course->id) }}" placeholder="Total Amount" />
                                        <span class="text-danger" id="total_amount">{{ $errors->has('total_amount') ? $errors->first('total_amount') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2 select2-div">
                                        <label for="">Vendor</label>
                                        <select name="vendor" id="" class="form-control select2">
                                            <option value="bkash">Bkash</option>
                                            <option value="nagad">Nagad</option>
                                            <option value="rocket">Rocket</option>
                                        </select>
                                        <span class="text-danger" id="vendor">{{ $errors->has('vendor') ? $errors->first('vendor') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">Paid To</label>
                                        <input type="text" class="form-control" name="paid_to" placeholder="Paid To" />
                                        <span class="text-danger" id="paid_to">{{ $errors->has('paid_to') ? $errors->first('paid_to') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">Paid From</label>
                                        <input type="text" class="form-control" name="paid_from" placeholder="Paid From" />
                                        <span class="text-danger" id="paid_from">{{ $errors->has('paid_from') ? $errors->first('paid_from') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">Txt Id</label>
                                        <input type="text" class="form-control" name="txt_id" placeholder="Txt Id" />
                                        <span class="text-danger" id="txt_id">{{ $errors->has('txt_id') ? $errors->first('txt_id') : '' }}</span>
                                    </div>
                                    <div class="col-sm-6 mt-2 select2-div">
                                        <label for="paymentStatus">Payment Status</label>
                                        <select name="payment_status" class="form-control select2" id="paymentStatus" data-placeholder="Set Payment Status">
                                            <option value=""></option>
                                            <option value="pending">Pending</option>
                                            <option value="partial">Partial</option>
                                            <option value="complete">Complete</option>
                                        </select>
                                        <span class="text-danger" id="payment_status">{{ $errors->has('payment_status') ? $errors->first('payment_status') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit-btn" value="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade modal-div" id="transferCourseStudentsModal" data-modal-parent="coursesModal" >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" id="modalForm">
                    <form action="{{ route('transfer-student', ['course_transfer_to_id' => $course->id]) }}" method="post" enctype="multipart/form-data" id="coursesForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Transfer Students</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-6 mt-2 select2-div">
                                        <label for="">Transfer From</label>
                                        <select name="course_transfer_form_id" required class="form-control select2"  multiple >
                                            <option label="Select Course" disabled selected></option>
                                            {{--                                        @if(isset($students))--}}
                                            @foreach($courses as $publishedCourse)
                                                <option value="{{ $publishedCourse->id }}" >{{ $publishedCourse->title }}</option>
                                            @endforeach
                                            {{--                                        @endif--}}
                                        </select>
                                        <span class="text-danger" id="course_id">{{ $errors->has('course_id') ? $errors->first('course_id') : '' }}</span>
                                    </div>
                                    <div class="col-md-6 mt-2 select2-div">
                                        <label for="">Import Excel</label> <br>
                                        <a href="{{ asset('backend/import-file-samples/student-course-transfer-import-sample.xlsx') }}" download class="btn btn-sm btn-success mt-2">Download Sample</a>
                                        <div class="mt-2">
                                            <input type="file" name="student_file" class="form-control" />
                                            <span class="text-danger">Make sure no number starts with 0.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit-btn" value="save">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
@endsection
@push('style')
    <!-- DragNDrop Css -->
    {{--    <link href="{{ asset('/') }}backend/assets/css/dragNdrop.css" rel="stylesheet" type="text/css" />--}}
    <style>
        input[switch]+label {
            margin-bottom: 0px;
        }
    </style>


    {{--    data tables from reza vai starts--}}
{{--    <link href="{{asset('admin/js_datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/autoFill.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/colReorder.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/dataTables.dateTime.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/fixedColumns.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/fixedHeader.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/keyTable.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/responsive.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/rowGroup.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/rowReorder.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/scroller.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/searchBuilder.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/searchPanes.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/select.dataTables.min.css')}}" rel="stylesheet"/>--}}
{{--    <link href="{{asset('admin/js_datatables/css/stateRestore.dataTables.min.css')}}" rel="stylesheet"/>--}}
    {{--    data tables from reza vai ends--}}



@endpush

@push('script')

    @include('backend.includes.assets.plugin-files.datatable')
    @include('backend.includes.assets.plugin-files.editor')
    {{--    data tables from reza vai starts--}}
{{--    <script src="{{asset('admin/js_datatables/js/jszip.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/pdfmake.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/vfs_fonts.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.autoFill.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.buttons.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/buttons.html5.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/buttons.print.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.colReorder.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.dateTime.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.fixedColumns.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.fixedHeader.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.keyTable.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.responsive.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.rowGroup.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.rowReorder.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.scroller.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.searchBuilder.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.searchPanes.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.select.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.stateRestore.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/js_datatables/js/dataTables.rowsGroup.js')}}"></script>--}}

{{--            <script>--}}
{{--                $(document).ready(function (){--}}
{{--                    $("#file_export").DataTable({--}}
{{--                        // dom: 'QBflrtip',--}}
{{--                        dom: 'Bflrtip',--}}
{{--                        columnDefs: [--}}
{{--                            { width: '15%', targets: 0 }--}}
{{--                        ],--}}
{{--                        "lengthMenu": [ [10, 15, 20, 50, -1], [10, 15, 20, 50, "All"] ],--}}
{{--                        "pageLength": 15,--}}
{{--                        rowsGroup:[0],--}}
{{--                        buttons: [--}}
{{--                            'copy', 'csv', 'excel', 'pdf', 'print'--}}
{{--                        ],--}}
{{--                        language: {--}}
{{--                            searchBuilder: {--}}
{{--                                title: {--}}
{{--                                    0: 'Condition search filter',--}}
{{--                                    _: 'Custom Search Conditions (%d)'--}}
{{--                                },--}}
{{--                                value: 'Option',--}}
{{--                                valueJoiner: 'et'--}}
{{--                            }--}}
{{--                        },--}}
{{--                        customSearchOptions: {--}}
{{--                            title: 'Condition search filter'--}}
{{--                        },--}}
{{--                        buttons: [--}}
{{--                            'copy',--}}
{{--                            {--}}
{{--                                extend: 'csv',--}}
{{--                                filename: function () {--}}
{{--                                    return 'User report';--}}
{{--                                },--}}
{{--                            },--}}
{{--                            {--}}
{{--                                extend: 'excel',--}}
{{--                                filename: function () {--}}
{{--                                    return 'User report';--}}
{{--                                },--}}
{{--                                footer: true,--}}
{{--                            },--}}
{{--                            {--}}
{{--                                extend: 'pdf',--}}
{{--                                filename: function () {--}}
{{--                                    return 'User report';--}}
{{--                                },--}}
{{--                                footer: true,--}}
{{--                                pageSize: 'A4',--}}
{{--                                orientation: 'landscape',--}}
{{--                            },--}}
{{--                            {--}}
{{--                                extend: 'print',--}}
{{--                                messageTop: function () {--}}
{{--                                    return 'The data generated on: ' + new Date();--}}
{{--                                },--}}
{{--                                footer: true,--}}

{{--                            }--}}
{{--                        ],--}}
{{--                        // order : [[0,'DESC']],--}}

{{--                    });--}}

{{--                });--}}
{{--            </script>--}}
    {{--    data tables from reza vai ends--}}


{{--@include('backend.includes.assets.plugin-files.datatable')--}}

@if($errors->any())
    <script>
        $(function () {
            $('#coursesModal').modal('show');
        })
    </script>
@endif

<script>
    // pagination on ajax
    // $(document).on('click', '.page-link', function () {
    //     event.preventDefault();
    //     var href = $(this).attr('href');
    //     // check if page link has href
    //     if (href !== undefined)
    //     {
    //         $.ajax({
    //             url: href,
    //             method: "GET",
    //             success: function (response) {
    //                 $('tbody').html(response);
    //             }
    //         })
    //
    //         $('.page-item').each(function () {
    //             if ($(this).hasClass('active'))
    //             {
    //                 $(this).removeClass('active');
    //             }
    //         })
    //
    //         $(this).parent().addClass('active').attr("aria-current","page");
    //     }
    // })

    {{--$(function () {--}}
    {{--    var table = $('.data-table').DataTable({--}}
    {{--        processing: true,--}}
    {{--        serverSide: true,--}}
    {{--        dom: 'Blfrtip',--}}
    {{--        ajax: "{{ route('assign-student-to-course', ['course_id' => $course->id]) }}",--}}
    {{--        columns: [--}}
    {{--            // {data: 'id', name: 'id'},--}}
    {{--            {data: 'name', name: 'name'},--}}
    {{--            {data: 'mobile', name: 'mobile'},--}}
    {{--            {data: 'status', name: 'status'},--}}
    {{--            {data: 'action', name: 'action', orderable: false, searchable: false},--}}
    {{--        ]--}}
    {{--    });--}}
    {{--})--}}
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            dropdownParent: $('#coursesModal'),
            ajax: {
                url: "{{ route('search-student-ajax') }}",
                datatype: "json",
                delay: 250,
                data: function (params) {
                    return {mobile:params.term}
                },
                processResults: function (data) {
                    // return {
                    //     results: data.items
                    // }


                    var formattedData = data.map(function (item) {
                        return { id: item.id, text: item.mobile, image: item.profile_photo_url };
                    });

                    return {
                        results: formattedData
                    };
                }
            },
            templateResult: formatResult,
            templateSelection: formatResult,
        });
        function formatResult(result) {
            if (!result.id) {
                return result.text;
            }

            var $result = $(
                '<span> ' + result.text + '</span>'
            );

            return $result;
        }
        // $(".select2-style1").select2({
        //     templateResult: a,
        //     templateSelection: a,
        //     escapeMarkup: function (e) {
        //         return e
        //     }
        // })

        // function a(e) {
        //     return e.id ? $('<span><img src="https://laravel8.spruko.com/noa/assets/images/users/' + e.element.value.toLowerCase() + '.jpg" class="rounded-circle avatar-sm" /> ' + e.text + "</span>") : e.text
        // }
    });


</script>

    {{--    edit course category--}}
    <script>
        $(document).on('click', '.edit-btn', function () {
            event.preventDefault();
            var courseId = $(this).attr('data-course-id');
            console.log(courseId);
            $.ajax({
                url: base_url+"courses/"+courseId+"/edit",
                method: "GET",
                // dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#modalForm').empty().append(data);

                    $('.select2').select2({
                        placeholder: $(this).attr('data-placeholder'),
                        dropdownParent: $('#'+$('.modal-fix').attr('data-modal-parent')),
                        // dropdownParent: $('.modal').attr('data-modal-parent'),
                    });


                    $('#coursesModal').modal('show');
                }
            })
        })
    </script>
    {{-- update course category--}}
{{--    <script>--}}
{{--        $(document).on('click', '.update-btn', function () {--}}
{{--            event.preventDefault();--}}
{{--            var formData = $('#courseCategoryForm').serialize();--}}
{{--            $.ajax({--}}
{{--                url: $('#courseCategoryForm').attr('action'),--}}
{{--                method: "PUT",--}}
{{--                data: formData,--}}
{{--                dataType: "JSON",--}}
{{--                // async: false,--}}
{{--                // cache: false,--}}
{{--                contentType: false,--}}
{{--                processData: false,--}}
{{--                // enctype: 'multipart/form-data',--}}
{{--                success: function (message) {--}}
{{--                    // console.log(formData);--}}
{{--                    toastr.success(message);--}}
{{--                    $('.update-btn').addClass('submit-btn').removeClass('update-btn');--}}
{{--                    $('#courseCategoryForm').attr('action', '');--}}
{{--                    $('#courseCategoryModal').modal('hide');--}}
{{--                    window.location.reload();--}}
{{--                    resetInputFields();--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--    <!-- DragNDrop js -->--}}

{{--    --}}{{--    <script src="{{ asset('/') }}backend/assets/js/dragNdrop/init.js"></script>--}}


{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#categoryImage').change(function() {--}}
{{--                var imgURL = URL.createObjectURL(event.target.files[0]);--}}
{{--                $('#imagePreview').attr('src', imgURL).css({--}}
{{--                    height: 150+'px',--}}
{{--                    width: 150+'px',--}}
{{--                    marginTop: '5px'--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
