<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdatebarangRequest;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        $kategori = Kategori::all();
        return view('barang.index', ['barang' => $barang, 'kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = DB::table('kategori')->get();
        return view('barang.create', ['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $data = new Barang;
        $filename = null;
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }
        $data->nama_barang = $request->nama_barang;
        $data->id_kategori = $request->id_kategori;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->foto = $filename;
        $data->id_siswa_penjual = '123456';
        $data->timestamps = false;

        $data->save();
        return Response()->json(['data' => $data, 'message' => 'Data Berhasil Ditambahkan'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        $barang = Barang::with('kategori')->get();
        return Response()->json(['data' => $barang, 'message' => 'Data berhasil ditampilkan'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        //return json
        return Response()->json(['data' => $barang], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBarangRequest $request)
    {
        $data = Barang::find($request->id_barang);
        $filename = null;
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            //remove old image
            if ($data->foto) {
                unlink(public_path('images') . '/' . $data->foto);
            }
        }
        $data->nama_barang = $request->nama_barang;
        $data->id_kategori = $request->id_kategori;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        if ($filename) {
            $data->foto = $filename;
        }
        $data->id_siswa_penjual = '123456';
        $data->timestamps = false;

        $data->save();
        return Response()->json(['data' => $data, 'message' => 'Data berhasil diubah'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if ($barang->foto) {
            unlink(public_path('images') . '/' . $barang->foto);
        }
        Barang::destroy($id);
        return Response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
