<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBeli;
use App\Http\Requests\StoreTransaksiBeliRequest;
use App\Http\Requests\UpdateTransaksiBeliRequest;

class TransaksiBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiBeliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiBeliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiBeli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiBeli $transaksi_beli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiBeli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiBeli $transaksi_beli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiBeliRequest  $request
     * @param  \App\Models\TransaksiBeli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiBeliRequest $request, TransaksiBeli $transaksi_beli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiBeli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiBeli $transaksi_beli)
    {
        //
    }
}
