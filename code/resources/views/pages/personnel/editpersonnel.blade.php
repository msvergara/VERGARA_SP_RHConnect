@extends('layouts.dashboard', ['title' => "RHConnect / Personnel / Edit Personnel"])
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
    
    <form method="POST" action="{{ url('personnel/update/'.$personneldata->id) }}" enctype ="multipart/form-data" autocomplete="off">
        @csrf

        <section class="breadcrumb-canvas d-flex justify-content-between align-items-center mb-4">
            <div class="title-section d-flex align-items-center">
                <h2 class="mb-0 text-gray-600"> <a class="link link-gray-100" href="{{ route('pages.personnel.viewpersonnellist') }}">Personnel</a> / <span class="fw-semi text-black-25">Edit {{ $personneldata->lname }}</span></h2>
            </div>

            <div class="button-section">
                <button type="submit" class="btn btn-default me-2"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                <a href="{{ route('pages.personnel.viewpersonnellist') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Cancel</a>
            </div>
        </section>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 20px">Edit Personnel</h6>
            </div>
            <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="pt-2">
                                First Name
                            </label>
                            <input type="text" class="form-control" value="{{ $personneldata->fname }}" name="fname" placeholder="Enter Here" required>
                        </div>
                        <div class="col-md-6">
                            <label class="pt-2">
                                Last Name
                            </label>
                            <input type="text" class="form-control" value="{{ $personneldata->lname }}" name="lname" placeholder="Enter Here" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7">
                            <label class="pt-2">
                                Email
                            </label>
                            <input type="email" class="form-control" value="{{ $personneldata->email }}" name="email" placeholder="Enter Here" required>
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