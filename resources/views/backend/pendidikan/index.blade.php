@extends('backend.layouts.template')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pendidikan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pendidikan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Data Pendidikan</h3>
                </header>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('pendidikan.create') }}" class="btn btn-primary mb-3">
                        <i class="bi bi-plus"></i> Tambah
                    </a>
                
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-building"></i> Nama Sekolah/Institusi</th>
                                    <th><i class="bi bi-award"></i> Tingkatan</th>
                                    <th><i class="bi bi-calendar"></i> Tahun Masuk</th>
                                    <th><i class="bi bi-calendar"></i> Tahun Keluar</th>
                                    <th><i class="bi bi-gear"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendidikan as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tingkatan }}</td>
                                    <td>{{ $item->tahun_masuk }}</td>
                                    <td>{{ $item->tahun_keluar }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('pendidikan.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('pendidikan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pendidikan.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                    <td colspan="5" class="text-center">Tidak ada data pendidikan</td>
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