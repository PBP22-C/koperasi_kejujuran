<?php

namespace App\Http\Controllers;

use App\Models\transaksi_beli;
use App\Http\Requests\Storetransaksi_beliRequest;
use App\Http\Requests\Updatetransaksi_beliRequest;

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
     * @param  \App\Http\Requests\Storetransaksi_beliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetransaksi_beliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi_beli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi_beli $transaksi_beli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi_beli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi_beli $transaksi_beli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetransaksi_beliRequest  $request
     * @param  \App\Models\transaksi_beli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetransaksi_beliRequest $request, transaksi_beli $transaksi_beli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi_beli  $transaksi_beli
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi_beli $transaksi_beli)
    {
        //
    }
}
