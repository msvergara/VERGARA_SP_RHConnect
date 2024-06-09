@extends('layouts.dashboard', ['title' => "RHConnect / New Patient"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    <form method="POST" action="{{ route('pages.patient.createpatient') }}" enctype ="multipart/form-data" autocomplete="off">
        @csrf
        {{-- HEADINGS --}}
        <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
            <div class="title-section d-flex align-items-center">
                <h2 class="mb-0 text-gray-600"><a class="link link-gray-100" href="{{ route('pages.patient.viewpatientlist') }}">Patients</a> / <span class="fw-semi text-black-25">Create New Patient</span></h2>
            </div>

            <div class="button-section">
                <button type="submit" class="btn btn-default me-2"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                <a href="{{ route('pages.patient.viewpatientlist') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Cancel</a>
            </div>
        </section>

        {{-- LALAGYAN NG LAHAT INC SUBMIT, HEADER, ETC --}}
        <div id="form-canvas">
            <div class="container-fluid p-0">
                <div class="row g-4 mb-2">
                    <div class="col-xl-12">
                        {{-- START CARD = 1ST CAT DEMOGRAPHICS --}}
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">I. Demographic Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            First Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_fname" placeholder="Enter Here" >
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Middle Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_mname" placeholder="Enter Here">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Last Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_lname" placeholder="Enter Here" >
                                    </div>
                                    <div class="col-md-1">
                                        <label class="pt-2">
                                            Ext.
                                        </label>
                                        <input type="text" class="form-control" name="patient_extension" placeholder="Enter Here">
                                    </div>
                                </div>
                                <div class="row g-4 mb-2">
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Birthday
                                        </label>
                                        <input type="date" class="form-control" name="patient_birthday" placeholder="Enter Here" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Sex
                                        </label>
                                        <select class="form-control mb-1" name="patient_sex">
                                            @php $sex = array("male", "female"); @endphp
                                            @foreach ($sex as $s)
                                                <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                                            @endforeach
                                        </select>   
                                    </div>                      
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Blood Type
                                        </label>
                                        <select class="form-control mb-1" name="patient_bloodtype">
                                            @php $blood_type = array("n/a", "a+", "a-", "b+", "b-", "ab+", "ab-", "o+", "o-"); @endphp
                                            @foreach ($blood_type as $btype)
                                                <option value="{{ $btype == 'n/a' ? null : $btype }}">{{ strtoupper($btype) }}</option>
                                            @endforeach
                                        </select>                         
                                    </div>
                                </div>
                                <div class="row g-4 mb-2">
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Contact Number
                                        </label>
                                        <input type="text" class="form-control" name="patient_cpnum" placeholder="Enter Here" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Barangay
                                        </label>
                                        <select class="form-control mb-1" name="patient_barangay">
                                            @foreach ($barangay_list as $b_list)
                                                <option value="{{ $b_list->barangay_name }}">{{ $b_list->barangay_name }}</option>
                                            @endforeach
                                        </select>                         
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Street Name, Building, House No.
                                        </label>
                                        <input type="text" class="form-control" name="patient_street" placeholder="Enter Here">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END CARD = 1ST CAT  DEMOGRAPHICS --}}
                    </div>

                    <div class="col-xl-12">
                        {{-- START CARD = 2ND CAT EMERGENCY CONTACT --}}
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">II. Emergency Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            First Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_fname" placeholder="Enter Here" >
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Middle Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_mname" placeholder="Enter Here">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Last Name
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_lname" placeholder="Enter Here">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="pt-2">
                                            Ext.
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_extension" placeholder="Enter Here">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Contact Number
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_cpnum" placeholder="Enter Here">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Barangay
                                        </label>
                                        <select class="form-control mb-1" name="patient_ec_barangay">
                                            <option value="" hidden disabled selected>Select barangay...</option>
                                            @foreach ($barangay_list as $b_list)
                                                <option value="{{ $b_list->barangay_name }}">{{ $b_list->barangay_name }}</option>
                                            @endforeach
                                        </select>                         
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Street Name, Building, House No.
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_street" placeholder="Enter Here">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pt-2">
                                            Relationship to Patient
                                        </label>
                                        <input type="text" class="form-control" name="patient_ec_relationship" placeholder="Enter Here">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END CARD = 3RD CAT EMERGENCY CONTACT --}}
                    </div>
                        
                    <div class="col-xl-12">
                        {{-- START CARD = 3RD CAT HISTORY: ALLERGY --}}
                        <div class="card shadow">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">III. Patient Allergies</h6>
                                <input type="hidden" value="0" name="col_parent_allergy_row_count">
                            </div>
                            <div class="card-body">
                                <section id="parent_allergy_section" class="p-2">
                                    {{-- append allergy list here --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addParentAllergy();"><i class="fa-solid fa-plus me-2"></i>Add Allergy</a>
                            </div>
                        </div>
                        {{-- END CARD = 3RD CAT HISTORY: ALLERGY --}}
                    </div>

                    <div class="col-xl-12">
                        {{-- START CARD = 4TH CAT HISTORY: ILLNESS --}}
                        <div class="card shadow">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">IV. Illness / Injury History</h6>
                                <input type="hidden" value="0" name="col_parent_illness_row_count">
                            </div>
                            <div class="card-body">
                                
                                <section id="parent_illness_section" class="p-2">
                                    {{-- DITO ILALAGAY SI PARENT --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addParentIllness();"><i class="fa-solid fa-plus me-2"></i>Add Illness / Injury Entry</a>
                            </div>
                        </div>
                        {{-- END CARD = 4TH CAT HISTORY: ILLNESS --}}
                    </div>
                        
                    <div class="col-xl-12">
                        {{-- START CARD = 5TH CAT HISTORY: SURGERY --}}
                        <div class="card shadow">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">V. Surgery History</h6>
                                <input type="hidden" value="0" name="col_surg_row_count">
                            </div>
                            <div class="card-body">
                                <section id="surg_section" class="p-2">
                                    {{-- DITO ILALAGAY SI PARENT --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addSurgery();"><i class="fa-solid fa-plus me-2"></i>Add Surgery Entry</a>
                            </div>
                        </div>
                        {{-- END CARD = 5TH CAT HISTORY: SURGERY --}}
                    </div>
                        
                    <div class="col-xl-12">
                        {{-- START CARD = 6TH CAT HISTORY: OBGYN --}}
                        <div class="card shadow obgyn d-none">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">VI. Obstretic / Gynecology</h6>
                                <input type="hidden" value="0" name="col_obgyn_cond_row_count">
                            </div>
                            <div class="card-body">
                                <section id="obgyn_cond_section" class="p-2">
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Period Status</label>
                                            <select class="form-control mb-1" name="patient_period_status">
                                                <option value="N/A">N/A</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Irregular">Irregular</option>
                                                <option value="Menopause">Menopause</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" name="patient_period_status"> --}}
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Pregnancy Status</label>
                                            <select class="form-control mb-1" name="patient_preg_status">
                                                <option value="N/A">N/A</option>
                                                <option value="Pregnant">Pregnant</option>
                                                <option value="Not Pregnant">Not Pregnant</option>
                                                <option value="Intent to Become Pregnant">Intent to Become Pregnant</option>
                                                <option value="Unknown">Unknown</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" name="patient_preg_status"> --}}
                                        </div>
                                    </div>
                                    {{-- DITO ILALAGAY SI PARENT --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addObgynCondition();"><i class="fa-solid fa-plus me-2"></i>Add Condition</a>
                            </div>
                        </div>
                        {{-- END CARD = 6TH CAT HISTORY: OBGYN --}}
                    </div>
                        
                    <div class="col-xl-6">
                        {{-- START CARD = 7TH CAT HISTORY: ACTIVE MED --}}
                        <div class="card shadow active-med">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">VII. Active Medical Condition(s)</h6>
                                <input type="hidden" value="0" name="col_active_med_row_count">
                            </div>
                            <div class="card-body">
                                <section id="active_med_section" class="p-2">
                                    {{-- DITO ILALAGAY SI PARENT --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addActiveMedCondition();"><i class="fa-solid fa-plus me-2"></i>Add Condition</a>
                            </div>
                        </div>
                        {{-- END CARD = 6TH CAT HISTORY: ACTIVE MED --}}
                    </div>

                    <div class="col-xl-6">
                        {{-- START CARD = 8TH CAT HISTORY: IMMUNIZATION --}}
                        <div class="card shadow">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 fw-semi text-default __content-heading m-0 font-weight-bold" style="font-size: 20px">VIII. Immunization History</h6>
                                <input type="hidden" value="0" name="col_parent_immu_row_count">
                            </div>
                            <div class="card-body">
                                <section id="parent_immu_section" class="p-2">
                                    {{-- DITO ILALAGAY SI PARENT --}}
                                </section>
                                
                                {{-- BUTTON TO ADD NEW PARENT --}}
                                <a class="btn btn-default w-100" href="javascript:void(0)" onclick="addParentImmu();"><i class="fa-solid fa-plus me-2"></i>Add Immunization Entry</a>
                            </div>
                        </div>
                        {{-- END CARD = 8TH CAT HISTORY: IMMUNIZATION --}}
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
// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT ALLERGY
var parentAllergyRowCount = 0;
function addParentAllergy() {
    parentAllergyRowCount++;
    // add row count to hidden field
    $('input[name="col_parent_allergy_row_count"]').val(parentAllergyRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentAllergyRow = '<div class="parent_allergy_item">' +
        '<div class="row g-4 mb-2">' +
            '<div class="col-md-5">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<label>Allergen Type</label>' +
                        '<select class="form-control" name="patient_allergy_cat[]">' +
                            '<option value="Drug-Related">Drug-Related</option>' +
                            '<option value="Non Drug-Related">Non Drug-Related</option>' +
                        '</select> ' +   
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12">' +
                        '<label>Allergen</label>' +
                        '<input type="text" class="form-control" name="patient_allergy_name[]" placeholder="Enter Here" rows=2></input>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<label class="mb-1" style="opacity: 0;">Actions</label>' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_allergy_delete py-2 px-3">' +
                                '<i class="fa-solid fa-xmark"></i>' +
                            '</a>' +
                        '</section>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';

    // APPEND A NEW PARENT
    $("#parent_allergy_section").append(parentAllergyRow);
}

// PANG DELETE NG PARENT ALLERGY
$("#form-canvas").on( "click", ".parent_allergy_delete", function() {
    parentAllergyRowCount--;
    $('input[name="col_parent_allergy_row_count"]').val(parentAllergyRowCount);
    $(this).closest(".parent_allergy_item").remove();
});

// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT ILLNESS
var parentIllnessRowCount = 0;
function addParentIllness() {
    parentIllnessRowCount++;
    // add row count to hidden field
    $('input[name="col_parent_illness_row_count"]').val(parentIllnessRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentIllnessRow = '<div class="parent_illness_item">' +
        '<div class="row g-4 mb-4">' +
            
            '<div class="col-md-11">' + // ITO LAHAT NG CONTENT
                '<div class="row g-4">' +
                    '<div class="col-md-5">' +
                        '<label class="">' +
                            'Date' +
                        '</label>' +
                        '<input type="date" class="form-control" name="patient_ill_date[]" placeholder="Enter Here" >' +
                    '</div>' +
                    '<div class="col-md-7">' +
                       ' <label class="">' +
                            'Illness / Injury' +
                        '</label>' +
                        '<input type="text" class="form-control" name="patient_ill_name[]" placeholder="Enter Here">' +
                    '</div>' +
                    '<div class="col-md-12">' +
                        '<label class="">' +
                           ' Signs and Symptoms' +
                       ' </label>' +
                        '<textarea type="text" class="form-control" name="patient_ill_ssx[]" placeholder="Enter Here" rows=4 ></textarea>' +
                    '</div>' +
                    // ITO YUNG MISMONG LALAGYAN NG CHILD
                    '<section id="child_ill_med_section">' +
                        '<input type="hidden" class="col_child_ill_med_row_count" value="0" name="col_child_ill_med_row_count[]">' +
                        '<input type="hidden" value="'+ parentIllnessRowCount +'" name="child_ill_med_id">' +
                    '</section>' +
                    // ITO YUNG BUTTON PANG ADD NG ANOTHER CHILD
                    '<div class="col-md-12 m-0">' +
                        '<div class="row">' +
                            '<div class="col-md-12">' +
                                '<a class="btn btn-default child_ill_med_create" href="javascript:void(0)"><i class="fa-solid fa-plus me-2"></i>Add Medicine Prescribed</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<hr/>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_illness_delete py-2 px-3">' +
                                '<i class="fa-solid fa-xmark"></i>' +
                            '</a>' +
                        '</section>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';

    // APPEND A NEW PARENT
    $("#parent_illness_section").append(parentIllnessRow);
}

// PANG CREATE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_ill_med_create", function() {
    // add row count to hidden field
    $(this).closest('.parent_illness_item').find('.col_child_ill_med_row_count').val(($(this).closest('.parent_illness_item').find('.child_ill_med_item').length) + 1);
    var child_Ill_Med_ID = $(this).closest('.parent_illness_item').find('input[name="child_ill_med_id"]').val();

    // ITO YUN IAAPPEND SA child_ill_med_section, yung closest sa 
    $(this).closest(".parent_illness_item").find("#child_ill_med_section").append(`
        <div class="child_ill_med_item">
            <div class="row g-4 mb-2">

                <div class="col-md-5">
                    <input type="text" class="form-control" name="patient_medname_`+ child_Ill_Med_ID +`[]" placeholder="Medication Name"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_meddose_`+ child_Ill_Med_ID +`[]" placeholder="Dose"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_medfreq_`+ child_Ill_Med_ID +`[]" placeholder="Frequency"/>
                </div>

                <div class="col-md-1">
                    <div class="row g-4">
                        <div class="col-md-12 text-center">
                            <section class="delete-section d-flex align-items-center justify-content-center deco-none">
                                <a href="javascript:void(0)" class="btn btn-icon btn-danger child_ill_med_delete py-2 px-3">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);
});


// PANG DELETE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_ill_med_delete", function() {
    $(this).closest('.parent_illness_item').find('.col_child_ill_med_row_count').val(($(this).closest('.parent_illness_item').find('.child_ill_med_item').length) - 1);
    $(this).closest(".child_ill_med_item").remove();
});


// PANG DELETE NG PARENT ILLNESS
$("#form-canvas").on( "click", ".parent_illness_delete", function() {
    parentIllnessRowCount--;
    $('input[name="col_parent_illness_row_count"]').val(parentIllnessRowCount);
    $(this).closest(".parent_illness_item").remove();
});

// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT SURGERY
var parentSurgRowCount = 0;
function addSurgery() {
    parentSurgRowCount++;
    // add row count to hidden field
    $('input[name="col_surg_row_count"]').val(parentSurgRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentSurgRow = '<div class="parent_surg_item">' +
        '<div class="row g-4 mb-4">' +

            '<div class="col-md-11">' +
                '<div class="row g-4">' +
                    // DITO KA MAGIINSERT
                    '<div class="col-md-5">' +
                        '<label class="">' +
                            'Date' +
                        '</label>' +
                        '<input type="date" class="form-control" name="patient_surg_date[]" placeholder="Enter Here" >' +
                    '</div>' +
                    '<div class="col-md-7">' +
                        '<label class="">' +
                            'Type of Surgery' +
                        '</label>' +
                        '<input type="text" class="form-control" name="patient_surg_name[]" placeholder="Enter Here">' +
                    '</div>' +
                    '<div class="col-md-12">' +
                        '<label class="">' +
                            'Complications' +
                        '</label>' +
                        '<textarea type="text" class="form-control" name="patient_surg_comp[]" placeholder="Enter Here" rows=4 ></textarea>' +
                    '</div>' +
                    //END NG PAG IINSERT-AN MO
                '</div>' +
                '<hr/>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_surg_delete py-2 px-3">' +
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
    $("#surg_section").append(parentSurgRow);
}

// PANG DELETE NG PARENT
$("#form-canvas").on( "click", ".parent_surg_delete", function() {
    parentSurgRowCount--;
    $('input[name="col_surg_row_count"]').val(parentSurgRowCount);
    $(this).closest(".parent_surg_item").remove();
});

// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT OBGYN
// hide obgyn card if male
var obgyn_card = $(".card.obgyn");
$('select[name="patient_sex"]').on('change', function() {
    var sex = $(this).val();
    if (sex === 'male') {
        obgyn_card.addClass("d-none");
    } else {
        obgyn_card.removeClass("d-none");
    }
});

var parentObgynRowCount = 0;
function addObgynCondition() {
    parentObgynRowCount++;
    // add row count to hidden field
    $('input[name="col_obgyn_cond_row_count"]').val(parentObgynRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentObgynCondRow = '<div class="parent_obgyn_cond_item">' +
        '<div class="row g-4 mb-4">' +
            '<label class="mb-0">' +
                'Condition' +
            '</label>' +
            '<div class="col-md-11">' +
                '<div class="row g-4">' +
                    // DITO KA MAGIINSERT
                    '<div class="col-md-12 my-2">' +
                        '<input type="text" class="form-control" name="patient_obgyn_cond_name[]" placeholder="Enter Here">' +
                    '</div>' +
                    // ITO YUNG MISMONG LALAGYAN NG CHILD
                    '<section id="child_obgyn_med_section">' +
                        '<input type="hidden" class="col_child_obgyn_med_row_count" value="0" name="col_child_obgyn_med_row_count[]">' +
                        '<input type="hidden" value="'+ parentObgynRowCount +'" name="child_obgyn_med_id">' +
                    '</section>' +
                    // ITO YUNG BUTTON PANG ADD NG ANOTHER CHILD
                    '<div class="col-md-12 m-0">' +
                        '<div class="row">' +
                            '<div class="col-md-12">' +
                                '<a class="btn btn-default child_obgyn_med_create" href="javascript:void(0)"><i class="fa-solid fa-plus me-2"></i>Add Medicine Prescribed</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    //END NG PAG IINSERT-AN MO
                    '<hr/>' +
                '</div>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1 m-0">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center m-0 mb-2">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_obgyn_cond_delete py-2 px-3">' +
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
    $("#obgyn_cond_section").append(parentObgynCondRow);
}

// PANG CREATE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_obgyn_med_create", function() {
    // add row count to hidden field
    $(this).closest('.parent_obgyn_cond_item').find('.col_child_obgyn_med_row_count').val(($(this).closest('.parent_obgyn_cond_item').find('.child_obgyn_med_item').length) + 1);
    var child_obgyn_cond_med = $(this).closest('.parent_obgyn_cond_item').find('input[name="child_obgyn_med_id"]').val();

    $(this).closest(".parent_obgyn_cond_item").find("#child_obgyn_med_section").append(`
        <div class="child_obgyn_med_item">
            <div class="row g-4 mb-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="patient_obgyn_medname_`+ child_obgyn_cond_med +`[]" placeholder="Medication Name"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_obgyn_meddose_`+ child_obgyn_cond_med +`[]" placeholder="Dose"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_obgyn_medfreq_`+ child_obgyn_cond_med +`[]" placeholder="Frequency"/>
                </div>

                <div class="col-md-1">
                    <div class="row g-4">
                        <div class="col-md-12 text-center">
                            <section class="delete-section d-flex align-items-center justify-content-center deco-none">
                                <a href="javascript:void(0)" class="btn btn-icon btn-danger child_obgyn_med_delete py-2 px-3">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);
});

// PANG DELETE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_obgyn_med_delete", function() {
    $(this).closest('.parent_obgyn_cond_item').find('.col_child_obgyn_med_row_count').val(($(this).closest('.parent_obgyn_cond_item').find('.child_obgyn_med_item').length) - 1);
    $(this).closest(".child_obgyn_med_item").remove();
});

// PANG DELETE NG PARENT
$("#form-canvas").on( "click", ".parent_obgyn_cond_delete", function() {
    parentObgynRowCount--;
    $('input[name="col_obgyn_cond_row_count"]').val(parentObgynRowCount);
    $(this).closest(".parent_obgyn_cond_item").remove();
});

// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT ACTIVE MEDICATION
var parentActiveMedRowCount = 0;
function addActiveMedCondition() {
    parentActiveMedRowCount++;
    // add row count to hidden field
    $('input[name="col_active_med_row_count"]').val(parentActiveMedRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentActiveMedRow = '<div class="parent_active_med_item">' +
        '<div class="row g-4 mb-4">' +
            '<label class="mb-0">' +
                'Condition' +
            '</label>' +
            '<div class="col-md-11">' +
                '<div class="row g-4">' +
                    // DITO KA MAGIINSERT
                    '<div class="col-md-12 my-2">' +
                        '<input type="text" class="form-control" name="patient_active_med_name[]" placeholder="Enter Here">' +
                    '</div>' +
                    // ITO YUNG MISMONG LALAGYAN NG CHILD
                    '<section id="child_active_med_section">' +
                        '<input type="hidden" class="col_child_active_med_row_count" value="0" name="col_child_active_med_row_count[]">' +
                        '<input type="hidden" value="'+ parentActiveMedRowCount +'" name="child_active_med_id">' +
                    '</section>' +
                    // ITO YUNG BUTTON PANG ADD NG ANOTHER CHILD
                    '<div class="col-md-12 m-0">' +
                        '<div class="row">' +
                            '<div class="col-md-12">' +
                                '<a class="btn btn-default child_active_med_create" href="javascript:void(0)"><i class="fa-solid fa-plus me-2"></i>Add Medicine Prescribed</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    //END NG PAG IINSERT-AN MO
                    '<hr/>' +
                '</div>' +
            '</div>' +

            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1 m-0">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center m-0 mb-2">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_active_med_delete py-2 px-3">' +
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
    $("#active_med_section").append(parentActiveMedRow);
}

// PANG CREATE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_active_med_create", function() {
    // add row count to hidden field
    $(this).closest('.parent_active_med_item').find('.col_child_active_med_row_count').val(($(this).closest('.parent_active_med_item').find('.child_active_med_item').length) + 1);
    var child_active_med_med = $(this).closest('.parent_active_med_item').find('input[name="child_active_med_id"]').val();

    $(this).closest(".parent_active_med_item").find("#child_active_med_section").append(`
        <div class="child_active_med_item">
            <div class="row g-4 mb-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="patient_active_med_medname_`+ child_active_med_med +`[]" placeholder="Medication Name"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_active_med_meddose_`+ child_active_med_med +`[]" placeholder="Dose"/>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_active_med_medfreq_`+ child_active_med_med +`[]" placeholder="Frequency"/>
                </div>

                <div class="col-md-1">
                    <div class="row g-4">
                        <div class="col-md-12 text-center">
                            <section class="delete-section d-flex align-items-center justify-content-center deco-none">
                                <a href="javascript:void(0)" class="btn btn-icon btn-danger child_active_med_delete py-2 px-3">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);
});

// PANG DELETE NG CHILD MEDICATION PRESCRIBED
$("#form-canvas").on( "click", ".child_active_med_delete", function() {
    $(this).closest('.parent_active_med_item').find('.col_child_active_med_row_count').val(($(this).closest('.parent_active_med_item').find('.child_active_med_item').length) - 1);
    $(this).closest(".child_active_med_item").remove();
});

// PANG DELETE NG PARENT
$("#form-canvas").on( "click", ".parent_active_med_delete", function() {
    parentActiveMedRowCount--;
    $('input[name="col_active_med_row_count"]').val(parentActiveMedRowCount);
    $(this).closest(".parent_active_med_item").remove();
});

// __________________________________________________________________________________________________________________________________________
// PANG CREATE NG PARENT IMMUNIZATION
var parentImmuRowCount = 0;
function addParentImmu() {
    parentImmuRowCount++;
    // add row count to hidden field
    $('input[name="col_parent_immu_row_count"]').val(parentImmuRowCount);

    // ITO YUNG CONTENT NG PARENT MISMO
    var parentImmuRow = '<div class="parent_immu_item">' +
        '<div class="row g-4 mb-2">' +
            '<div class="col-md-11">' + // ITO LAHAT NG CONTENT
                '<div class="row g-4">' +
                    '<div class="col-md-4">' +
                        '<label class="">' +
                            'Date Administered' +
                        '</label>' +
                        '<input type="date" class="form-control" name="patient_immu_date[]" placeholder="Enter Here" >' +
                    '</div>' +
                    '<div class="col-md-4">' +
                       ' <label class="">' +
                            'Immunization' +
                        '</label>' +
                        '<input type="text" class="form-control" name="patient_immu_name[]" placeholder="Enter Here">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                       ' <label class="">' +
                            'Dose Category' +
                        '</label>' +
                        '<select class="form-control mb-1" name="patient_immu_cat[]">' +
                            '<option value="1st Dose">1st Dose</option>' +
                            '<option value="2nd Dose">2nd Dose</option>' +
                            '<option value="3rd Dose">3rd Dose</option>' +
                            '<option value="Booster 1">Booster 1</option>' +
                            '<option value="Booster 2">Booster 2</option>' +
                            '<option value="Booster 3">Booster 3</option>' +
                        '</select> '    +                 
                        '</div>' +
                    '<div class="col-md-12">' +
                        '<label class="">' +
                           'Untoward Reaction' +
                       ' </label>' +
                        '<textarea type="text" class="form-control" name="patient_immu_reax[]" placeholder="Enter Here" rows=4 ></textarea>' +
                    '</div>' +
                '</div>' +
                '<hr/>' +
            '</div>' +
            // ITO YUNG PANG DELETE NG SPECIFIC PARENT
            '<div class="col-md-1">' +
                '<div class="row g-4">' +
                    '<div class="col-md-12 text-center">' +
                        '<section class="delete-section d-flex align-items-center justify-content-center deco-none">' +
                            '<a href="javascript:void(0)" class="btn btn-icon btn-danger parent_immu_delete py-2 px-3">' +
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
    $("#parent_immu_section").append(parentImmuRow);
}

// PANG DELETE NG PARENT IMMUNIZATION
$("#form-canvas").on( "click", ".parent_immu_delete", function() {
    parentImmuRowCount--;
    $('input[name="col_parent_immu_row_count"]').val(parentImmuRowCount);
    $(this).closest(".parent_immu_item").remove();
});

</script>
@endsection