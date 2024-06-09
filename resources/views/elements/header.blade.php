<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow d-flex justify-content-between align-items-center">
    {{-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between align-items-center"> --}}
        <!-- Navbar Brand-->
        <div class="navbar-brand-section ml-2 d-flex justify-content-between align-items-center">
            <a href="../"><img class="__main-logo" src="../source/img/logo.png" /></a>
            <div class="__navbar-text ps-3" style=" font-weight: bold;">RHCONNECT</div>
        </div>
        <div class="d-flex flex-row align-items-center">

            <div class="user-section text-light px-2">
                <span class="" type="submit">
                    <a class="__navbar-text" style="font-size:20px" href="#"><i class="fa-xl fa-solid fa-circle-user mr-3"></i>{{ ucfirst(Auth::user()->fname.' '.Auth::user()->lname) }}</a>
                </span>
            </div>
            <div class="topbar-divider d-none d-sm-block"></div>
            <a class="__navbar-text" style="font-size:15px" href="{{ route('signout') }}">
                <i class="fa-xl fa-solid fa-right-from-bracket px-2" title="Sign Out"></i>
            </a>
        </div>
    {{-- </nav> --}}
</nav>
<!-- End of Topbar -->