<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function saldo()
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', '=', DB::table('transaksi')->max('id_transaksi'))->get();
        if ($transaksi->isNotEmpty()) {
            $saldo = $transaksi[0]->saldo_akhir;
        } else {
            $saldo = 0;
        }

        return Response()->json(['data' => $saldo, 'message' => 'Data berhasil diambil'], 200);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id_siswa;
        $data = new Transaksi();
        $data->id_siswa = $userId;
        $data->saldo_akhir = $request->harga_total;

        $data->save();
    }
}
