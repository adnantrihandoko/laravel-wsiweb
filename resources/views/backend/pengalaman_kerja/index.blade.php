@extends('backend.layouts.template')
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
                    <h3>Pengalaman Kerja</h3>
                </header>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('pengalaman_kerja.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus"></i> Tambah
                    </a>
                
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-building"></i> Nama</th>
                                    <th><i class="bi bi-person-badge"></i> Jabatan</th>
                                    <th><i class="bi bi-calendar"></i> Tahun Masuk</th>
                                    <th><i class="bi bi-calendar"></i> Tahun Keluar</th>
                                    <th><i class="bi bi-gear"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengalaman_kerja as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->tahun_masuk }}</td>
                                    <td>{{ $item->tahun_keluar }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('pengalaman_kerja.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pengalaman_kerja.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengalaman kerja</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main><!-- End #main -->
@endsection