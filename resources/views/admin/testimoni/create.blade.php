@extends('layouts.main_admin')
@section('content')
    <h1>Tambah {{ $title }}</h1>
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
                <form class="needs-validation forms-sample" method="POST" action="{{ route('admin.testimoni.store') }}"
                    novalidate>
                    @csrf
                    <div class="col-lg-6 offset-2 col-md-4">
                        @include('partials.messages')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" id="status" name="status" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="testimoni" class="form-label">Testimoni</label>
                            <input type="text" id="testimoni" name="testimoni" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.testimoni.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
