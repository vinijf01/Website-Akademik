@extends('auth.layout')
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-3">
                            <img src="{{ asset('assets/img/logo/LogoABA.png') }}" alt="logo" width="30%">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-center">Website akademik<br>Pesantren Abdurrahman Bin Auf
                        </h4>
                        <p class="mb-4">&nbsp;</p>

                        <form class="mb-3" action="{{ route('admin.login.request') }}" method="POST">
                            @csrf
                            @include('partials.messages')
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Silahkan masukkan email anda" autofocus />
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                &nbsp;
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>

                        {{-- <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="/register">
                                <span>Register di sini!</span>
                            </a>
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
