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
                        <th>Image</th>
                        <th>Pengantar</th>
                        <th>Isi</th>
                        <th>Ket.Btn</th>
                        <th>L.Btn</th>
                        <th>L.Fb</th>
                        <th>L.Ig</th>
                        <th>L.Yt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><img src="{{ url('assets/img/hero/' . $hero->image) }}" alt="Image-hero" height="100px"></td>
                        <td>{{ $hero->judul }}</td>
                        <td>{{ $hero->isi }}</td>
                        <td>{{ $hero->keterangan_tombol }}</td>
                        <td>{{ $hero->link_btn }}</td>
                        <td>{{ $hero->link_fb }}</td>
                        <td>{{ $hero->link_ig }}</td>
                        <td>{{ $hero->link_yt }}</td>
                        <td>
                            <a href="{{ route('admin-hero.edit', $hero->id) }}">
                                <i class='bx bx-edit crud-icon' style="font-size: 1.5em; color:green;" title="Edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
