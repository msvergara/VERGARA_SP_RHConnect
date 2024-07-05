@extends('layouts.dashboard', ['title' => "RHConnect / Dashboard"])
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid p-0">
    {{-- HEADINGS --}}
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">Dashboard</span></h2>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Greetings!</h6>
                </div>

                <div class="card-body">
                    <h2 class="fw-semi">
                        Hello, {{ ucfirst(Auth::user()->fname) }}!
                    </h2>
                    <p>Welcome to the new Electronic Medical Records System of Laur Rural Health Center! To start, we would like to inform you first that this system is continuously being updated and developed. If you encounter any problems, errors or bugs please report it through the <a target="_blank" href="#" class="text-blue-500">RHConnect Support GForm</a>.</p>
                    {{-- <p>This system is currently being created by a UPLB Student, Ms. Vergara for her Special Problem.</p> --}}
                </div>
            </div>

            <div class="mx-1.5 my-4" hidden>
                <div class=" mb-10 mt-10 bg-white overflow-hidden shadow sm:rounded-lg">
                <p class="__content-heading pt-2 px-3" style="font-size: 20px"><strong>ANNOUNCEMENT:</strong></p>
                    <ul class="list-disc">
                        <li>Click <a href="https://docs.google.com/document/d/1_wY5lAgCpYpR9cjbB5VJBPIM9EYZX8ua" class="text-blue-500">here to view the Live Online Registration Procedure</a>
                        </li>
                        <li>
                            Enrollment Eligibility, Appointments and Holds Data of AMIS will be updated by Jan 22. Check your SAIS for Holds in the meantime.
                        </li>
                        <li> <a href="https://1drv.ms/v/s!AifU0TEdePZdhX-wnoXADxW8MSbT" class="text-blue-500">Video Tutorial for COI application and approval</a> | <a href="https://1drv.ms/v/s!AifU0TEdePZdhWlinUZjmDj9g3Zp" class="text-blue-500">Faculty modules tutorial</a> | <a href="https://1drv.ms/v/s!AifU0TEdePZdhXcnx1qj6IkMnTwT" class="text-blue-500">Admin ocs, dep, classes mngt modules</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <form method="get" action="{{ route('dashboard', ['year' => date('Y')]) }}">
            <div class="col-md-6">
                <div class="year-section d-flex align-items-center justify-content-start">
                    <label class="w-15 mb-0">Filter by year</label>
                    <input type="text" class="form-control mx-3 w-70" name="analytics-year">
                    <button class="btn btn-default w-15">Filter</button>
                </div>
            </div>
        </form>
       
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="title w-70">
                        <h6 class="m-0 fw-bold">New Patient Admissions</h6>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart-new-patient"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="title w-70">
                        <h6 class="m-0 fw-bold">Number of Treatments Done</h6>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart-all-treatments"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Percentage of Patients Based on Gender</h6>
                </div>

                <div class="card-body">
                    <div id="chart-patient-sex"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Percentage of Patients Based on Barangay</h6>
                </div>

                <div class="card-body">
                    <div id="chart-patient-brgy"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
function sex_patient() {
    var allData = [];
    @foreach ($sc_data as $key => $s_data)
        allData.push({{ $s_data }})
    @endforeach
    return allData
}

var patient_sex_chart_options = {
        series: sex_patient(),
        chart: {
        type: 'donut',
    },
    labels: ["Male", "Female"],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var patient_brgy_chart_options = {
        series: [
            @foreach ($brgy_count as $key => $brgy)
                {{ $brgy }},
            @endforeach
        ],
        chart: {
        type: 'donut',
    },
    labels: [
        @foreach ($brgy_count as $key => $brgy)
            "{{ ucwords($key) }}",
        @endforeach
    ],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

function new_patient() {
  var allData = [];
    @foreach ($new_px_count as $key => $px_count)
        allData.push({{ $px_count }})
    @endforeach
  return allData
}

var patient_new_monthly_options = {
        series: [
            {
            name: "New Patient(s)",
            data: new_patient(),
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        }
};

function all_treatments() {
    var allData = [];
    @foreach ($treatment_count as $key => $t_count)
        allData.push({{ $t_count }})
    @endforeach
    return allData
}

var treatment_monthly_options = {
        series: [
            {
            name: "Treatment(s) Done",
            data: all_treatments(),
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        }
};


var patient_sex_chart = new ApexCharts(document.querySelector("#chart-patient-sex"), patient_sex_chart_options);
patient_sex_chart.render();

var patient_brgy_chart = new ApexCharts(document.querySelector("#chart-patient-brgy"), patient_brgy_chart_options);
patient_brgy_chart.render();

var patient_new_monthly_chart = new ApexCharts(document.querySelector("#chart-new-patient"), patient_new_monthly_options);
patient_new_monthly_chart.render();

var treatment_monthly_chart = new ApexCharts(document.querySelector("#chart-all-treatments"), treatment_monthly_options);
treatment_monthly_chart.render();

</script>
@endsection