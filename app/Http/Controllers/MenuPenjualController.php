<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuPenjualController extends Controller
{

    public function index()
    {
        $kategori = DB::table('kategori')->get();
        return view('dashboard.menu-penjual', ['kategori' => $kategori]);
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
        $data->id_siswa_penjual = Auth::user()->id_siswa;
        $data->timestamps = false;

        $data->save();
        return Response()->json(['data' => $data, 'message' => 'Data Berhasil Ditambahkan'], 200);
    }

    public function show(Barang $barang)
    {
        $id_user = Auth::user()->id_siswa;
        $barang = Barang::with('kategori')->where('id_siswa_penjual',  $id_user)->get();
        return Response()->json(['data' => $barang, 'message' => 'Data berhasil ditampilkan'], 200);
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        //return json
        return Response()->json(['data' => $barang], 200);
    }

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
        $data->id_siswa_penjual = Auth::user()->id_siswa;
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
