@extends('layouts.dashboard', ['title' => "RHConnect / Update Session"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    <form method="POST" action="{{ route('pages.appointment.updatesession') }}" enctype ="multipart/form-data" autocomplete="off">
        @csrf
        
        <!-- Page Heading -->
        <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
            <div class="title-section d-flex align-items-center">
                <h2 class="mb-0 text-gray-600"><a class="link link-gray-100" href="{{ route('pages.patient.viewpatientlist') }}">Session</a> / <span class="fw-semi text-black-25">Update Session</span></h2>
            </div>

            <div class="button-section">
                <button type="submit" class="btn btn-default me-2"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                <a href="{{ url('patient/view/'.$patient_id) }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Cancel</a>
            </div>
        </section>

        <div id="form-canvas">
            <input type="hidden" name="id" value="{{ $data->appointment_id }}">
            <input type="hidden" name="patient_id" value="{{ $patient_id }}">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-xl-12">
                        {{-- LABEL HEADER PX DETAILS --}}
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Update Session Details for {{ $data->patientowner->patient_lname.', '.$data->patientowner->patient_fname }}</h6>            
                                <label>{{ date("F j, Y g:i a", strtotime($data->appointment_datetime)) }}</label>
                            </div>
                        </div>

                        {{-- START CARD = 1ST CAT VITAL SIGNS --}}
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Vital Signs</h6>            
                            </div>
                            <div class="card-body">
                                <div class="row g-4 mb-2">
                                    <div class="col-md-4">
                                        <label>
                                            Blood Pressure
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_bp }}" name="session_px_bp" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            Heart Rate
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_heartrate }}" name="session_px_heartrate" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            Temperature &lpar;in Celsius&rpar;
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_temperature }}" name="session_px_temperature" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-2">
                                    <div class="col-md-3">
                                        <label>
                                            Respiratory Rate
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_respiratoryrate }}" name="session_px_respiratoryrate" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>
                                            Oxygen Saturation
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_oxygensat }}" name="session_px_oxygensat" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>
                                            Height &lpar;in Centimenters&rpar;
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_height }}" name="session_px_height" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>
                                            Weight &lpar;in Kilograms&rpar;
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" value="{{ $session_data->session_px_weight }}" name="session_px_weight" placeholder="Enter Here"  style=""></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END CARD = 1ST CAT VITAL SIGNS --}}
                        
                        {{-- START CARD = 2ND CAT DRUGS TAKEN BEFORE VISIT --}}
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">Drugs Taken Before Visitation</h6>
                                <input type="hidden" value="0" name="col_parent_taken_row_count">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3">
                                        Date and Time Taken
                                    </label>
                                    <label class="col-md-3">
                                        Medication
                                    </label>     
                                    <label class="col-md-2">
                                        Dose
                                    </label>    
                                    <label class="col-md-3">
                                        Prescription Type
                                    </label>                               
                                </div>
                                <section id="parent_taken_section" class="p-2">
                                    @foreach ($prescription_before_data as $med_taken)
                                        <div class="parent_taken_item">
                                            <input type="hidden" value="{{ $med_taken->session_taken_id }}" name="session_taken_medid[]">
                                            <div class="row g-4 mb-2">
                                                <div class="col-md-3">
                                                    <div class="row g-4">
                                                        <div class="col-md-12">
                                                            <input type="date" class="form-control" value="{{ $med_taken->session_taken_meddate }}" name="session_taken_meddate[]" placeholder="Enter Here" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row g-4">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" value="{{ $med_taken->session_taken_medname }}" name="session_taken_medname[]" placeholder="Enter Here" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="row g-4">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" value="{{ $med_taken->session_taken_meddose }}" name="session_taken_meddose[]" placeholder="Enter Here" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row g-4">
                                                        <div class="col-md-12">
                                                            @php $session_taken_medcat = array("Self-Prescribed", "Doctor-Prescribed"); @endphp
                                                            <select class="form-control mb-1" name="session_taken_medcat[]">
                                                                @foreach ($session_taken_medcat as $st_medcat)
                                                                    <option value="{{ $st_medcat }}" {{ $st_medcat == $med_taken->session_taken_medcat ? 'selected' : '' }}>{{ $st_medcat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-md-1">
                                                    <div class="row g-4">
                                                        <div class="col-md-12 text-center">
                                                            <section class="delete-section d-flex align-items-center justify-content-center deco-none">
                                                                <a href="javascript:void(0)" class="btn btn-icon btn-danger parent_taken_delete py-2 px-3">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </a>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addParentTaken();"><i class="fa-solid fa-plus me-2"></i>Add New Entry</a>
                            </div>
                        </div>
                        {{-- END CARD = 2ND CAT DRUGS TAKEN BEFORE VISIT --}}

                        {{-- START CARD = 3RD CAT SESSION DETAILS --}}
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Appointment Details</h6>            
                            </div>
                            <div class="card-body">
                                <div class="row g-4 mb-2">
                                    <div class="col-md-12">
                                        <label>
                                            <b>Complaint</b>
                                        </label>
                                        <div>
                                            <textarea type="text" class="form-control" name="session_complaint" placeholder="Write something..."  style="height:100px" required>{{ $session_data->session_complaint }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-2">
                                    <div class="col-md-12">
                                        <label>
                                            <b>Findings</b>
                                        </label>
                                        <div>
                                            <textarea class="form-control" id="subject" name="session_findings" placeholder="Write something..." style="height:100px" required>{{ $session_data->session_findings }}</textarea>
                                        </div>                        
                                    </div>
                                </div>
                                <div class="row g-4 mb-2">
                                    <div class="col-md-12">
                                        <label>
                                            <b>Treatment</b>
                                        </label>
                                        <div>
                                            <textarea class="form-control" id="subject" name="session_treatment" placeholder="Write something..." style="height:100px" required>{{ $session_data->session_treatment }}</textarea>
                                        </div>                        
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label>
                                            <b>Order</b>
                                        </label>
                                        <input type="hidden" class="col-md-3" value={{ $data->appointment_id }} name="appointment_id"> 
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-md-4">
                                                    Medicine
                                                </label>
                                                <label class="col-md-3">
                                                    Dose
                                                </label>              
                                                <label class="col-md-4">
                                                    Frequency
                                                </label>                        
                                            </div>

                                            <section id="parent_med_section">
                                                @foreach ($prescription_order_data as $med_order)
                                                    <div class="parent_med_item">
                                                        <input type="hidden" value="{{ $med_order->session_order_id }}" name="session_order_medid[]">
                                                        <div class="row g-4 mb-2">
                                                            <div class="col-md-4">
                                                                <div class="row g-4">
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" value="{{ $med_order->session_order_medname }}" name="session_order_medname[]" placeholder="Enter Here" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row g-4">
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" value="{{ $med_order->session_order_meddose }}" name="session_order_meddose[]" placeholder="Enter Here" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row g-4">
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" value="{{ $med_order->session_order_medfreq }}" name="session_order_medfreq[]" placeholder="Enter Here" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="col-md-1">
                                                                <div class="row g-4">
                                                                    <div class="col-md-12 text-center">
                                                                        <section class="delete-section d-flex align-items-center justify-content-center deco-none">
                                                                            <a href="javascript:void(0)" class="btn btn-icon btn-danger parent_med_delete py-2 px-3">
                                                                                <i class="fa-solid fa-xmark"></i>
                                                                            </a>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </section>
                                            
                                            {{-- BUTTON TO ADD NEW PARENT --}}
                                            <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addParentMed();"><i class="fa-solid fa-plus me-2"></i>Add Prescription</a>
                                        </div>
                                    </div>                    
                                </div>
                            </div>
                        </div>
                        {{-- END CARD = 3RD CAT SESSION DETAILS --}}
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

// PANG CREATE NG PARENT DRUGS TAKEN BEFORE VISIT
var parentTakenRowCount = 0;
function addParentTaken() {
    parentTakenRowCount++;
    // add row count to hidden field
    $('input[name="col_parent_taken_row_count"]').val(parentTakenRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentTakenRow = '<div class="parent_taken_item">' +
        '<input type="hidden" name="session_taken_medid[]">' +
        '<div class="row g-4 mb-2">' +
            '<div class="col-md-3">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="date" class="form-control" name="session_taken_meddate[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="text" class="form-control" name="session_taken_medname[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="text" class="form-control" name="session_taken_meddose[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<select class="form-control mb-1" name="session_taken_medcat[]">' +
                            '<option value="Self-Prescribed">Self-Prescribed</option>' +
                            '<option value="Doctor-Prescribed">Doctor-Prescribed</option>' +
                        '</select>' +
                    '</div>' +
                '</div>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_taken_delete py-2 px-3">' +
                                '<i class="fa-solid fa-xmark"></i>' +
                            '</a>' +
                        '</section>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            // ITO YUNG END NG PANG DELETE NG SPECIFIC PARENT
        '</div>' +
    '</div>';

    // APPEND A NEW PARENT
    $("#parent_taken_section").append(parentTakenRow);
}

// PANG DELETE NG PARENT DRUGS TAKEN BEFORE VISIT
$("#form-canvas").on( "click", ".parent_taken_delete", function() {
    parentTakenRowCount--;
    $('input[name="col_parent_taken_row_count"]').val(parentTakenRowCount);
    $(this).closest(".parent_taken_item").remove();
});


// PANG CREATE NG PARENT MED PRESCRIPTION
var parentMedRowCount = 0;
function addParentMed() {
    parentMedRowCount++;
    // add row count to hidden field
    $('input[name="col_parent_med_row_count"]').val(parentMedRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentMedRow = '<div class="parent_med_item">' +
        '<input type="hidden" name="session_order_medid[]">' +
        '<div class="row g-4 mb-2">' +
            '<div class="col-md-4">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="text" class="form-control" name="session_order_medname[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="text" class="form-control" name="session_order_meddose[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-4">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<input type="text" class="form-control" name="session_order_medfreq[]" placeholder="Enter Here" required>' +
                    '</div>' +
                '</div>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_med_delete py-2 px-3">' +
                                '<i class="fa-solid fa-xmark"></i>' +
                            '</a>' +
                        '</section>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            // ITO YUNG END NG PANG DELETE NG SPECIFIC PARENT
        '</div>' +
    '</div>';

    // APPEND A NEW PARENT
    $("#parent_med_section").append(parentMedRow);
}

// PANG DELETE NG PARENT MED PRESCRIPTION
$("#form-canvas").on( "click", ".parent_med_delete", function() {
    parentMedRowCount--;
    $('input[name="col_parent_med_row_count"]').val(parentMedRowCount);
    $(this).closest(".parent_med_item").remove();
});

</script>
@endsection