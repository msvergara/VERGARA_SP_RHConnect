@extends('layouts.dashboard', ['title' => "RHConnect / Inventory > Transactions"])
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
    
    <!-- Page Heading -->
    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><a href="{{ route('pages.inventory.inventory') }}" class="link link-gray-100">Inventory</a> / <span class="fw-semi text-black-25">Transactions</span></h2>
        </div>

        <div class="button-section d-none">
            <a href="{{ route('pages.inventory.createinventory') }}" class="btn btn-default me-2"><i class="fa-solid fa-bars me-2"></i>View All Transactions</a>
            <a href="{{ route('pages.inventory.createinventory') }}" class="btn btn-default me-2"><i class="fa-solid fa-plus me-2"></i>Create New</a>
        </div>
        <div class="button-section">
            <a href="{{ route('pages.inventory.inventory') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
        </div>
    </section>

    <!-- DataTales Example -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="m-0 fw-bold">View All</h6>
        </div>

        {{-- {{ dd($data) }} --}}

        <div class="card-body">
            <div class="table-responsive">
                <table id="transaction-table" class="table table-bordered generic-table"  width="100%" cellspacing="0">
                    <colgroup>
                        <col width="25%" />
                        <col width="35%" />
                        <col width="30%" />
                        <col width="10%" />
                    </colgroup>
                    <thead>
                        <tr class="text-uppercase fw-bold">
                            <th>Transaction Date</th>
                            <th>Resource</th>
                            <th>Category</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $transaction)
                            <tr>
                                <td>{{ date('Y-m-d H:i:s a', strtotime($transaction->created_at)) }}</td>
                                <td>{{ $transaction->transactiontoinventory->resource_name }}</td>
                                <td>{{ $transaction->transactiontoinventory->resource_category }}</td>
                                <td>{{ $transaction->transaction_qty }}</td>
                            </tr>              
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('scripts')

<script type = "text/javascript">

  $(document).ready( function () {
    new DataTable('#transaction-table', {
        scrollX: true,
        aaSorting: [],
        order: [0, 'desc'],
        'columnDefs': [{
            'targets': [0], // column index (start from 0)
            'orderable': true, // set orderable false for selected columns
        }]
    });
  });

    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
</script>
@endsection