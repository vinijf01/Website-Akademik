@extends('layouts.main_admin')
@section('content')
    <h1>{{ $title }}</h1>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="col-lg-4 text-end mb-3">
                    <a href="{{ route('admin.program-akademik.create') }}" class="btn btn-success"><i class='bx bx-plus-circle'
                            style="font-size: 1.5em"></i> Tambah
                        {{ $title }}</a>
                </div>
                @include('partials.messages')
            </div>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped datatable">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Program</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>SPP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($program_akademik as $index => $item)
                        <tr>
                            <th class="text-center" scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item->nama_program }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {!! $item->deskripsi !!}</td>
                            <td>{{ $item->spp }}</td>
                            <td>
                                <a href="{{ route('admin.program-akademik.edit', $item->id) }}">
                                    <i class='bx bx-edit crud-icon' style="font-size: 1.5em; color:green;"
                                        title="Edit"></i>
                                </a>
                                <button type="button" class="bg-transparent border-0" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $item->id }}">
                                    <i class='bx bxs-eraser' style="font-size: 1.5em; color:red;"title="Hapus"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Delete --}}
                        <div class="modal fade" id="basicModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Hapus Data {{ $title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Apakah Anda Yakin Ingin Menghapus?</div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.program-akademik.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
