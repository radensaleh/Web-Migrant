<?php

namespace App\Http\Controllers\API;

use App\Pesanan;
use App\ListBarang;
use App\Transaksi;
use App\Keranjang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends Controller
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

    //CreatePesanan
    public function createPesanan(Request $request)
    /*Parameter
        $kd_user = $request->kd_user;
        $nama_penerima = $request->nama_penerima;
        $city_id = $request->city_id;
        $ongkirs = $request->ongkir;

    */
    {
        $kd_user = $request->kd_user;
        $nama_penerima = $request->nama_penerima;
        $city_id = $request->city_id;
        $ongkirs = $request->ongkir;
        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_transaksi = 'TRX'.str_replace(' ','',$jam);

        //Dari tb keranjang
        // $kd_barangs = $request->kd_barang;
        // $kuantitass = $request->kuantitas;
        // $hargas = $request->harga;

        //Data dari Keranjang untuk dimasukkan ke pesanan dan listBarang
        $keranjang = Keranjang::where('kd_user', $kd_user)->get();
        $total_harga_pesanan = 0;

        for($j=0; $j<sizeof($keranjang); $j++) {
            $getDate = Carbon::now('Asia/Jakarta');
            $tgl = str_replace('-','', $getDate);
            $jam = str_replace(':','', $tgl);
            $kd_pesanan = 'PSN'.str_replace(' ','',$jam).$i;

            //GetListBarangKeranjang
            $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $keranjang->id_keranjang)->get();
            //Input Ke listBarang
            for($i=0; $i<sizeof($listBarangKeranjang); $i++) {
                $dataBarang = [
                    'kd_pesanan' => $kd_pesanan,
                    'kd_barang' => $listBarangKeranjang[$i]->kd_barang,
                    'kuantitas' => $listBarangKeranjang[$i]->kuantitas,
                    'harga' => $listBarangKeranjang[$i]->harga
                ];
                $total_harga_pesanan += $listBarangKeranjang[$i]->harga;
                ListBarang::create($dataBarang);
            } //End For
            $dataPesanan = [
                'kd_pesanan' => $kd_pesanan,
                'kd_transaksi' => $kd_transaksi,
                //Total Harga Pesanan
                'total_harga' => $total_harga_pesanan,
                'ongkir' => $ongkirs[$j],
                'city_id' => $city_id,
                'id_status' => 1,
            ];
            $total_ongkir += $ongkirs[$j];
            Pesanan::create($dataPesanan);
        } //End For
        $transaksi = [
            'kd_transaksi' => $kd_transaksi,
            'kd_user' => $kd_user,
            'tgl_transaksi' => Carbon::now()->format('d.m.Y'),
            //Total Harga Transaksi, ini belum ditambah dengan keuntungan untuk migrantshop
            'total_harga' => $total_harga_pesanan + $total_ongkir,
            'nama_penerima' => $nama_penerima
        ];
        $transaksi = Transaksi::create($transaksi);

        if($transaksi) {
            return response()->json([
                'response' => true,
                'message' => 'Transaction Successfull'
            ]);
        } else {
            return response()->json([
                'response' => false,
                'message' => 'Transaction Failed !'
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
