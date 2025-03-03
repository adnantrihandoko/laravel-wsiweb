<x-layouts.app>
    <h1>Data Karyawan</h1>
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
            <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}"
                required>
        </div>
    </form>
</x-layouts.app>