@extends('frontend.student-master')

@section('student-body')
    <section class="py-5">
        <div class="row">
            <div class="section-title ">
                <div class="card">
                    <div class="">
                        <h2 class="text-center"> Exam Ranking</h2>
                        <hr class="w-25 mx-auto bg-danger"/>
                    </div>
                    <div class="card-body">
                        <div class="row ">

                            <div class="card card-body table-responsive">
                                <table class="table ranking-table table-borderless" id="" >
                                    <thead>
                                        <tr>
                                            <td>Rank</td>
                                            <td>Name</td>
                                            <td>Mark</td>
                                            <td>Status</td>
                                            @if(count($courseExamResults) > 0)
                                                @if($courseExamResults[0]->xm_type == 'exam')
                                                    <td>Provided Ans</td>
                                                    <td>Right Ans</td>
                                                    <td>Wrong Ans</td>
                                                @endif
                                            @endif
                                            <td>Duration</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courseExamResults as $key => $courseExamResult)
                                            {{-- @if($key <= 4) --}}
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $courseExamResult->user->name }}</td>
                                                    <td>{{ $courseExamResult->result_mark ?? 0 }}</td>
                                                    <td>
                                                        @if(!empty($courseExamResult->status))
                                                            @if(($courseExamResult->status === 'pass'))
                                                                <button class="btn btn-sm" style="background-color: green; color: white;">Pass</button>
                                                            @elseif(($courseExamResult->status === 'fail'))
                                                                <button class="btn btn-sm" style="background-color: red; color: white;">Fail</button>
                                                            @else
                                                                <button class="btn btn-sm" style="background-color: orange; color: white;">Pending</button>
                                                            @endif
                                                        @endif
                                                    </td>

                                                    @if($courseExamResults[0]->xm_type == 'exam')
                                                        <td>{{ $courseExamResult->total_provided_ans ?? 0 }}</td>
                                                        <td>{{ $courseExamResult->total_right_ans ?? 0 }}</td>
                                                        <td>{{ $courseExamResult->total_wrong_ans ?? 0 }}</td>
                                                    @endif
                                                    <td>{{ \Carbon\CarbonInterval::seconds($courseExamResult->required_time)->cascade()->forHumans() }}</td>
                                                </tr>
                                            {{-- @endif --}}
                                        @endforeach
                                        {{-- @if(!empty($myPosition))
                                            @if(isset($myPosition->position))
                                                @if($myPosition->position > 4)
                                                    <tr class="correct-ans-bg">
                                                        <td>{{ $myPosition->position }}</td>
                                                        <td>{{ $myPosition->user->name }}</td>
                                                        <td>{{ $myPosition->result_mark ?? 0 }}</td>
                                                        <td>{{ $courseExamResult->total_provided_ans ?? 0 }}</td>
                                                        <td>{{ $courseExamResult->total_right_ans ?? 0 }}</td>
                                                        <td>{{ $courseExamResult->total_wrong_ans ?? 0 }}</td>
                                                        <td>{{ \Carbon\CarbonInterval::seconds($myPosition->required_time)->cascade()->forHumans() }}</td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endif
                                        @foreach($courseExamResults as $index => $courseExamResultx)
                                            @if($index > 4)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $courseExamResultx->user->name }}</td>
                                                    <td>{{ $courseExamResultx->result_mark ?? 0 }}</td>
                                                    <td>{{ $courseExamResult->total_provided_ans ?? 0 }}</td>
                                                    <td>{{ $courseExamResult->total_right_ans ?? 0 }}</td>
                                                    <td>{{ $courseExamResult->total_wrong_ans ?? 0 }}</td>
                                                    <td>{{ \Carbon\CarbonInterval::seconds($courseExamResultx->required_time)->cascade()->forHumans() }}</td>
                                                </tr>
                                            @endif
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                {{-- {!! $courseExamResults->links() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style')
    <style>
        .correct-ans-bg { background-color: #B2DB9A}
        .ranking-table td {font-size: 20px}
        .ranking-table th {font-size: 24px}

        /*#file-datatable_wrapper .dt-buttons{*/
        /*    position: absolute !important;*/
        /*    top: 0px !important;*/
        /*    left: 136px !important;*/
        /*}*/
    </style>
@endpush

@push('script')
   @include('backend.includes.assets.plugin-files.datatable')
@endpush
