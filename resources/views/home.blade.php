<x-layouts.app>
    <div>
        <div>
            <h1>Halaman Home Acara 5 dan 6</h1>
            <p>Halaman ini merupakan halaman home dari tugas bkpm acara 5 dan 6</p>
        </div>
        <p>Nama : {{$nama}} </p>
        <p>Pelajaran</p>
        <ul>
            @foreach ($pelajaran as $data)
                <li> {{$data}} </li>
            @endforeach
        </ul>
    </div>
</x-layouts.app>