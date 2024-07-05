@extends('layouts.dashboard', ['title' => "RHConnect / Patients"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    {{-- Message Prompt --}}
    <div class="message-fade">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }} fade show p-3">{!! Session::get('alert-' . $msg) !!} <a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><a class="link link-gray-100" href="{{ route('pages.patient.viewpatientlist') }}">Patients</a> / <span class="fw-semi text-black-25">{{ $indivdata->patient_lname}}</span></h2>
            {{-- <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">{{ $indivdata->patient_lname}}</span></h2> --}}
        </div>

        <div class="button-section">
            {{-- <a href="{{ url('schedule/create/'.$indivdata->patient_id) }}" class="btn btn-default me-2"><i class="fa-solid fa-plus me-2"></i>Create Appointment</a> --}}
            <a href="{{ route('pages.patient.viewpatientlist') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                {{-- <div class="card-header">
                    <h6 class="text-black-25"><span class="fw-semi">Name: </span><span class="">{{ $indivdata->patient_lname}}, {{ $indivdata->patient_fname}} </span></h6>
                    <h6 class="text-black-25"><span class="fw-semi">Birthday: </span><span class="">{{ $indivdata->patient_birthday}}</span></h6>
                </div> --}}

                {{-- indivdata = get px data --}}
                <div class="card-body p-0">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Patient Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- START CARD = 1ST CAT DEMOGRAPHICS --}}
                                <div class="">
                                    <div class="">
                                        <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">I. Demographic Information</h6>
                                    </div>
                                    <div class="card-body p-0 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="">
                                                    <span><strong>Name: </strong>{{ucwords($indivdata->patient_fname)}} {{ucwords($indivdata->patient_mname)}} {{ucwords($indivdata->patient_lname)}} {{ucwords($indivdata->patient_extension)}}</span>
                                                    <br>
                                                    <span><strong>Birthday: </strong> {{date("F j, Y", strtotime($indivdata->patient_birthday)) ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Sex: </strong>{{ucwords($indivdata->patient_sex) ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Blood Type: </strong>{{$indivdata->patient_bloodtype ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Contact Number: </strong>{{$indivdata->patient_cpnum ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Address: </strong>{{$indivdata->patient_street}} {{$indivdata->patient_barangay ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Period Status: </strong>{{ ($indivdata->patient_period_status) ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Pregnancy Status: </strong>{{ ($indivdata->patient_preg_status) ?? null ?: 'N/A' }}</span>
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>                
                                </div>
                                {{-- END CARD = 1ST CAT DEMOGRAPHICS --}}
                            </div>
                            <div class="col-md-6">
                                {{-- START CARD = 2ND CAT EMERGENCY CONTACT --}}
                                <div class="">
                                    <div class="">
                                        <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">II. Emergency Contact Information</h6>
                                    </div>
                                    <div class="card-body p-0 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="">
                                                    <span><strong>Name: </strong>{{ucwords($indivdata->patient_ec_fname)}} {{ucwords($indivdata->patient_ec_mname)}} {{ucwords($indivdata->patient_ec_lname) ?? null ?: 'N/A'}} {{ucwords($indivdata->patient_ec_extension)}}</span>
                                                    <br>
                                                    <span><strong>Contact Number: </strong>{{$indivdata->patient_ec_cpnum ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Address: </strong>{{$indivdata->patient_ec_street}} {{$indivdata->patient_ec_barangay ?? null ?: 'N/A'}}</span>
                                                    <br>
                                                    <span><strong>Relationship: </strong>{{$indivdata->patient_ec_relationship ?? null ?: 'N/A'}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>                
                                </div>
                                {{-- END CARD = 2ND CAT EMERGENCY CONTACT --}}
                            </div>                            
                        </div>
                        {{-- START CARD = 3RD CAT HISTORY: ALLERGY --}}
                        <div class="">
                            <div class="">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">III. Patient Allergies</h6>            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                        <colgroup>
                                            <col span="1" style="width: 50%;">
                                            <col span="1" style="width: 50%;">
                                        </colgroup>
                                        {{-- text-center --}}
                                        <thead>
                                            <tr class="text-uppercase fw-bold">
                                                <th>Allergy Category</th>
                                                <th>Allergen</th>
                                            </tr> 
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($allergydata as $allergy)
                                                <tr>
                                                    <td>{{ $allergy->patient_allergy_cat }}</td>
                                                    <td>{{ $allergy->patient_allergy_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            </div>                
                        </div>
                        {{-- END CARD = 3RD CAT HISTORY: ALLERGY --}}             
                        {{-- START CARD = 4TH CAT HISTORY: ILLNESS --}}
                        <div class="">
                            <div class="">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">IV. Illness / Injury History</h6>            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                        <colgroup>
                                            <col span="1" style="width: 25%;">
                                            <col span="1" style="width: 25%;">
                                            <col span="1" style="width: 25%;">
                                            <col span="1" style="width: 25%;">
                                        </colgroup>
                                        {{-- text-center --}}
                                        <thead>
                                            <tr class="text-uppercase fw-bold">
                                                <th>Date</th>
                                                <th>Illness / Injury</th>
                                                <th>Signs and Symptoms</th>
                                                <th>Prescriptions</th>
                                            </tr> 
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($illnessdata as $illness)
                                                <tr>
                                                    <td>{{ $illness->patient_ill_date }}</td>
                                                    <td>{{ $illness->patient_ill_name }}</td>
                                                    <td>{{ $illness->patient_ill_ssx }}</td>
                                                    <td>
                                                        @foreach ($illprescdata as $illpresc)
                                                            @if ($illpresc->prescriptiontoillness->patient_ill_id == $illness->patient_ill_id)
                                                                <p>
                                                                    Medicine: {{ $illpresc->patient_medname }}<br>
                                                                    Dose: {{ $illpresc->patient_meddose }}<br>
                                                                    Frequency: {{ $illpresc->patient_medfreq }}<br>
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            </div>                
                        </div>
                        {{-- END CARD = 4TH CAT HISTORY: ILLNESS --}}     
   
                        <div class="row">
                            {{-- START CARD = 5TH CAT HISTORY: SURGERY --}}
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">V. Surgery History</h6>            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                            <colgroup>
                                                <col span="1" style="width: 25%;">
                                                <col span="1" style="width: 35%;">
                                                <col span="1" style="width: 40%;">
                                            </colgroup>
                                            {{-- text-center --}}
                                            <thead>
                                                <tr class="text-uppercase fw-bold">
                                                    <th>Date</th>
                                                    <th>Surgery Type</th>
                                                    <th>Complications</th>
                                                </tr> 
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($surgerydata as $surgery)
                                                    <tr>
                                                        <td>{{ $surgery->patient_surg_date }}</td>
                                                        <td>{{ $surgery->patient_surg_name }}</td>
                                                        <td>{{ $surgery->patient_surg_comp }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                
                            </div>
                            {{-- START CARD = 5TH CAT HISTORY: SURGERY --}}      
                            {{-- START CARD = 4TH CAT HISTORY: OBGYN --}}
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">VI. Obstretic / Gynecology</h6>            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                            <colgroup>
                                                <col span="1" style="width: 25%;">
                                                <col span="1" style="width: 75%;">
                                            </colgroup>
                                            {{-- text-center --}}
                                            <thead>
                                                <tr class="text-uppercase fw-bold">
                                                    <th>Condition</th>
                                                    <th>Prescriptions</th>
                                                </tr> 
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($obgyndata as $obgyn)
                                                    <tr>
                                                        <td>{{ $obgyn->patient_ob_name }}</td>
                                                        <td>
                                                            @foreach ($obprescdata as $obgynpresc)
                                                                @if ($obgynpresc->prescription_to_obgyn->patient_ob_id == $obgyn->patient_ob_id)
                                                                    <p>
                                                                        Medicine: {{ $obgynpresc->patient_medname }}<br>
                                                                        Dose: {{ $obgynpresc->patient_meddose }}<br>
                                                                        Frequency: {{ $obgynpresc->patient_medfreq }}<br>
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                
                            </div>
                            {{-- END CARD = 4TH CAT HISTORY: OBGYN --}}                           
                        </div>  
                        <div class="row">
                            {{-- START CARD = 7TH CAT HISTORY: ACTIVE MED --}}
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">VII. Active Medical Condition(s)</h6>            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                            <colgroup>
                                                <col span="1" style="width: 25%;">
                                                <col span="1" style="width: 75%;">
                                            </colgroup>
                                            {{-- text-center --}}
                                            <thead>
                                                <tr class="text-uppercase fw-bold">
                                                    <th>Condition</th>
                                                    <th>Prescriptions</th>
                                                </tr> 
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($activedata as $active)
                                                    <tr>
                                                        <td>{{ $active->patient_active_condition }}</td>
                                                        <td>
                                                            @foreach ($actprescdata as $activepresc)
                                                                @if ($activepresc->prescription_to_active_med->patient_active_id == $active->patient_active_id)
                                                                    <p>
                                                                        Medicine: {{ $activepresc->patient_medname }}<br>
                                                                        Dose: {{ $activepresc->patient_meddose }}<br>
                                                                        Frequency: {{ $activepresc->patient_medfreq }}<br>
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                
                            </div>
                            {{-- END CARD = 7TH CAT HISTORY: ACTIVE MED --}}     
                            {{-- START CARD = 8TH CAT HISTORY: IMMUNIZATION --}}
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 15px">VIII. Immunization History</h6>            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                            <colgroup>
                                                <col span="1" style="width: 30%;">
                                                <col span="1" style="width: 25%;">
                                                <col span="1" style="width: 25%;">
                                                <col span="1" style="width: 25%;">
                                            </colgroup>
                                            {{-- text-center --}}
                                            <thead>
                                                <tr class="text-uppercase fw-bold">
                                                    <th>Date</th>
                                                    <th>Dose</th>
                                                    <th>Name</th>
                                                    <th>Untoward Reaction</th>
                                                </tr> 
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($immunodata as $immuno)
                                                    <tr>
                                                        <td>{{ $immuno->patient_immu_date }}</td>
                                                        <td>{{ $immuno->patient_immu_cat }}</td>
                                                        <td>{{ $immuno->patient_immu_name }}</td>
                                                        <td>{{ $immuno->patient_immu_reax }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                
                            </div>                        
                            {{-- END CARD = 8TH CAT HISTORY: IMMUNIZATION --}}     
                        </div> 
                    </div>
                </div>
                <div class="card-body p-0">
                    <div></div>
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Session History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 10%;">
                                </colgroup>
                                
                                <thead>
                                    <tr class="text-uppercase fw-bold">
                                        <th>ID</th>
                                        <th>Appointment Date</th>
                                        <th>Session Complaint</th>
                                        <th>Session Findings</th>
                                        <th class="text-center px-4">Actions</th>
                                    </tr> 
                                </thead>
                                
                                <tbody>
                                    @foreach ($sessiondata as $session)
                                    @if ($session->sessiontoappointment->patientowner->patient_id == $indivdata->patient_id)
                                        <tr>
                                            <td>{{ $session->session_id }}</td>
                                            <td class=""><a href="/session/view/fullreport/{{ $session->session_id }}" class="" style="font-size: 15px; color:green; font-weight:bold">{{ date("F j, Y g:i a", strtotime($session->sessiontoappointment->appointment_datetime))}}</a></td>
                                            <td>{{ $session->session_complaint }}</td>
                                            <td>{{ $session->session_findings }}</td>
                                            <td class="action-section d-flex flex-column">
                                                <a href="{{ route('pages.appointment.updatesession', ['appointment_id' => $session->appointment_id]) }}" class="btn btn-primary update mb-2">Update</a> 
                                                <a href="javascript:void(0);" data-id="{{ $session->session_id }}" class="btn btn-danger delete mb-2">Delete</a>
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
</div>
<!-- /.container-fluid -->

@endsection

@section('scripts')

<script type = "text/javascript">

    $(document).ready( function () {
        $('#dataTable').DataTable();
    });

    var modal = $('.modal.generic-modal');
    $('.delete').on('click', function() {
        var id = $(this).attr('data-id');
        $(modal).find(".modal-body > .text-section p > .status").text("removed");
        $(modal).find(".modal-footer > .btn.proceed").text("Remove");
        $(modal).find(".modal-footer > .btn.proceed").attr("href", "/session/delete/" + id);
        $(modal).modal('show');
    });

    // // delete sweet alert
    // var deleteButton = $(".session-delete");
    // deleteButton.on('click', function() {
    //     var id = $(this).data('id');
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //         if (result.isConfirmed) {
    //             window.location.href = "/session/delete/" + id;
    //         }
    //     });
    // });

    setTimeout(function() {
        $(".alert").alert('close');
    }, 3000);
</script>
@endsection