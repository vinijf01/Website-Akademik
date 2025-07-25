@extends('layouts.main_admin')
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
                    action="{{ route('admin.wali-kelas.update', $walas->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 offset-2 col-md-4">
                        @include('partials.messages')
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select id="id_kelas" name="id_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $walas->id_kelas ? 'selected' : '' }}>
                                        {{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Guru</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                aria-describedby="helpId" value="{{ $walas->nama }}" required>
                        </div>
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.wali-kelas.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
