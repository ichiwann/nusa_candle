@extends('layouts.pembeli')

@section('title', 'Detail Transaksi #' . str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) . ' - NusaCandle')

@section('content')
    @include('pages.pembeli.partials.detail_transaksi_content', ['transaksi' => $transaksi])
@endsection
