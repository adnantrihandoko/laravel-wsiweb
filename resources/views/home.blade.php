@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Halaman Home Acara 5 dan 6</h1>
        <p class="lead">Halaman ini merupakan halaman home dari tugas bkpm acara 5 dan 6</p>
    </div>
    <p>Nama : {{$nama}} </p>
    <p>Pelajaran</p>
    <ul>
        @foreach ($pelajaran as $data)
        <li> {{$data}} </li>
        @endforeach
    </ul>
</div>
@endsection