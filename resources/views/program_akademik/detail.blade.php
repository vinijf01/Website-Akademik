@extends('layouts.main')
@section('content')
    <style>
        .bd-contact-info-icon i {
            color: white;
            /* Mengatur warna ikon menjadi putih */
        }
    </style>
    <section class="bd-program-details-widget pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12 mb-50">
                    <div class="bd-program-details-slider p-relative wow fadeInLeft" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <div class="bd-program-details-active swiper-container">
                            <div class="swiper-wrapper">
                                @if ($foto_kegiatan->isEmpty())
                                    <!-- Jika koleksi kosong, tampilkan gambar default -->
                                    <div class="bd-program-details-slider-thumb">
                                        <img src="{{ url('assets/img/no-image.jpg') }}" alt="img not found!">
                                    </div>
                                @else
                                    @foreach ($foto_kegiatan as $item)
                                        <div class="swiper-slide">
                                            <div class="bd-program-details-slider-thumb">
                                                <img src="{{ url('assets/img/program/' . $item->foto) }}"
                                                    alt="img not found!">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <!-- program details slider navigation  -->
                        <div class="bd-program-details-navigation mb-15 d-none d-sm-flex">
                            <button class="bd-program-details-next">
                                <i class="fa-regular fa-angle-right"></i>
                            </button>
                            <button class="bd-program-details-prev">
                                <i class="fa-regular fa-angle-left"></i>
                            </button>
                        </div>
                        <div class="panel wow"></div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mb-50">
                    <div class="bd-program-details-widget-content theme-bg-6 wow fadeInRight" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <h3 class="bd-program-details-widget-title mb-20">{{ $program_akademik->nama_program }}</h3>
                        <p class="mb-25">{!! $program_akademik->deskripsi !!}</p>
                        <div class="bd-program-details-author-wrapper mt-35">
                            <div class="bd-program-details-author">
                                <div class="bd-program-details-author-thumb"><img
                                        src="{{ asset('assets/img/ketua_program/' . $ketua_program->profil) }}"
                                        alt="img not found!"></div>
                                <div class="bd-program-details-author-name">
                                    <span>Kepala Sekolah</span>
                                    <h5 style="font-size: 18px">{{ $ketua_program->nama }}</h5>
                                </div>
                            </div>
                            <div class="bd-program-details-cat">
                                <span>Kategori</span>
                                <h5 style="font-size: 18px">{{ $program_akademik->kategori }}</h5>
                            </div>
                            <div class="bd-program-details-cat">
                                <span>Per/Bulan</span>
                                <h5>Rp.{{ number_format($program_akademik->spp, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- program details slider area end here  -->

    <!--Deskripsi class area start here -->
    <section class="bd-shop-cat-area pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="bd-contact-info-wrap mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="bd-contact-info">
                            <div class="bd-contact-info-content">
                                <div class="bd-contact-info-icon cat-1">
                                    <a> <i class="flaticon-user-3"></i></a>
                                </div>
                                <h6>Santriwan / wati</h6>
                                <span>Dipisah</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="bd-contact-info-wrap mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="bd-contact-info">
                            <div class="bd-contact-info-content">
                                <div class="bd-contact-info-icon cat-2">
                                    <a> <i class="flaticon-calendar"></i></a>
                                </div>
                                <h6>6 hari/</h6>
                                <span>Minggu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="bd-contact-info-wrap mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="bd-contact-info">
                            <div class="bd-contact-info-content">
                                <div class="bd-contact-info-icon cat-1">
                                    <a> <i class="flaticon-clock-1"></i></a>
                                </div>
                                <h6>8 JP/<h6>
                                        <span>Hari</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="bd-contact-info-wrap mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="bd-contact-info">
                            <div class="bd-contact-info-content">
                                <div class="bd-contact-info-icon cat-3">
                                    <a> <i class="flaticon-class"></i></a>
                                </div>
                                <h6>Ukuran Kelas Max</h6>
                                <span>24 Santri</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- Ddeskripsi class area end here-->

    <!-- program details area start here  -->
    <section class="bd-program-details-widget pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-50">
                    <div class="bd-program-details-widget-content theme-bg-6 wow fadeInLeft" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <h3 class="bd-program-details-widget-title mb-20">{{ $ket_class->judul_1 }}</h3>
                        <p class="mb-25">{!! $ket_class->deskripsi_judul_1 !!}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- program details area end here  -->

    <!-- program routine area start here  -->
    <section class="bd-routine-area pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bd-section-title-wrapper text-center mb-55 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".2s">
                        <h2 class="bd-section-title mb-0">Jadwal Kegiatan Harian</h2>
                        <p>Jadwal kegiatan harian ini disusun untuk memberikan pendidikan dan pembinaan yang optimal kepada
                            para santri.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $halfCount = ceil(count($jadwal_harian) / 2);
                @endphp

                <div class="col-lg-6">
                    <div class="bd-routine-table mb-50 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal_harian as $index => $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->jam }}</td>
                                        <td>{{ $jadwal->kegiatan }}</td>
                                    </tr>
                                    <!-- Tambahkan baris sesuai dengan struktur data Anda -->
                                    @if ($index == $halfCount - 2 && $index != count($jadwal_harian) - 1)
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bd-routine-table mb-50 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- program routine area end here  -->

    <!-- program details area start here  -->
    <section class="bd-program-details-widget pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-50">
                    <div class="bd-program-details-slider p-relative wow fadeInLeft" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <div class="bd-program-details-slider-thumb p-relative">
                            <img src="{{ url('assets/img/program/' . $ket_class->image) }}" alt="img not found!">
                            <div class="panel wow"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-50">
                    <div class="bd-program-details-widget-content theme-bg-6 wow fadeInRight" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <h3 class="bd-program-details-widget-title mb-20">{{ $ket_class->judul_2 }}</h3>
                        <p class="mb-25">{!! $ket_class->deskripsi_judul_2 !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- program details area end here  -->


    <!-- program area start here  -->
    <section class="bd-program-area pt-120 pb-120">
        <div class="container">
            <div class="bd-program-top mb-40">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="bd-section-title-wrapper mb-0 wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay=".3s">
                            <h2 class="bd-section-title mb-0">Program Akdemik Lainnya</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bd-swiper-navigation mb-15 wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay=".3s">
                            <button class="bd-program-prev">
                                <i></i><i class="fa-regular fa-angle-left"></i>
                            </button>
                            <button class="bd-program-next">
                                <i class="fa-regular fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bd-program-active swiper-container wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <div class="swiper-wrapper">
                            @foreach ($all_program as $item)
                                @if ($item->id !== $program_akademik->id)
                                    <div class="swiper-slide">
                                        <div class="bd-program clr-{{ ($loop->iteration % 3) + 4 }} mb-5">
                                            <div class="bd-program-thumb-wrapper">
                                                <a href="{{ route('program-akademik', $item->id) }}">
                                                    <div class="bd-program-thumb">
                                                        <img src="{{ asset('assets/img/logo/' . $item->logo) }}"
                                                            alt="Image not found">
                                                    </div>
                                                </a>
                                                <div class="bd-program-shape">

                                                    <svg width="97" height="61" viewBox="0 0 97 61"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M64.6716 54.1604C66.9487 53.8135 68.0029 53.176 70.1655 51.8716C72.687 50.3497 74.6533 48.7547 76.851 46.7751C81.5182 42.5716 85.6125 37.7759 88.3885 32.1351C89.3558 30.1686 90.1276 27.6273 90.1313 25.5758C90.1315 25.3005 90.1117 25.0277 90.0918 24.7549C90.0265 23.8818 90.2031 25.3139 90.0405 24.4639C89.9925 24.2075 89.5555 22.9191 89.7728 23.4319C89.2072 22.1159 89.0297 21.9948 87.919 21.0408C88.3994 21.4535 87.6126 20.8359 87.5796 20.8122C87.3117 20.6295 87.0241 20.4728 86.742 20.3146C86.1464 19.9801 86.0413 19.952 85.2752 19.7431C84.1901 19.448 82.8104 19.4448 81.687 19.6363C78.5001 20.1766 75.6296 21.8098 72.9716 23.5842C68.3495 26.675 64.3591 30.7652 60.7083 34.9302C57.6486 38.419 54.7864 42.1477 52.4483 46.1651C50.7786 49.0329 45.5641 47.1191 46.89 43.8848C51.1259 33.5329 58.2673 24.4618 60.3324 13.286C60.5123 12.3117 60.5829 11.5264 60.5346 10.2197C60.5086 9.53722 60.3305 8.76235 60.0088 8.17986C59.9287 8.03562 59.4795 7.46359 59.9681 8.0724C59.8265 7.8973 59.6603 7.74064 59.4975 7.586C58.9409 7.05461 60.0584 7.95649 59.4036 7.52241C59.2016 7.38715 58.978 7.28138 58.7599 7.17412C59.5708 7.57229 57.6109 6.91683 58.1827 6.98555C57.3018 6.87835 57.1842 6.93649 56.5835 7.0797C54.2764 7.62392 52.1345 9.91104 50.3687 12.0559C48.1084 14.8068 46.3554 18.0372 44.7495 21.1985C42.4766 25.6689 40.4435 30.4271 39.1985 35.2997C38.3627 38.5742 33.0058 38.039 33.2313 34.5522C33.5916 28.9728 33.2617 22.5516 29.4062 18.2114C26.7668 15.2407 23.0084 14.0789 19.1031 14.0364C15.4058 13.9974 11.8239 14.9631 8.76894 16.835C8.46428 17.0232 8.16959 17.2264 7.8819 17.4337C8.43815 17.0361 7.48374 17.7919 7.35335 17.9126C7.12532 18.1217 6.91976 18.3484 6.71218 18.5786C6.49139 18.8478 6.52116 18.8043 6.8015 18.4481C6.67742 18.6145 6.57085 18.791 6.46227 18.971C6.33953 19.1755 6.03656 19.9994 6.36393 19.1009C6.3243 19.2181 6.28817 19.3372 6.26107 19.4569C6.09281 20.0879 6.30183 18.7477 6.25786 19.3897C6.20414 20.1941 6.07556 18.8971 6.28012 19.6826C6.38155 19.9839 6.34925 19.9186 6.18121 19.4902C6.25911 19.6705 6.36665 19.8399 6.47068 20.0073C8.54804 23.3209 3.27758 26.3221 1.20373 23.0105C-1.32813 18.9724 1.35314 14.7891 4.67051 12.3172C8.5432 9.43318 13.6276 8.1448 18.3911 7.97801C23.9493 7.78467 29.5454 9.6761 33.4772 13.6823C38.7859 19.0949 39.7676 27.2972 39.2968 34.507C37.3071 34.259 35.3194 34.0075 33.3296 33.7595C34.8894 27.6545 37.5757 21.6679 40.5532 16.1388C43.6956 10.3081 48.0598 3.42806 54.7197 1.29441C60.5782 -0.583104 65.8989 3.60425 66.5299 9.38255C67.1754 15.2812 64.4622 21.4763 62.1681 26.7512C60.4793 30.6302 58.5384 34.3961 56.561 38.1364C55.7379 39.6914 54.9022 41.2438 54.0826 42.8009C53.7803 43.3731 53.4869 43.9458 53.1986 44.5261C53.0443 44.8337 52.3024 46.5149 52.7585 45.4015C50.9044 44.6437 49.0523 43.8824 47.2002 43.1212C50.572 37.3296 54.9473 32.0148 59.5792 27.1934C64.7323 21.8329 70.81 16.6656 77.9757 14.3106C84.0554 12.3087 90.9808 13.9268 94.5512 19.4886C97.6943 24.3837 95.8393 30.7009 93.4918 35.4782C90.5195 41.5238 85.8091 46.8692 80.8339 51.3476C76.879 54.9076 71.7076 59.1841 66.2523 60.0156C64.6203 60.2635 63.0014 59.5995 62.5384 57.8713C62.1353 56.4111 63.0341 54.4098 64.6716 54.1604Z"
                                                            fill="
                                                        @if ($loop->iteration % 3 == 1) #00B9F1 
                                                        @elseif ($loop->iteration % 3 == 2)
                                                        #7C81FF 
                                                        @else
                                                        #FF577B @endif
                                                        " />
                                                    </svg>

                                                </div>
                                            </div>
                                            <div class="bd-program-content mb-40">
                                                <h3 class="bd-program-title"><a
                                                        href="{{ route('program-akademik', $item->id) }}"
                                                        class="hover-clr-{{ ($loop->iteration % 3) + 4 }}">{{ $item->nama_program }}</a>
                                                </h3>
                                                <p>{{ $item->deskripsi_singkat }}</p>
                                            </div>
                                            <div
                                                class="bd-program-info-wrapper @if ($loop->iteration % 3 == 1) theme-bg-8 @elseif ($loop->iteration % 3 == 2)theme-bg-10 @else theme-bg-9 @endif">
                                                <div class="bd-program-info">
                                                    <h5 class="bd-program-info-title">6 Hari <br><span>Mingguan</span></h5>
                                                </div>
                                                <div class="bd-program-info">
                                                    <h5 class="bd-program-info-title">8 JP<br><span>Hari</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- program area end here -->
    {{-- END --}}
@endsection
