@extends('layouts.dashboard', ['title' => "RHConnect / View Sessions"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    <div class="message-fade">
        {{-- Message Prompt --}}
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }}" id="success-alert">
                    {!! Session::get('alert-' . $msg) !!}
                </div>
                <button type="button" id="tested" onclick="mysFunction()" class="close" data-dismiss="alert"></button>
            @endif
        @endforeach
    </div>
 
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"> <a class="link link-gray-100" href="{{ route('pages.schedule.schedule') }}">Schedule</a> / <span class="fw-semi text-black-25">View All Admissions</span></h2>
        </div>

        <div class="button-section">
            <a href="{{ route('pages.admissions.create') }}" class="btn btn-default me-2 {{ Auth::user()->roles == 1 ? 'd-none' : '' }}"><i class="fa-solid fa-plus me-2"></i>Create New</a>
            <a href="{{ route('pages.schedule.schedule') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">View All</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered generic-table w-100" id="admission-table" cellspacing="0">
                            <colgroup>
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 30%;">
                                <col span="1" style="width: 25%;">
                                <col span="1" style="width: 35%;">
                                @if (Auth::user()->roles == 2)
                                    <col span="1" style="width: 5%;">
                                @endif
                            </colgroup>
                            
                            <thead>
                                <tr class="text-uppercase fw-bold">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Schedule</th>
                                    <th class="text-center px-4 {{ Auth::user()->roles == 1 ? 'd-none' : '' }}">Actions</th>
                                </tr> 
                            </thead>
                            
                            <tbody>
                                @foreach ($data as $adm)
                                    @if (Auth::user()->id == $adm->patientowner->hcworker->id & Auth::user()->roles == 2)
                                        <tr>
                                            <td>{{ $adm->appointment_id }}</td>
                                            <td>{{ $adm->title }}</td>
                                            <td>{{ $adm->description }}</td>
                                            <td>{{ date("F j, Y - g:i a", strtotime($adm->appointment_datetime)) }}</td>
                                            <td class="action-section d-flex flex-column">
                                                <a href="{{ route('pages.admissions.update', ['patient_id' => $adm->appointment_id]) }}" class="btn btn-primary update mb-2">Update</a> 
                                                <a href="javascript:void(0);" data-id="{{ $adm->appointment_id }}" class="btn btn-danger delete">Delete</a>
                                            </td> 
                                        </tr>
                                    @endif
                                    @if (Auth::user()->roles == 1)
                                    <tr>
                                        <td>{{ $adm->appointment_id }}</td>
                                        <td>{{ $adm->title }}</td>
                                        <td>{{ $adm->description }}</td>
                                        <td>{{ date("F j, Y - g:i a", strtotime($adm->appointment_datetime)) }}</td>
                                        <td class="action-section {{ Auth::user()->roles == 1 ? 'd-none' : 'd-flex flex-column' }}">
                                            <a href="{{ route('pages.admissions.update', ['patient_id' => $adm->appointment_id]) }}" class="btn btn-primary update mb-2">Update</a> 
                                            <a href="javascript:void(0);" data-id="{{ $adm->appointment_id }}" class="btn btn-danger delete">Delete</a>
                                        </td> 
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        new DataTable('#admission-table', {
            scrollX: true,
            aaSorting: [],
            order: [ 0, 'desc' ],
            'columnDefs': [ {
                'targets': [4], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }]
        });

        var modal = $('.modal.generic-modal');
        $('.delete').on('click', function() {
            var a_id = $(this).attr('data-id');
            $(modal).find(".modal-body > .text-section p > .status").text("removed");
            $(modal).find(".modal-footer > .btn.proceed").text("Remove");
            $(modal).find(".modal-footer > .btn.proceed").attr("href", "/schedule/delete/" + a_id);
            $(modal).modal('show');
        });
    });
</script>
@endsection