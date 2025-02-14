<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementUser extends Controller
{
    function index(){
        $nama = "Adnan Tri Handoko";
        $pelajaran = ["Matdis", "WSIWeb", "WSIMobile", "Kewirausahaan", "PKN"];

        return view('home', compact('nama', 'pelajaran'));
    }

    function create(){
        return "Method ini untuk menambahkan user";
    }

    function store(){
        "Method ini untuk menciptakan data baru";
    }

    function show($id){
        return "Method ini untuk menampilkan data user dengan id " . $id; 
    }

    function edit($id){
        return "Method ini untuk menampilkan form data user dan mengubahnya dengan id user " . $id;
    }

    function update($id){
        return "Method ini untuk mengupdate user dengan id " . $id;
    }
    function destroy($id){
        return "method ini untuk menghapus data user dengan id " . $id;
    }
}
