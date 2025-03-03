<x-layouts.app>
    <h1>Edit Karyawan</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Gunakan method PUT untuk update -->

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Posisi</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    <!-- Form Dropzone untuk Upload File -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Upload Foto/Dokumen</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('media.store', $employee->id) }}" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
                @csrf
                <div class="dz-message needsclick">
                    <button type="button" class="btn btn-primary btn-choose-file">
                        <i class="fas fa-cloud-upload-alt"></i> Choose Files
                    </button>
                    <span class="text-muted ms-2">or drag and drop files here</span>
                </div>
            </form>

            <!-- Daftar File Terupload -->
            <div class="mt-4">
                <h6>File Terupload:</h6>
                <div class="row" id="media-list">
                    @foreach($employee->media as $media)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                @if(str_contains($media->type, 'image'))
                                    <img src="{{ asset('storage/'.$media->path) }}" class="card-img-top">
                                @else
                                    <div class="card-body">
                                        <i class="fas fa-file-pdf fa-3x"></i>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <form action="{{ route('media.destroy', $media->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Script Dropzone -->
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#my-dropzone", {
            paramName: "file", // Nama parameter file
            maxFilesize: 2, // Ukuran maksimal file (2MB)
            acceptedFiles: 'image/*,.pdf,.doc,.docx', // Jenis file yang diterima
            addRemoveLinks: true, // Tambahkan link hapus file
            clickable: '.btn-choose-file', // Tombol "Choose File" sebagai trigger
            dictDefaultMessage: "", // Pesan default (kosongkan karena kita punya custom message)
            dictRemoveFile: "Remove", // Teks untuk hapus file
            init: function() {
                // Event saat file berhasil diupload
                this.on("success", function(file, response) {
                    location.reload(); // Refresh halaman setelah upload
                });

                // Event saat file ditambahkan
                this.on("addedfile", function(file) {
                    if (this.files.length > 5) { // Batasi maksimal 5 file
                        this.removeFile(file);
                        alert("Max 5 files allowed");
                    }
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>