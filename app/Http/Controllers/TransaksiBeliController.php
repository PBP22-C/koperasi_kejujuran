<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBeli;
use App\Http\Requests\StoreTransaksiBeliRequest;
use App\Http\Requests\UpdateTransaksiBeliRequest;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiBeliController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiBeliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TransaksiBeli();


        $data->id_barang = $request->id_barang;
        $data->kuantitas = $request->kuantitas;
        $data->harga_total = $request->harga_total;

        $data->save();

        Barang::where('id', $request->id_barang)->delete();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
