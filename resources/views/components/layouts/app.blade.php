<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel BKPM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow px-4 mb-4">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="/">Laravel BKPM</a>

            <!-- Navbar Links (Center) -->
            <div class="d-flex justify-content-center">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </div>
            </div>

            <!-- Navbar Buttons (Right) -->
            <div class="d-flex justify-content-end gap-2">
                @auth
                    <!-- Jika user sudah login -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }} <!-- Menampilkan nama user -->
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <!-- Form untuk logout -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <a class="btn btn-primary" aria-current="page" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-outline-primary" aria-current="page" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="px-5">
        {{ $slot }}
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#my-dropzone", {
            paramName: "file",
            maxFilesize: 2, // MB
            acceptedFiles: 'image/*,.pdf,.doc,.docx',
            addRemoveLinks: true,
            clickable: '.btn-choose-file', // Target tombol choose file
            dictDefaultMessage: "",
            dictRemoveFile: "Remove",
            init: function () {
                this.on("success", function (file, response) {
                    location.reload();
                });

                this.on("addedfile", function (file) {
                    if (this.files.length > 5) { // Batasi maksimal 5 file
                        this.removeFile(file);
                        alert("Max 5 files allowed");
                    }
                });
            }
        });
    </script>.
</body>

</html>