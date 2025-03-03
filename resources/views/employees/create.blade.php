<x-layouts.app>
    <h1>Tambah Karyawan</h1>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Posisi</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    <!-- Dropzone untuk Upload File (Akan Ditampilkan Setelah Karyawan Dibuat) -->
    <div id="dropzone-section" class="card mt-4">
        <div class="card-header">
            <h5>Upload Foto/Dokumen</h5>
        </div>
        <div class="card-body">
            <form action="#" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
                @csrf
                <div class="dz-message needsclick">
                    <button type="button" class="btn btn-primary btn-choose-file">
                        <i class="fas fa-cloud-upload-alt"></i> Choose Files
                    </button>
                    <span class="text-muted ms-2">or drag and drop files here</span>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;

            // Inisialisasi Dropzone
            let myDropzone = new Dropzone("#my-dropzone", {
                paramName: "file",
                maxFilesize: 2, // MB
                acceptedFiles: 'image/*,.pdf,.doc,.docx',
                addRemoveLinks: true,
                dictDefaultMessage: "Drop files here or click to upload",
                dictRemoveFile: "Remove",
                init: function () {
                    this.on("success", function (file, response) {
                        // Refresh halaman setelah upload
                        location.reload();
                    });
                }
            });

            // Event saat form tambah karyawan berhasil disubmit
            document.querySelector('form').addEventListener('submit', async function (e) {
                e.preventDefault();

                // Submit form tambah karyawan
                const formData = new FormData(this);
                const response = await fetch("{{ route('employees.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Tampilkan Dropzone setelah karyawan berhasil dibuat
                    document.getElementById('dropzone-section').style.display = 'block';

                    // Update action Dropzone dengan employee_id yang baru
                    myDropzone.options.url = "{{ route('media.store', '') }}/" + result.employee_id;
                }
            });
        </script>
    @endpush
</x-layouts.app>