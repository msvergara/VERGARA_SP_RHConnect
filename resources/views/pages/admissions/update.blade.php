@extends('layouts.dashboard', ['title' => "RHConnect / Update Admission"])
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
    <form method="POST" action="{{ route('pages.admissions.update') }}" enctype ="multipart/form-data" autocomplete="off">
        @csrf  
        <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
            <div class="title-section d-flex align-items-center">
                <h2 class="mb-0 text-gray-600">Schedule / <span class="fw-semi text-black-25">Update Admission</span></h2>
            </div>

            <div class="button-section">
                <button type="submit" class="btn btn-default me-2"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                <a href="{{ route('pages.admissions.view') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Cancel</a>
            </div>
        </section>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Fill-up Information</h6>
                    </div>

                    <div class="card-body">
                        <section class="form-canvas">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <input type="hidden" value={{ $patient_id }} name="id">
                                    <div class="d-flex justify-content-between">
                                        <label>Patient</label>
                                        <a href="{{ route('pages.patient.createpatient') }}" class="link">Not on the list? Add new</a>
                                    </div>
                                    
                                    <select class="form-select patient-drop" name="patient">
                                        @foreach ($patient_list as $p_list)
                                            <option value="{{ $p_list->patient_id }}" {{ $p_list->patient_id == $data->patient_id ? 'selected' : '' }}>{{ $p_list->patient_lname }}, {{ $p_list->patient_fname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $data->title }}" placeholder="Enter Here">
                                </div>

                                <div class="col-md-4">
                                    <label>Date & Time</label>
                                    <input type="datetime-local" class="form-control" name="appointment_datetime"value="{{ $admission_datetime }}"  placeholder="Enter Here" required>
                                </div>

                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" cols="30" rows="5">{{ $data->description }}</textarea>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Page Content -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.patient-drop').select2();
    });
</script>
@endsection