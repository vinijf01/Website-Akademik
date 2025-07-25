@extends('layouts.main_admin')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                <form class="needs-validation forms-sample" method="POST" action="{{ route('admin.program-akademik.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6 offset-2 col-md-4">
                        @include('partials.messages')
                        <div class="mb-3">
                            <label for="nama_program" class="form-label">Nama Program Akademik</label>
                            <input type="text" name="nama_program" class="form-control" placeholder="Nama Program"
                                aria-describedby="helpId" required="required" value="{{ old('nama_program') }}">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" id="kategori" name="kategori" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat</label>
                            <input type="text" id="deskripsi_singkat" name="deskripsi_singkat" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" type="text" class="form-control tinymce-light tinymce-editor " name="deskripsi"></textarea><br>
                        </div>
                        <div class="mb-3">
                            <label for="spp" class="form-label">SPP</label>
                            <input type="text" id="spp" name="spp" class="form-control"
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control"
                                aria-describedby="helpId" required>
                            <div>
                                <img id="showImage" src="{{ url('assets/img/no-image.jpg') }}" alt="Current Image"
                                    style="max-width: 100px; margin-top: 10px;">
                            </div><br>
                        </div>
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.program-akademik.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
