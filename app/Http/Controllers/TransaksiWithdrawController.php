<?php

namespace App\Http\Controllers;

use App\Models\transaksi_withdraw;
use App\Http\Requests\Storetransaksi_withdrawRequest;
use App\Http\Requests\Updatetransaksi_withdrawRequest;

class TransaksiWithdrawController extends Controller
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
     * @param  \App\Http\Requests\Storetransaksi_withdrawRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetransaksi_withdrawRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi_withdraw  $transaksi_withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi_withdraw $transaksi_withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi_withdraw  $transaksi_withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi_withdraw $transaksi_withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetransaksi_withdrawRequest  $request
     * @param  \App\Models\transaksi_withdraw  $transaksi_withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetransaksi_withdrawRequest $request, transaksi_withdraw $transaksi_withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi_withdraw  $transaksi_withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi_withdraw $transaksi_withdraw)
    {
        //
    }
}
