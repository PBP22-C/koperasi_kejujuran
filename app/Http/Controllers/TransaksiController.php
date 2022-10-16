<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('dashboard.transaksi');
    }

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
        $data->waktu_transaksi = date('Y-m-d H:i:s', strtotime('+7 hours'));
        $data->save();
    }

    public function update($id_transaksi, $saldo_akhir) {
        Transaksi::where('id_transaksi', $id_transaksi)
            ->update([
                'saldo_akhir' => $saldo_akhir,
                'waktu_transaksi' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ]);
    }

    public function getData()
    {
        // Transaksi withdraw
        $transaksiWithdraw = DB::table('transaksi_withdraw')
            ->join('transaksi', 'transaksi_withdraw.id_withdraw', '=', 'transaksi.id_transaksi')
            ->where('transaksi.id_siswa', '=', Auth::user()->id_siswa)
            ->get();

        $transaksiWithdraw->map(function ($item) {
            $item->waktu_transaksi = date('d F Y H:i:s', strtotime($item->waktu_transaksi));
            return $item;
        });

        // dd($transaksiWithdraw);

        // Transaksi beli
        $transaksiBeli = DB::table('transaksi_beli')
            ->join('transaksi', 'transaksi_beli.id_beli', '=', 'transaksi.id_transaksi')
            ->join('barang', 'transaksi_beli.id_barang', '=', 'barang.id_barang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->where('transaksi.id_siswa', '=', Auth::user()->id_siswa)
            ->get();

        $transaksiBeli->map(function ($item) {
            $item->waktu_transaksi = date('d F Y H:i:s', strtotime($item->waktu_transaksi));
            return $item;
        });
        
        // Barang terjual
        $barangTerjual = DB::table('transaksi_beli')
            ->join('transaksi', 'transaksi_beli.id_beli', '=', 'transaksi.id_transaksi')
            ->join('barang', 'transaksi_beli.id_barang', '=', 'barang.id_barang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->where('barang.id_siswa_penjual', '=', Auth::user()->id_siswa)
            ->get();

        $barangTerjual->map(function ($item) {
            $item->waktu_transaksi = date('d F Y H:i:s', strtotime($item->waktu_transaksi));
            return $item;
        });

        return Response()->json([
            'transaksiWithdraw' => $transaksiWithdraw, 
            'transaksiBeli' => $transaksiBeli,
            'barangTerjual' => $barangTerjual
        ]);
    }
}
