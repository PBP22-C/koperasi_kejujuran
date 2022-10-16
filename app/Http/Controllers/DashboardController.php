<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    // get nama user
    public function getNamaUser()
    {
        // nama user
        $nama_user = Auth::user()->nama_siswa;
        return Response()->json(['data' => $nama_user, 'message' => 'Data berhasil diambil'], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function getData()
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')
            ->where('id_siswa_penjual', '!=', $id_user)
            ->where('stok', '>', 0)
            ->where('deleted', false)
            ->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }

    public function getBarangByKategori($id_kategori)
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')
            ->where('id_siswa_penjual', '!=', $id_user)
            ->where('stok', '>', 0)
            ->where('deleted', false)
            ->where('id_kategori', $id_kategori)
            ->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori, 'kategoriSelected' => $id_kategori]);
    }
    
    public function getBarangByKeywordKategori($id_kategori, $keyword)
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')
            ->where('id_siswa_penjual', '!=', $id_user)
            ->where('id_kategori', $id_kategori)
            ->where('nama_barang', 'LIKE', '%' . $keyword . '%')
            ->where('stok', '>', 0)
            ->where('deleted', false)
            ->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori, 'kategoriSelected' => $id_kategori]);
    }

    public function getBarangByKeyword($keyword)
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')
            ->where('id_siswa_penjual', '!=', $id_user)
            ->where('nama_barang', 'LIKE', '%' . $keyword . '%')
            ->where('stok', '>', 0)
            ->where('deleted', false)
            ->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }
}
