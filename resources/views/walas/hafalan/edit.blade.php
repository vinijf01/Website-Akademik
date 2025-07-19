@extends('layouts.main_walas')
@section('content')
    <h1>Edit {{ $title }}</h1>
    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8">
                    <h5>{{ $title }}</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <div class="row">
                <form class="needs-validation forms-sample" method="POST"
                    action="{{ route('walas-hafalan-santri.update', $hafalan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 offset-2 col-md-4">
                        <div class="mb-3">
                            <label for="id_santri" class="form-label">Nama Santri</label>
                            <select class="form-select" id="id_santri" name="id_santri" aria-describedby="helpId">
                                <option value="">Pilih Nama Santri</option>
                                @foreach ($santri as $user)
                                    <option value="{{ $user->id_santri }}"
                                        {{ $user->id_santri == $hafalan->id_santri ? 'selected' : '' }}>
                                        {{ $user->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                aria-describedby="helpId" value="{{ $hafalan->tanggal }}">
                        </div>
                        <div class="mb-3">
                            <label for="surat" class="form-label">Surat</label>
                            <input type="text" id="surat" name="surat" class="form-control"
                                aria-describedby="helpId" value="{{ $hafalan->surat }}">
                        </div>
                        <div class="mb-3">
                            <label for="ayat" class="form-label">Ayat</label>
                            <input type="text" id="ayat" name="ayat" class="form-control"
                                aria-describedby="helpId" value="{{ $hafalan->ayat }}">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan" class="form-control"
                                aria-describedby="helpId" value="{{ $hafalan->keterangan }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('walas-hafalan-santri.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
