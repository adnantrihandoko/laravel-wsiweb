<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadFilesController extends Controller
{
    function index()
    {
        return view('upload.upload');
    }

    function indexResize()
    {
        return view('upload.resize');
    }

    function proses(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';

        // ekstensi file
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';

        // real path
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';

        echo 'File Uploaded Path: ' . public_path($file->getClientOriginalName()) . '<br>';

        // ukuran file
        echo 'File Size: ' . $file->getSize() . '<br>';

        // tipe mime
        echo 'File Mime Type: ' . $file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = './';

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }

    public function resize_upload(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        //TENTUKAN PATH LOKASI UPLOAD
        $path = public_path('img/logo');

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($path, 0777, true);
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('file');

        //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI
        $canvas = Image::canvas(200, 200);

        //RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
        $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
        $canvas->insert($resizeImage, 'center');

        //SIMPAN IMAGE KE FOLDER
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect(route('upload'))->with('error', 'Data gagal ditambahkan!');
        }
    }
}
