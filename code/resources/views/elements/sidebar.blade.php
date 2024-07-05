<!-- Sidebar -->
{{-- <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar"> --}}
    
    <ul class=" navbar-nav sidebar __sidebar-bg accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                {{-- <i class="fas fa-laugh-wink"></i> --}}
            </div>
            <div class="__sidebar-heading">ELECTRONIC RECORDS</div>
        </a>
    
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
    
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="__sidebar-list __sidebar-text" href="{{ route("dashboard") }}">
                <i class="fa-solid fa-house mr-2"></i>
                <span>Dashboard</span></a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
            Personnel Section
        </div>
    
        <!-- Nav Item - Pages Collapse Menu -->
        @if (Auth::user()->roles != 2)
            <li class="nav-item">
                <a class="__sidebar-list __sidebar-text" href="{{ route("pages.personnel.viewpersonnellist") }}">
                    <i class="fa-solid fa-stethoscope mr-2"></i>
                    <span>Personnel</span></a>
            </li>
        @endif
        <li class="nav-item">
            <a class="__sidebar-list __sidebar-text" href="{{ route("pages.patient.viewpatientlist") }}">
                <i class="fa-solid fa-bed mr-2"></i>
                <span>Patients</span></a>
        </li>

        @if (Auth::user()->roles != 1)
            <li class="nav-item">
                <a class="__sidebar-list __sidebar-text" href="{{ route("pages.schedule.schedule") }}">
                    <i class="fa-regular fa-calendar mr-2"></i>
                    <span>Schedule</span></a>
            </li>
        @endif

        <li class="nav-item">
            <a class="__sidebar-list __sidebar-text" href="{{ route("pages.inventory.inventory") }}">
                <i class="fa-solid fa-warehouse mr-2"></i>
                <span>Inventory</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    
    
    </ul>
    <!-- End of Sidebar -->