<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $title }}</title>
    @include('elements.css')
    @include('elements.fonts')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="d-flex flex-column">
        
        @include('elements.header')

        <div class="d-flex flex-row">
            @include('elements.sidebar')
            <!-- Content Wrapper -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="content-wrapper" class="d-flex flex-column">
    
                            <!-- Main Content -->
                            <div id="content" class="p-4">
                
                                <div id="content">
                
                                    {{-- @include('elements.topbar'); --}}
                
                                    @yield('content')
                
                                </div>
                                
                            </div>
                            <!-- End of Main Content -->
                        
                            @include('elements.footer')
                
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Generic Modal --}}
        <div class="modal generic-modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="title">Confirmation</h5>
                    </div>
        
                    <div class="modal-body">
                        <div class="text-section">
                            <p class="m-0">This entry will now be <span class="status"></span>.</p>
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-default proceed" href=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('elements.js')
@yield('scripts')
</body>

</html>