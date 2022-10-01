<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBeli;
use App\Http\Requests\StoreTransaksiBeliRequest;
use App\Http\Requests\UpdateTransaksiBeliRequest;
use App\Models\Barang;
use App\Models\Transaksi;
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
        $dataTransaksi = new TransaksiController();
        $saldo = 0;
        $idTransaksi = 1;
        $stok = Barang::where('id_barang', $request->id_barang)->first()->stok;

        if ($request->kuantitas > $stok) {
            return Response()->json(['message' => 'Stok tidak mencukupi'], 400);
        }

        $lastTransaksi = Transaksi::orderBy('id_transaksi', 'desc')->first();
        if ($lastTransaksi != null) {
            $saldo = $lastTransaksi->saldo_akhir;
            $idTransaksi = $lastTransaksi->id_transaksi + 1;
        }

        $request->harga_total += $saldo;
        $dataTransaksi->store($request);


        $data->id_beli = $idTransaksi;
        $data->id_barang = $request->id_barang;
        $data->kuantitas = $request->kuantitas;
        $data->harga_total = $request->harga_total;
        $data->save();

        Barang::where('id_barang', $request->id_barang)->update([
            'stok' => $stok - $request->kuantitas
        ]);


        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
