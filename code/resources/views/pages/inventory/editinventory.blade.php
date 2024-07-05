@extends('layouts.dashboard',['title' => "RHConnect / Edit Inventory"])

<head>
    <title>RHConnect / Edit Inventory</title>
</head>

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

    <form method="POST" action="{{ url('inventory/update/'.$inventorydata->resource_id) }}" enctype ="multipart/form-data" autocomplete="off">
    @csrf
    {{-- @method('PUT') --}}

    <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
        <div class="title-section d-flex align-items-center">
            <h2 class="mb-0 text-gray-600"><a href="{{ route('pages.inventory.inventory') }}" class="link link-gray-100">Inventory</a> / <span class="fw-semi text-black-25">Edit {{ $inventorydata->resource_name }}</span></h2>
        </div>

        <div class="button-section ">
            <button type="submit" class="btn btn-default me-2"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
            <a href="{{ route('pages.inventory.inventory') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Cancel</a>
        </div>
    </section>

        {{-- RESOURCES INFORMATION --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Edit Entry</h6>
            </div>
            <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="pt-2">
                                Resource Name
                            </label>
                            <input type="text" class="form-control" value="{{ $inventorydata->resource_name }}" name="resource_name" placeholder="Enter Here" required>
                        </div>

                        <div class="col-md-6">
                            <label class="pt-2">
                                Choose Category
                            </label>
                            <select class="form-control mb-1" name="resource_category">
                                <option value="Medical Supplies" {{$inventorydata->resource_category == "Medical Supplies"  ? 'selected' : ''}}>Medical Supplies</option>
                                <option value="Medical Equipment" {{$inventorydata->resource_category == "Medical Equipment"  ? 'selected' : ''}}>Medical Equipment</option>
                                <option value="Cleaning and Sanitation Supplies" {{$inventorydata->resource_category == "Cleaning and Sanitation Supplies"  ? 'selected' : ''}}>Cleaning and Sanitation Supplies</option>
                                <option value="Office Supplies" {{$inventorydata->resource_category == "Office Supplies"  ? 'selected' : ''}}>Office Supplies</option>
                            </select>                         
                        </div>
                    </div>

                    <div class="row g-4 mb-2">
                        <div class="col-md-12">
                            <label>
                                Notes
                            </label>
                            <div class="">
                                <textarea class="form-control" id="subject" name="resource_notes" placeholder="Write something..." style="height:100px"><?php echo $inventorydata['resource_notes'] ?></textarea>
                            </div>                        
                        </div>
                    </div>
            </div>
        </div>

    </form>
</div>
<!-- End Page Content -->

@endsection

@section('scripts')

<script type = "text/javascript">


</script>

@endsection