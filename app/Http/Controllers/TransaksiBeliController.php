<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBeli;
use App\Http\Requests\StoreTransaksiBeliRequest;
use App\Http\Requests\UpdateTransaksiBeliRequest;
use App\Models\barang;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiBeliController extends Controller
{
    public function store(Request $request)
    {
        $barang = Barang::where('id_barang', $request->id_barang)->first();
        $stok = $barang->stok;
        $idSiswa = $barang->id_siswa_penjual;
        $data = new TransaksiBeli();
        $dataTransaksi = new TransaksiController();
        $siswa = Siswa::where('id_siswa', $idSiswa)->first();
    
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
        $request->idTransaksi = $idTransaksi;
        DB::beginTransaction();
        try {
            $dataTransaksi->store($request);

            $data->id_beli = $idTransaksi;
            $data->id_barang = $request->id_barang;
            $data->kuantitas = $request->kuantitas;
            $data->harga_total = $harga_total;
            $data->save();

            $barang->stok -= $request->kuantitas;
            $barang->save();

            $siswa->saldo += $harga_total;
            $siswa->save();

            DB::commit();
            return Response()->json(['message' => 'Barang berhasil dibeli'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
