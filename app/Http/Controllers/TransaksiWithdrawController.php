<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;
use App\Models\TransaksiWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $siswa = Siswa::where('id_siswa', $request->id_siswa)->first();

        if ($request->withdraw > $siswa->saldo) {
            return Response()->json(['message' => 'Saldo tidak mencukupi'], 400);
        }

        $saldo = 0;
        $idTransaksi = 1;
        $lastTransaksi = Transaksi::orderBy('waktu_transaksi', 'desc')->first();
        if ($lastTransaksi != null) {
            $saldo = $lastTransaksi->saldo_akhir;
            $idTransaksi = $lastTransaksi->id_transaksi + 1;
        }
        $request->harga_total = $saldo - $request->withdraw;

        DB::beginTransaction();
        try {
            $dataTransaksi->store($request);

            $data->id_withdraw = $idTransaksi;
            $data->jumlah_withdraw = $request->withdraw;
            $data->save();

            $siswa->saldo -= $request->withdraw;
            $siswa->save();

            DB::commit();
            return Response()->json(['message' => 'Withdraw berhasil', 'data' => [
                'saldoAkhir' => $request->harga_total,
                'saldoSiswa' => $siswa->saldo,
            ]], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit(Request $request) {
        $dataTransaksi = new TransaksiController();
        $siswa = Siswa::where('id_siswa', $request->id_siswa)->first();

        // dd($request);
        $selisihWithdraw = $request->withdraw - $request->withdraw_awal;
        if ($selisihWithdraw > $siswa->saldo) {
            return Response()->json(['message' => 'Saldo tidak mencukupi'], 400);
        } else {
            $saldo = 0;
            $lastTransaksi = Transaksi::orderBy('waktu_transaksi', 'desc')->first();
            // dd($lastTransaksi);
            if ($lastTransaksi != null) {
                $saldo = $lastTransaksi->saldo_akhir;
            }
            $saldoAkhir = $saldo + $selisihWithdraw;
    
            DB::beginTransaction();
            try {
                $dataTransaksi->update($request->id_transaksi, $saldoAkhir);
    
                TransaksiWithdraw::where('id_withdraw', $request->id_transaksi)
                    ->update([
                        'jumlah_withdraw' => $request->withdraw
                    ]);
            
                Siswa::where('id_siswa', $request->id_siswa)
                    ->update([
                        'saldo' => $siswa->saldo - $selisihWithdraw
                    ]);
    
                DB::commit();
                return Response()->json(['message' => 'Edit withdraw berhasil', 'data' => [
                    'saldoAkhir' => $request->harga_total,
                    'saldoSiswa' => $siswa->saldo - $selisihWithdraw,
                ]], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return Response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }
}
