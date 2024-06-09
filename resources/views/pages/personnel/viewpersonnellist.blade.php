@extends('layouts.dashboard', ['title' => "RHConnect / Personnel"])
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
            <h2 class="fw-semi text-black-25">Personnel</h2>
        </div>

        <div class="button-section">
            <a href="{{ route("pages.personnel.createpersonnel") }}" class="btn btn-default me-2"><i class="fa-solid fa-plus me-2"></i>Create New</a>
            {{-- <a href="{{ route('pages.personnel.viewpersonnellist') }}" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a> --}}
        </div>
    </section>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="personnel-table">
                <table id="dataTable" class="table table-bordered"  width="100%" cellspacing="0">
                    <colgroup>
                        <col width="10%" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="__content-heading" style="text-align:center; font-size: 18px">List of Personnel</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($personneldata as $personnel)
                            <tr>
                                <td style="text-align:left">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-4">
                                            <h6 class="__content-heading m-0 font-weight-bold" style="font-size: 18px">{{ $personnel->lname.', '.$personnel->fname }}</h6>
                                        </div>
                                        <div class="d-sm-flex align-items-center justify-content-between card-body">
                                            <div class="d-flex-col">
                                                <div class="col">
                                                    <label class="pt-2">
                                                        Role: {{ $personnel->roles == 1 ? "Administrator" : "Healthcare Worker"}}
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="pt-2">
                                                        Email: {{ $personnel->email}}
                                                    </label>
                                                </div>
                                                <div class="col d-none">
                                                    <label class="pt-2">
                                                        Password: {{ $personnel->password}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="action-section d-flex flex-column">
                                                <input type="hidden" name="delete_id_value" value="{{ $personnel->id }}">
                                                <a href="/personnel/edit/{{ $personnel->id }}" class="btn btn-primary update mb-2">Update</a> 
                                                <a href="javascript:void(0);" data-id="{{ $personnel->id }}" class="btn btn-danger delete mb-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
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
    $('#dataTable').DataTable();
  });


  $(document).ready( function () {
    new DataTable('#personnel-table', {
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
        $(delete_modal).find(".modal-footer > .btn.proceed").attr("href", "/personnel/delete/" + id);
        $(delete_modal).modal('show');
    });
});

</script>
@endsection