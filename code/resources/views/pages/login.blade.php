@extends('layouts.login')
@section('content')
<div id="home-canvas">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card border-none mx-auto">
                    <div class="card-header d-none">
                        Welcome!
                    </div>
                    <div class="card-body d-flex flex-row p-0">
                        <section id="image-section" class="w-50">
                            <img src="{{ asset('source/img/login_bg.jpg') }}" alt="">
                        </section>
                        <section id="login-section" class="d-flex flex-column justify-content-center w-50 p-5">
                            <div class="text-center mb-4" style="font-size: 40px; color: #005c32">
                                <i class="fa fa-duotone fa-circle-nodes p-1" style="--fa-primary-color: #005c32; --fa-secondary-color: #005c32;"></i>RHConnect
                            </div>

                            <form class="user" method="POST" action="{{ route('login.userlogin') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-check ps-4 mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember">
                                    <label class="form-check-label">
                                        Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">
                                    Login
                                </button>
                            </form>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection