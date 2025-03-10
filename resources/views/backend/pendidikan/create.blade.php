@extends('backend.layouts.template')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pendidikan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pendidikan.index') }}">Pendidikan</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tambah Data Pendidikan
                </header>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terdapat beberapa masalah dengan input Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <form action="{{ route('pendidikan.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama" class="form-label">Nama Sekolah/Institusi</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama sekolah atau institusi" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select class="form-select" id="tingkatan" name="tingkatan" required>
                                    <option value="" disabled selected>Pilih Tingkatan</option>
                                    @foreach($tingkatan as $key => $value)
                                        <option value="{{ $key }}" {{ old('tingkatan') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}" placeholder="Tahun Masuk" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tahun_keluar" class="form-label">Tahun Keluar</label>
                                <input type="text" class="form-control" id="tahun_keluar" name="tahun_keluar" value="{{ old('tahun_keluar') }}" placeholder="Tahun Keluar" required>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pendidikan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main><!-- End #main -->
@endsection

@push('content-css')
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.css') }}">
@endpush

@push('content-js')
<script src="{{ asset('backend/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $('#tahun_masuk').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
    $('#tahun_keluar').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
</script>
@endpush