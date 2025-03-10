<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidikan;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendidikan = Pendidikan::all();
        return view('backend.pendidikan.index', compact('pendidikan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tingkatan = $this->getTingkatanOptions();
        return view('backend.pendidikan.create', compact('tingkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tingkatan' => 'required|string',
            'tahun_masuk' => 'required|numeric|digits:4',
            'tahun_keluar' => 'required|numeric|digits:4|gte:tahun_masuk',
        ]);

        Pendidikan::create($request->all());

        return redirect()->route('pendidikan.index')
            ->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendidikan $pendidikan)
    {
        return view('backend.pendidikan.show', compact('pendidikan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendidikan $pendidikan)
    {
        $tingkatan = $this->getTingkatanOptions();
        return view('backend.pendidikan.edit', compact('pendidikan', 'tingkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tingkatan' => 'required|string',
            'tahun_masuk' => 'required|numeric|digits:4',
            'tahun_keluar' => 'required|numeric|digits:4|gte:tahun_masuk',
        ]);

        $pendidikan->update($request->all());

        return redirect()->route('pendidikan.index')
            ->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendidikan $pendidikan)
    {
        $pendidikan->delete();

        return redirect()->route('pendidikan.index')
            ->with('success', 'Data pendidikan berhasil dihapus.');
    }

    /**
     * Get tingkatan education options.
     */
    private function getTingkatanOptions()
    {
        return [
            'SD' => 'SD (Sekolah Dasar)',
            'SMP' => 'SMP (Sekolah Menengah Pertama)',
            'SMA' => 'SMA (Sekolah Menengah Atas)',
            'SMK' => 'SMK (Sekolah Menengah Kejuruan)',
            'D1' => 'D1 (Diploma 1)',
            'D2' => 'D2 (Diploma 2)',
            'D3' => 'D3 (Diploma 3)',
            'D4' => 'D4 (Diploma 4)',
            'S1' => 'S1 (Sarjana)',
            'S2' => 'S2 (Magister)',
            'S3' => 'S3 (Doktor)'
        ];
    }
}