@extends('layouts.dashboard', ['title' => "RHConnect / Inventory"])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid p-0">
    {{-- Inventory Transaction Modal --}}
    @foreach($inventories as $inventory)
        <div class="modal generic-modal fade" id="inventory-transaction-modal{{ $inventory->resource_id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="title">New Transaction</h5>
                    </div>
        
                    <div class="modal-body">
                        <form method="post" action="{{ route('pages.inventory.createtransaction', ['id' => $inventory->resource_id]) }}" enctype ="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-section">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Choose Category
                                        </label>
                                        @php $category = array(1 => "Used", 2 => "Lost", 3 => "Stocked Up", 4 => "Returned"); @endphp
                                        <select class="form-control mb-1" name="transaction_cat">
                                            @foreach ($category as $key => $value)
                                                <option value="{{ $key }}">{{ $value }} </option>
                                            @endforeach
                                        </select>                         
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            Current Stock
                                        </label>
                                        <input type="text" class="form-control" value="{{ $inventory->resource_stocks }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="pt-2">
                                            New Stock
                                        </label>
                                        <input type="number" class="form-control" value="0" name="transaction_qty" placeholder="Enter Here">
                                    </div>
                                </div>
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-default proceed">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

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
            <h2 class="mb-0 text-gray-600"><span class="fw-semi text-black-25">Inventory</span><span></span></h2>
        </div>
        <div class="col-md-4"> 
            <div class="button-section d-flex justify-content-between align-items-center mb-2">
                <a href="{{ route('pages.inventory.viewtransactions') }}" class="btn btn-default me-2"><i class="fa-solid fa-bars me-2"></i>View All Transactions</a>
                <a href="{{ route('pages.inventory.createinventory') }}" class="btn btn-default me-2"><i class="fa-solid fa-plus me-2"></i>Create New</a>
            </div>       
            <form method="get" action="{{ route('pages.inventory.inventory', ['year' => date('Y'), 'month' => date('m')]) }}">
                <div class="">
                    <div class="year-section d-flex align-items-center button-section col-md-12 justify-content-between p-0">
                        {{-- <label class="mb-0">Filter by year and month</label> --}}
                        <select class="btn btn-default me-4" name="analytics-month">
                            <option value=1>January</option>
                            <option value=2>February</option>
                            <option value=3>March</option>
                            <option value=4>April</option>
                            <option value=5>May</option>
                            <option value=6>June</option>
                            <option value=7>July</option>
                            <option value=8>August</option>
                            <option value=9>September</option>
                            <option value=10>October</option>
                            <option value=11>November</option>
                            <option value=12>December</option>
                        </select>
                        <input type="number" class="form-control me-4" name="analytics-year" placeholder="Enter Year" min="2000" required>
                        <button class="btn btn-default me-2">Filter</button>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Resources Usage</h6>
                </div>

                <div class="card-body">
                    <div id="chart-inventory"></div>
                </div>
            </div>    
        </div>
        <div class="col">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Resources Records</h6>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered generic-table w-100" id="patient-table" cellspacing="0">
                                        <colgroup>
                                            <col span="1" style="width: 40%;">
                                            <col span="1" style="width: 30%;">
                                            <col span="1" style="width: 30%;">
                                        </colgroup>
                                        {{-- text-center --}}
                                        <thead>
                                            <tr class="text-uppercase fw-bold">
                                                <th>Resource Name</th>
                                                <th>Stocks</th>
                                                <th>Used</th>
                                            </tr> 
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($inventories as $invent)
                                                <tr>
                                                    <td >{{ $invent->resource_name }}</td>
                                                    {{-- <td class="text-center">{{ $invent->resource_stocks }}</td> --}}
                                                        <?php
                                                        $used = 0;
                                                        $stock = 0;
                                                        ?>  
                                                        @foreach ($transactions as $inv_trans)
                                                                                                            
                                                            @if ($inv_trans->transactiontoinventory->resource_id == $invent->resource_id)

                                                                @if ($inv_trans->transaction_cat == 1 or $inv_trans->transaction_cat == 2 )
                                                                    <?php
                                                                    $used = $used + $inv_trans->transaction_qty
                                                                    ?>
                                                                @endif

                                                                @if ($inv_trans->transaction_cat == 3 or $inv_trans->transaction_cat == 4 )
                                                                    <?php
                                                                    $stock = $stock + $inv_trans->transaction_qty
                                                                    ?>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    <td class="text-center"> {{ $stock-$used }}</td>
                                                    <td class="text-center"> {{ $used }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            </div>                
                        </div>
                    </div>
                </div>    
            </div>

        </div>


        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card mb-2">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">View All</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="inventory-table" class="table table-bordered generic-table"  width="100%" cellspacing="0">
                            <colgroup>
                                <col width="15%" />
                                <col width="20%" />
                                <col width="20%" />
                                <col width="10%" />
                                <col width="20%" />
                                @if (Auth::user()->roles != 2)
                                    <col width="10%" />
                                @endif
                            </colgroup>
                            <thead>
                                <tr class="text-uppercase fw-bold">
                                    <th>Date</th>
                                    <th>Resource</th>
                                    <th>Category</th>
                                    <th>Stocks</th>
                                    <th>Notes</th>
                                    @if (Auth::user()->roles != 2)
                                        <th class="text-center">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ date('Y-m-d', strtotime($inventory->created_at)) }}</td>
                                        <td>{{ $inventory->resource_name }}</td>
                                        <td>{{ $inventory->resource_category }}</td>
                                        <td>{{ $inventory->resource_stocks }}</td>
                                        <td>{{ $inventory->resource_notes }}</td>
                                        @if (Auth::user()->roles != 2)
                                            <td>
                                                <div class="action-section d-flex flex-column">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#inventory-transaction-modal{{ $inventory->resource_id }}" class="btn btn-default mb-2">Transaction</a>
                                                    <a href="{{ route('pages.inventory.editinventory', ['id' => $inventory->resource_id]) }}" class="btn btn-primary update mb-2">Update</a> 
                                                    <a href="javascript:void(0);" data-id="{{ $inventory->resource_id }}" class="btn btn-danger delete mb-2">Delete</a>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>                
                                @endforeach
                            </tbody>
                        </table>
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
    new DataTable('#inventory-table', {
        scrollX: true,
        aaSorting: [],
        order: [0, 'desc'],
        'columnDefs': [{
            'targets': [0], // column index (start from 0)
            'orderable': true, // set orderable false for selected columns
        }]
    });

    var delete_modal = $('.modal.generic-modal#confirmation-modal');
    $('.delete').on('click', function() {
        var id = $(this).attr('data-id');
        $(delete_modal).find(".modal-body > .text-section p > .status").text("removed");
        $(delete_modal).find(".modal-footer > .btn.proceed").text("Remove");
        $(delete_modal).find(".modal-footer > .btn.proceed").attr("href", "/inventory/delete/" + id);
        $(delete_modal).modal('show');
    });
});

