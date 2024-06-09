@extends('layouts.dashboard', ['title' => "RHConnect / Schedule"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    {{-- Modal --}}
<!-- Modal -->
<div class="modal generic-modal fade" id="event_modal" tabindex="-1" role="dialog" aria-labelledby="event_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="event_modal_title">{{-- patient name --}}</h5>
            </div>

            <div class="modal-body">
                <p><span id="event_modal_description"></span></p>
                <p>Date/Time: <span id="event_modal_date_time"></span></p>
                <p>Age: <span id="event_modal_age">to follow</span></p>
                <p>Sex: <span id="event_modal_sex">to follow</span></p>
            </div>

            <div class="modal-footer">
                <a href="javascript:void(0);" id="check-up" class="btn btn-default">Make Check Up Details</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>

    {{-- Message Prompt --}}
    <div class="message-fade">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }} fade show p-3">{{ Session::get('alert-' . $msg) }} <a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
    <!-- Page Heading -->
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">Schedules</span></h2>
        </div>

        <div class="button-section">
            <a href="{{ route('pages.admissions.view') }}" class="btn btn-default"><i class="fa-solid fa-bars me-2"></i>View All Admissions</a>
        </div>
    </section>

    <div class="align-items-center justify-content-between mb-4 d-none">
        <h1 class="__navbar-breadcrumb"><span><a href="#">SCHEDULE</a></span> / <b></b></h1>   
        
        <section class="button-section">
            <a href="{{ route('pages.admissions.view') }}" class="btn btn-default"><i class="fa-solid fa-plus me-2"></i>View All Admissions</a>
        </section>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div id='calendar' class="m-2"></div>
        </div>

    </div>
</div>
<!-- End Page Content -->
@endsection

@section('scripts')

<script type = "text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var calendar_element = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendar_element, {
            initialView: 'dayGridMonth',
            events: [
                @foreach ($data as $ap)
                    // $ap->patientowner->hcworker->id
                    @if ($ap->session_status < 1)
                        @if ($ap->patientowner->hcworker->id == Auth::user()->id)
                            {
                                appointment_id: '{{ $ap->appointment_id }}',
                                title: '{{ $ap->patientowner->patient_lname }}, {{ $ap->patientowner->patient_fname }} {{ mb_substr($ap->patientowner->patient_mname, 0, 1) }}.', // a property!
                                description: '{{ $ap->description }}',
                                age: '{{ $ap->patientowner->patient_birthday }}',
                                sex: '{{ ucfirst($ap->patientowner->patient_sex) }}',
                                start: '{{ $ap->appointment_datetime }}',
                                end: '{{ $ap->appointment_datetime }}'
                            },                        
                        @endif
                    @endif
                @endforeach
            ],

            // click function on events
            eventClick: function (info) {
                // use <extendedProps> for custom properties e.g. age, description, etc.
                var calendar_event_ap_id = info.event.extendedProps.appointment_id;
                var calendar_event_title = info.event.title;
                var calendar_event_description = info.event.extendedProps.description;
                var calendar_event_age = info.event.extendedProps.age;
                var calendar_event_sex = info.event.extendedProps.sex;
                var calendar_event_date_time = moment(info.event.start).format('MMMM D, YYYY - h:mm a');

                var event_modal = $('#event_modal');
                $(event_modal).find("#event_modal_title").text(calendar_event_title);
                $(event_modal).find("#event_modal_description").text(calendar_event_description);
                $(event_modal).find("#event_modal_age").text(get_age_dob(calendar_event_age));
                $(event_modal).find("#event_modal_sex").text(calendar_event_sex);
                $(event_modal).find("#event_modal_date_time").text(calendar_event_date_time);
                $(event_modal).find(".modal-footer > #check-up").attr("href", "/session/create/" + calendar_event_ap_id);
                $(event_modal).modal('show');

                return false;
            },

            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
                meridiem: 'short'
            }
        });
        
        calendar.render();

        function get_age_dob(bday) { 
            return moment().diff(bday, 'years');
        }
    });
</script>
@endsection