<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;
use App\Models\TransaksiWithdraw;
use Illuminate\Http\Request;

class TransaksiWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        $data = new TransaksiWithdraw();
        $dataTransaksi = new TransaksiController();
        $saldoSiswa = Siswa::where('id_siswa', $request->id_siswa)->first()->saldo;

        if ($request->withdraw > $saldoSiswa) {
            return Response()->json(['message' => 'Saldo tidak mencukupi'], 400);
        }

        $saldo = 0;
        $idTransaksi = 1;
        $lastTransaksi = Transaksi::orderBy('id_transaksi', 'desc')->first();
        if ($lastTransaksi != null) {
            $saldo = $lastTransaksi->saldo_akhir;
            $idTransaksi = $lastTransaksi->id_transaksi + 1;
        }

        $request->harga_total = $saldo - $request->withdraw;
        $dataTransaksi->store($request);

        $data->id_withdraw = $idTransaksi;
        $data->jumlah_withdraw = $request->withdraw;
        $data->save();

        Siswa::where('id_siswa', $request->id_siswa)->update([
            'saldo' => $saldoSiswa - $request->withdraw
        ]);

        return Response()->json(['message' => 'Withdraw berhasil', 'data' => [
            'saldoAkhir' => $request->harga_total,
            'saldoSiswa' => $saldoSiswa - $request->withdraw,
        ]], 200);
    }
}
