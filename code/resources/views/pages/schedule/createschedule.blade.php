@extends('layouts.dashboard', ['title' => "RHConnect / Create Appointment"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

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
    
    <form method="POST" action="{{ route('pages.schedule.createschedule') }}" enctype ="multipart/form-data" autocomplete="off">
        @csrf
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="__navbar-breadcrumb"><span><a href="{{ route('pages.schedule.schedule') }}">APPOINTMENT</a></span> / <b>CREATE</b></h1>     
            <div class="d-flex flex-row">
                <button class="__content-button btn btn-sm" type="submit">
                    <i class="fas fa-arrow-right fa-sm text-white-60 mr-2"></i> Submit
                </button>
                <a href="{{ route('pages.schedule.schedule') }}" class="__content-button btn btn-sm" style="background-color: red;">
                    <i class="fas fa-xmark fa-sm text-white-60 mr-2"></i> Cancel
                </a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Add Appointment for //surname ng patient//</h6>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label class="pt-2">
                            Title
                        </label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Here">
                    </div>
                    <div class="col-md-4">
                        <label class="pt-2">
                            Description
                        </label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Here">
                    </div>
                    <div class="col-md-4">
                        <label class="pt-2">
                            Date and Time
                        </label>
                        <input type="datetime-local" class="form-control" name="appointment_datetime" placeholder="Enter Here" required>
                    </div>
                    <div hidden class="col-md-4">
                        <label class="pt-2">
                            Patient Owner
                        </label>
                        <input type="text" value="{{ $patientdata->patient_id }}" class="form-control" name="patient_id" placeholder="Enter Here" required>
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
</script>
@endsection