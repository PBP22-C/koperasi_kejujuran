<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function getData()
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')->where('id_siswa_penjual', '!=', $id_user)->where('stok', '>', 0)->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }

    public function getBarangByKategori($id_kategori)
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')->where('id_siswa_penjual', '!=', $id_user)->where('id_kategori', $id_kategori)->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }
    // get nama user
    public function getNamaUser()
    {
        // nama user
        $nama_user = Auth::user()->nama_siswa;





        return Response()->json(['data' => $nama_user, 'message' => 'Data berhasil diambil'], 200);
    }
}
