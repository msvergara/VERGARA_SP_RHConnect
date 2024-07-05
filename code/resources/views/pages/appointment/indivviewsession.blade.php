@extends('layouts.dashboard', ['title' => "RHConnect / Patients"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    {{-- Message Prompt --}}
    <div class="message-fade">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }} fade show p-3">{{ Session::get('alert-' . $msg) }} <a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><a class="link link-gray-100" href="{{ route('pages.patient.viewpatientlist') }}">Patients</a> / <span class="mb-0 text-gray-600">{{ $sessiondata->sessiontoappointment->patientowner->patient_lname}}</span> / <span class="fw-semi text-black-25">{{ date("F j, Y g:i a", strtotime($sessiondata->sessiontoappointment->appointment_datetime))}}</span></h2>
            {{-- <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">{{ $indivdata->patient_lname}}</span></h2> --}}
        </div>

        <div class="button-section">
            <div class="dropdown dmenu btn btn-primary me-2">
                <a class="dropdown-toggle" style="color:white" href="#" id="navbardrop" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-print me-2" style="color:white"></i></i>Export PDF
                </a>
                
                <div class="dropdown-menu sm-menu">
                    <a href="{{ url('export-pdfmedcert/'.$sessiondata->session_id) }}" class="dropdown-item"><i class="fa-solid fa-notes-medical me-2"></i>Medical Certificate</a>
                    <a href="{{ url('export-pdfreferral/'.$sessiondata->session_id) }}" class="dropdown-item"><i class="fa-solid fa-notes-medical me-2"></i>Referral Letter</a>
                </div>
            </div>
            <input type="hidden" value={{ $sessiondata->sessiontoappointment->patientowner->patient_id }} name="id">
            <a href="{{ url('patient/view/'.$sessiondata->sessiontoappointment->patientowner->patient_id) }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
        </div>
    </section>

    <div class="card">
        <div class="card-header"> 
            <h6 class="m-0 fw-bold" style="font-size: 20px">Session Details</h6>
        </div>
        {{-- NOTE: DITO LALAGAY DETAILS, LAYOUT A FORMAT --}}
        <div class="card-body">
            {{-- VITAL SIGNS --}}
            <div class="">
                <div class="">
                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px; color:black">Vital Signs</h6>            
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-2">
                        <div class="col-md-4">
                            <label>
                                Blood Pressure:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_bp ?? null ?: 'N/A'}}</p>
                        </div>
                        <div class="col-md-4">
                            <label>
                                Heart Rate:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_heartrate ?? null ?: 'N/A'}}</p>
                        </div>
                        <div class="col-md-4">
                            <label>
                                Temperature &lpar;in Celsius&rpar;:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_temperature ?? null ?: 'N/A'}}</p>
                        </div>
                    </div>
                    <div class="row g-4 mb-2">
                        <div class="col-md-3">
                            <label>
                                Respiratory Rate:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_respiratoryrate ?? null ?: 'N/A'}}</p>
                        </div>
                        <div class="col-md-3">
                            <label>
                                Oxygen Saturation:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_oxygensat ?? null ?: 'N/A'}}</p>
                        </div>
                        <div class="col-md-3">
                            <label>
                                Height &lpar;in Centimenters&rpar;:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_height ?? null ?: 'N/A'}}</p>
                        </div>
                        <div class="col-md-3">
                            <label>
                                Weight &lpar;in Kilograms&rpar;:
                            </label>
                            <p name="session_px_bp" placeholder="Enter Here" style="">{{$sessiondata->session_px_weight ?? null ?: 'N/A'}}</p>
                        </div>
                    </div>
                    <hr>
                </div>                
            </div>
            {{-- END OF VITAL SIGNS --}}
            {{-- DRUGS BEFORE --}}
            <div class="">
                <div class="">
                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px; color:black">Drugs Taken Before Visitation</h6>            
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                            <colgroup>
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 25%;">
                                <col span="1" style="width: 25%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 25%;">
                            </colgroup>
                            {{-- text-center --}}
                            <thead>
                                <tr class="text-uppercase fw-bold">
                                    <th>ID</th>
                                    <th>Date and Time Taken</th>
                                    <th>Medication</th>
                                    <th>Dose</th>
                                    <th>Presctiption Type</th>
                                </tr> 
                            </thead>
                            
                            <tbody>
                                @foreach ($beforedata as $before)
                                    <tr>
                                        <td>{{ $before->session_taken_id }}</td>
                                        <td>{{ $before->session_taken_meddate }}</td>
                                        <td>{{ $before->session_taken_medname }}</td>
                                        <td>{{ $before->session_taken_meddose }}</td>
                                        <td>{{ $before->session_taken_medcat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>                
            </div>
            {{-- END OF DRUGS BEFORE --}}
            {{-- APPOINTMENT DETAILS --}}
            <div class="">
                <div class="">
                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px; color:black">Appointment Details</h6>            
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-2">
                        <div class="col-md-12">
                            <label>
                                <b>Complaint</b>
                            </label>
                            <p type="text" class="form-control" name="session_complaint"  style="">{{$sessiondata->session_complaint}}</p>
                        </div>
                    </div>
                    <div class="row g-4 mb-2">
                        <div class="col-md-12">
                            <label>
                                <b>Findings</b>
                            </label>
                            <p type="text" class="form-control" name="session_findings"  style="">{{$sessiondata->session_findings}}</p>
                        </div>
                    </div>
                    <div class="row g-4 mb-2">
                        <div class="col-md-12">
                            <label>
                                <b>Treatment</b>
                            </label>
                            <p type="text" class="form-control" name="session_treatment"  style="">{{$sessiondata->session_treatment}}</p>
                        </div>
                    </div>
                    <hr>
                </div>                
            </div>
            {{-- END OF APPOINTMENT DETAILS --}}
            {{-- DRUGS BEFORE --}}
            <div class="">
                <div class="">
                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px; color:black">Order</h6>            
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                            <colgroup>
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 35%;">
                                <col span="1" style="width: 30%;">
                                <col span="1" style="width: 30%;">
                            </colgroup>
                            {{-- text-center --}}
                            <thead>
                                <tr class="text-uppercase fw-bold">
                                    <th>ID</th>
                                    <th>Medication</th>
                                    <th>Dose</th>
                                    <th>Frequency</th>
                                </tr> 
                            </thead>
                            
                            <tbody>
                                @foreach ($orderdata as $order)
                                    <tr>
                                        <td>{{ $order->session_order_id }}</td>
                                        <td>{{ $order->session_order_medname }}</td>
                                        <td>{{ $order->session_order_meddose }}</td>
                                        <td>{{ $order->session_order_medfreq }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>                
            </div>
            {{-- END OF DRUGS BEFORE --}}
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('scripts')

<script type = "text/javascript">

//   $(document).ready( function () {
//     $('#dataTable').DataTable();
//   });


var deleteButton = $("[name='button_delete']")
    // var deleteValue = $("[name='delete_id_value']").attr('value')
    function myFunction(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                new_url = window.location.href + "/delete/" + id;
                window.location = new_url;
            }
        })
    }

    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
</script>
@endsection