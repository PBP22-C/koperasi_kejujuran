<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBeli;
use App\Http\Requests\StoreTransaksiBeliRequest;
use App\Http\Requests\UpdateTransaksiBeliRequest;
use App\Models\Barang;
use App\Models\Siswa;
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
        $barang = Barang::where('id_barang', $request->id_barang)->first();
        $stok = $barang->stok;
        $idSiswa = $barang->id_siswa_penjual;
        $data = new TransaksiBeli();
        $dataTransaksi = new TransaksiController();
        $saldoSiswa = Siswa::where('id_siswa', $idSiswa)->first()->saldo;

        if ($request->kuantitas > $stok) {
            return Response()->json(['message' => 'Stok tidak mencukupi'], 400);
        }

        $saldo = 0;
        $idTransaksi = 1;
        $lastTransaksi = Transaksi::orderBy('id_transaksi', 'desc')->first();
        if ($lastTransaksi != null) {
            $saldo = $lastTransaksi->saldo_akhir;
            $idTransaksi = $lastTransaksi->id_transaksi + 1;
        }

        $harga_total = $request->harga_total;
        $request->harga_total += $saldo;
        $dataTransaksi->store($request);


        $data->id_beli = $idTransaksi;
        $data->id_barang = $request->id_barang;
        $data->kuantitas = $request->kuantitas;
        $data->harga_total = $harga_total;
        $data->save();

        Barang::where('id_barang', $request->id_barang)->update([
            'stok' => $stok - $request->kuantitas
        ]);

        Siswa::where('id_siswa', $idSiswa)->update([
            'saldo' => $saldoSiswa + $harga_total
        ]);

        return response()->json([
            'message' => 'Barang berhasil dibeli',
            'data' => $data
        ], 200);
    }
}
