@extends('layouts.main_admin')
@section('content')
    <h1>{{ $title }}</h1>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8">
                    <h5>{{ $title }}</h5>
                </div>
                @include('partials.messages')
            </div>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped datatable">
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>Image</th>
                        <th>Deskripsi 1</th>
                        <th>Deksripsi 2</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($keterangan_kelas as $item)
                        <tr>

                            <td>{{ $item->program->nama_program }}</td>

                            <td><img src="{{ url('assets/img/program/' . $item->image) }}" alt="Image-hero" height="100px">
                            </td>
                            <td>
                                @php
                                    $short_deskripsi = strip_tags($item->deskripsi_judul_1);
                                    $des_1 = mb_strcut($short_deskripsi, 0, 30);
                                @endphp
                                {{ $des_1 }}...
                            </td>
                            <td>
                                @php
                                    $short_deskripsi = strip_tags($item->deskripsi_judul_2);
                                    $des_2 = mb_strcut($short_deskripsi, 0, 30);
                                @endphp
                                {{ $des_2 }}...
                            </td>
                            <td>
                                <a href="{{ route('admin-keterangan-kelas.edit', $item->id) }}">
                                    <i class='bx bx-edit crud-icon' style="font-size: 1.5em; color:green;"
                                        title="Edit"></i>
                                </a>
                            </td>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
