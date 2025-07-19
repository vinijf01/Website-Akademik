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
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Kata Pengantar</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($kata_pengantar as $item)
                        <tr>

                            <td>
                                @php
                                    $short_deskripsi = strip_tags($item->keterangan);
                                    $ket = mb_strcut($short_deskripsi, 0, 20);
                                @endphp
                                {{ $ket }}...
                            </td>
                            <td><img src="{{ url('assets/img/teacher/' . $item->foto) }}" alt="Profil" height="100px">
                            </td>
                            <td>
                                @php
                                    $short_deskripsi = strip_tags($item->kata_pengantar);
                                    $isi = mb_strcut($short_deskripsi, 0, 30);
                                @endphp
                                {{ $isi }}...
                            </td>
                            <td>
                                <a href="{{ route('admin-kata-pengantar.edit', $item->id) }}">
                                    <i class='bx bx-edit crud-icon' style="font-size: 1.5em; color:green;"
                                        title="Edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
