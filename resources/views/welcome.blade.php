@extends('layouts.main')
@section('content')
    <!-- main area start here  -->
    <main>
        <!-- hero area start here  -->
        <section class="bd-hero-area bd-hero-area-3 fix">
            @include('hero')
        </section>
        <!-- hero area end here  -->


        <!-- About Pesantren area start here  -->
        <section id="about" class="bd-promotion-area pt-120 pb-60">

            @include('about_pesantren')

        </section>
        <!-- About pesantren area end here  -->

        <!-- Program Akademik area start here -->
        <section class="bd-class-area pt-120 pb-120">

            @include('program_akademik')

        </section>
        <!-- Program Akademik area end here -->

        <!-- Program Tambahan area start here  -->
        <section class="bd-program-area-2 p-relative fix theme-bg-6 pt-120 pb-120">

            @include('tambahan')
        </section>
        <!-- Program tambahan area end here -->

        <!-- faq area start here  -->
        <section class="bd-faq-area pt-120 pb-60">
            @include('faq')
        </section>
        <!-- faq area end here  -->

        <!-- testimonial area start here  -->
        <section class="bd-testimonial-area-2 pb-120 p-relative pt-120 theme-bg">
            @include('testimoni')
        </section>
        <!-- testimonial area end here  -->


        <!-- Pengumuman area start here  -->
        <section class="bd-blog-area-2 p-relative fix pt-120 pb-120">
            @include('berita')
        </section>
        <!-- Pengumuman area end here  -->
    </main>
    <!-- main area end here  -->
@endsection
