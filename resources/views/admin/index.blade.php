@extends('layouts.main_admin')
@section('content')
    <section id="hero">
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left" src="{{ asset('assets_admin/image/kartun2.webp') }}"
                                alt="Card image" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Assalamualaikum admin!!</h5>
                                <div class="card-text">
                                    <q>
                                        Semangat terus menghadirkan konten yang berkualitas, yang dapat menjadi sarana untuk
                                        mencetak generasi rabbani yang berakhlak Qur'ani dan cinta pada NKRI.
                                    </q>
                                    <hr>
                                    <p>
                                        Ini adalah halaman admin. Pastikan akun mu terlindungi dan menjaganya tetap aman.
                                    </p>
                                </div>
                                <p class="card-text"><small class="text-muted"><span id='ct5'></span></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="data-admin">
        <div class="row">
            <div class="col-lg-6 col-md-3 order-0 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class='bx bxs-city' style="color:rgb(117, 233, 117); font-size:2em;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Program Akademik</span>
                        <h3 class="card-title mb-2">{{ $totalProgram }} Program</h3>
                        <small class="text-success fw-semibold"><a href="{{ route('admin.program-akademik.index') }}">
                                Details <i class="fa-solid fa-angles-right"></i></a></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-3 order-0 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bxs-user" style="color:rgb(117, 233, 117); font-size:2em;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Santri</span>
                        <h3 class="card-title mb-2">{{ $totalSantri }} Santri</h3>
                        <small class="text-success fw-semibold"><a href="{{ route('admin.data-santri.index') }}"> Details <i
                                    class="fa-solid fa-angles-right"></i></a></small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function display_ct5() {
            var x = new Date()
            var ampm = x.getHours() >= 12 ? ' PM' : ' AM';

            var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
            x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds() + ":" + ampm;
            document.getElementById('ct5').innerHTML = x1;
            display_c5();
        }

        function display_c5() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct5()', refresh)
        }
        display_c5()
    </script>
    <!--/ Horizontal -->
@endsection
