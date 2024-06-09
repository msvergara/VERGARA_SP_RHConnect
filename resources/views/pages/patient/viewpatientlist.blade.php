@extends('layouts.dashboard', ['title' => "RHConnect / Patients"])
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
            <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">Patients</span></h2>
        </div>
        @if (Auth::user()->roles == 2)
        <div class="button-section">
            <a href="{{ route('pages.patient.createpatient') }}" class="btn btn-default me-2"><i class="fa-solid fa-plus me-2"></i>Create New</a>
            {{-- <a href="{{ route('pdf.generate.patientslist') }}" class="btn btn-primary me-2"><i class="fa-solid fa-print me-2"></i></i>Export PDF</a> --}}
            {{-- <a href="{{ route('pages.schedule.schedule') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a> --}}
        </div>            
        @endif

        @if (Auth::user()->roles == 1)
        <div class="button-section">
            <a href="{{ route('pages.admissions.view') }}" class="btn btn-default"><i class="fa-solid fa-bars me-2"></i>View All Admissions</a>
        </div>
        @endif

    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">View All</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                            <colgroup>
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: 20%;">
                                @if (Auth::user()->roles == 2)
                                    <col span="1" style="width: 5%;">
                                @endif
                            </colgroup>
                            
                            <thead>
                                <tr class="text-uppercase fw-bold">
                                    <th>ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Sex</th>
                                    <th>Date of Birth</th>
                                    <th class="text-center px-4 {{ Auth::user()->roles == 1 ? 'd-none' : '' }}">Actions</th>
                                </tr> 
                            </thead>
                            
                            <tbody>
                                @foreach ($patientdata as $patient)
                                    @if (Auth::user()->id == $patient->hcworker_id & Auth::user()->roles == 2)
                                        <tr>
                                            <td>{{ $patient->patient_id }}</td>
                                            <td class="__content-heading m-0 font-weight-bold" style="font-size: 15px"><a href="/patient/view/{{ $patient->patient_id }}" class="" style="font-size: 18px; color:green">{{ $patient->patient_lname }}</a></td>
                                            <td>{{ $patient->patient_fname }}</td>
                                            <td>{{ $patient->patient_mname }}</td>
                                            <td>{{ ucfirst($patient->patient_sex) }}</td>
                                            <td>{{ date("F j, Y", strtotime($patient->patient_birthday)) }}</td>
                                            <td class="action-section d-flex flex-column">
                                                <a href="{{ route('pages.patient.updatepatient', ['patient_id' => $patient->patient_id]) }}" class="btn btn-primary update mb-2">Update</a> 
                                                <a href="javascript:void(0);" data-id="{{ $patient->patient_id }}" class="btn btn-danger delete mb-2">Delete</a>
                                                {{-- <a href="/patient/view/{{ $patient->patient_id }}" class="btn btn-danger">Full Profile</a> --}}
                                            </td> 
                                        </tr>
                                    @endif
                                    @if (Auth::user()->roles == 1)
                                    <tr>
                                        <td>{{ $patient->patient_id }}</td>
                                        <td class="__content-heading m-0 font-weight-bold" style="font-size: 15px">{{ $patient->patient_lname }}</td>
                                        <td>{{ $patient->patient_fname }}</td>
                                        <td>{{ $patient->patient_mname }}</td>
                                        <td>{{ ucfirst($patient->patient_sex) }}</td>
                                        <td>{{ date("F j, Y", strtotime($patient->patient_birthday)) }}</td>
                                        
                                        <td class="action-section {{ Auth::user()->roles == 1 ? 'd-none' : 'd-flex flex-column' }}">
                                            <a href="{{ route('pages.patient.updatepatient', ['patient_id' => $patient->patient_id]) }}" class="btn btn-primary update mb-2" @disabled(true)>Update</a> 
                                            <a href="javascript:void(0);" data-id="{{ $patient->patient_id }}" class="btn btn-danger delete mb-2">Delete</a>
                                            {{-- <a href="/patient/view/{{ $patient->patient_id }}" class="btn btn-danger">Full Profile</a> --}}
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
        new DataTable('#patient-table', {
            scrollX: true,
            aaSorting: [],
            order: [ 0, 'desc' ],
            'columnDefs': [ {
                'targets': [6], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }]
        });

        var modal = $('.modal.generic-modal');
        $('.delete').on('click', function() {
            var id = $(this).attr('data-id');
            $(modal).find(".modal-body > .text-section p > .status").text("removed");
            $(modal).find(".modal-footer > .btn.proceed").text("Remove");
            $(modal).find(".modal-footer > .btn.proceed").attr("href", "/patient/delete/" + id);
            $(modal).modal('show');
        });
    });
</script>
@endsection