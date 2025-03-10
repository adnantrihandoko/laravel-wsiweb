@extends('backend/layouts.template')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pengalaman Kerja</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pengalaman Kerja</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ isset($pengalaman_kerja) ? 'Mengubah' : 'Menambahkan' }} Pengalaman Kerja
                </header>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terjadi kesalahan pada inputanmu!. <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <form action="{{ isset($pengalaman_kerja) ? route('pengalaman_kerja.update', $pengalaman_kerja->id) : route('pengalaman_kerja.store') }}" method="POST">
                            @csrf
                            @if(isset($pengalaman_kerja))
                                @method('PUT')
                            @endif

                            <div class="form-group mb-3">
                                <label for="nama"><span>Nama Perusahaan</span></label>
                                <div>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->nama : old('nama') }}" placeholder="Nama Perusahaan" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jabatan"><span>Jabatan</span></label>
                                <div>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->jabatan : old('jabatan') }}" placeholder="Jabatan" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tahun_masuk"><span>Tahun Masuk</span></label>
                                <div>
                                    <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_masuk : old('tahun_masuk') }}" placeholder="Tahun Masuk" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tahun_keluar"><span>Tahun Keluar</span></label>
                                <div>
                                    <input type="text" class="form-control" id="tahun_keluar" name="tahun_keluar" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_keluar : old('tahun_keluar') }}" placeholder="Tahun Keluar" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">{{ isset($pengalaman_kerja) ? 'Update' : 'Simpan' }}</button>
                                    <a href="{{ route('pengalaman_kerja.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
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
    });
    $('#tahun_keluar').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
    });
</script>
@endpush