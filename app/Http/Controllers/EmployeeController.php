<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Menampilkan semua data karyawan
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    // Menampilkan form tambah karyawan
    public function create()
    {
        return view('employees.create');
    }

    // Menyimpan data karyawan baru
    // app/Http/Controllers/EmployeeController.php
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
        ]);

        $employee = Employee::create($request->all());

        response()->json([
            'success' => true,
            'employee_id' => $employee->id
        ]);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    // Menampilkan detail karyawan
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    // Menampilkan form edit karyawan
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Mengupdate data karyawan
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|min:3    ',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui!');
    }

    // Menghapus data karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}
