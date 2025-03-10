<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    function index($nama){
        return $nama;
    }

    // function index(Request $request){
    //     return $request->segment(2);
    // }

    function formulir(){
        return view('formulir');
    }

    function proses(Request $request){
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');

        return "Nama = " . $nama . " Alamat = " . $alamat;
    }

    function prosesValidasi(Request $request){
        $messages = ['required' => 'Input :attribute harus diisi', 'min' => 'Input :attribute harus diisi :min karakter!', 'max' => 'Input :attribute harus diisi :max karakter!'];

        $request->validate([
            'nama' => 'required|min:5|max:20',
            'alamat' => 'required|alpha'
        ], $messages);

        $nama = $request->input('nama');
        $alamat = $request->input('alamat');

        return "Nama: $nama Alamat: $alamat";
    }

    function indexValidasi(){
        return view('validasi.formulir');
    }

    
}