setTimeout(function() {
$(".alert").alert('close');
}, 2000);

function all_resources() {
  var allData = [];
        @foreach ($inventories as $inventory)
            allData.push("{{ $inventory->resource_name }}");
        @endforeach 
  return allData
}

function resource_used() {
  var allData = [];
    @foreach ($inventories as $invent)
        var trans = 0;
        @foreach ($transactions as $inv_trans)                                         
            @if ($inv_trans->transactiontoinventory->resource_id == $invent->resource_id)
                @if ($inv_trans->transaction_cat == 1 or $inv_trans->transaction_cat == 2 )
                    trans = trans + {{ $inv_trans->transaction_qty }}
                @endif
            @endif
        @endforeach
        allData.push(trans);
    @endforeach
  return allData
}

function resource_stocks() {

  var allData = [];
    @foreach ($inventories as $invent)
        var trans = 0;
        var used = 0;
        @foreach ($transactions as $inv_trans)                                         
            @if ($inv_trans->transactiontoinventory->resource_id == $invent->resource_id)
                @if ($inv_trans->transaction_cat == 3 or $inv_trans->transaction_cat == 4 )
                    trans = trans + {{ $inv_trans->transaction_qty }}
                @endif
                
                @if ($inv_trans->transaction_cat == 1 or $inv_trans->transaction_cat == 2 )
                    used = used + {{ $inv_trans->transaction_qty }}
                @endif
            @endif
        @endforeach
        trans = trans - used;
        allData.push(trans);
    @endforeach
  return allData
}

var inventory_chart_options = {
        series: [{
        name: 'USED',
        data: resource_used()
    }, {
        name: 'STOCKS LEFT',
        data: resource_stocks()
    }],
        chart: {
        type: 'bar',
        height: 350,
        stacked: true,
        toolbar: {
        show: true
        },
        zoom: {
        enabled: true
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
        legend: {
            position: 'bottom',
            offsetX: -10,
            offsetY: 0
        }
        }
    }],
    plotOptions: {
        bar: {
        horizontal: false,
        borderRadius: 10,
        borderRadiusApplication: 'end', // 'around', 'end'
        borderRadiusWhenStacked: 'last', // 'all', 'last'
        dataLabels: {
            total: {
            enabled: true,
            style: {
                fontSize: '13px',
                fontWeight: 900
            }
            }
        }
        },
    },
    xaxis: {
        categories: all_resources()
    },
    legend: {
        position: 'right',
        offsetY: 40
    },
    fill: {
        opacity: 1
    }
};

var inventory_chart = new ApexCharts(document.querySelector("#chart-inventory"), inventory_chart_options);
inventory_chart.render();
      

</script>
@endsection