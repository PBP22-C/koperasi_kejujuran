<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id_user = session('id_user');
        // $barang = Barang::with('kategori')->where('id_siswa_penjual', '!=', $id_user)->get();
        // $kategori = Kategori::all();
        return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // dd($id_user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData() {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')->where('id_siswa_penjual', '!=', $id_user)->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }

    public function getBarangByKategori($id_kategori) {
        $id_user = '12456';
        $barang = Barang::with('kategori')->where('id_siswa_penjual', '!=', $id_user)->where('id_kategori', $id_kategori)->get();
        $kategori = Kategori::all();

        return Response()->json(['barang' => $barang, 'kategori' => $kategori]);
    }
}
