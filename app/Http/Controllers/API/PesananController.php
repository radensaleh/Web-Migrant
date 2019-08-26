<?php

namespace App\Http\Controllers\API;

use App\Pesanan;
use App\ListBarang;
use App\Transaksi;
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
        ArrayListPesanan yang didalamnya terdapat 
        atribut array
        -kd_user
        -nama_penerima
        -ongkir
        -no_resi
        -city_id,
        -kd_barang
        -kuantitas
        -harga

    */
    {
        $kd_user = $request->kd_user;
        $nama_penerima = $request->nama_penerima;
        $city_id = $request->city_id;
        $ongkir = 
        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $kd_transaksi = 'TRX'.str_replace(' ','',$jam);

        //Dari tb keranjang
        // $kd_barangs = $request->kd_barang;
        // $kuantitass = $request->kuantitas;
        // $hargas = $request->harga;

        $total_harga_pesanan = 0;

        for($j=0; $j<sizeof($listPesanan); $j++) {
            $getDate = Carbon::now('Asia/Jakarta');
            $tgl = str_replace('-','', $getDate);
            $jam = str_replace(':','', $tgl);
            $kd_pesanan = 'PSN'.str_replace(' ','',$jam).$i;
            //Input Ke listBarang
            for($i=0; $i<sizeof($kd_barangs); $i++) {
                $dataBarang = [
                    'kd_pesanan' => $kd_pesanan,
                    'kd_barang' => $kd_barangs[$i],
                    'kuantitas' => $kuantitass[$i],
                    'harga' => $hargas[$i]
                ];
                $total_harga_pesanan += $hargas[$i];
                ListBarang::create($dataBarang);
            } //End For
            $dataPesanan = [
                'kd_pesanan' => $kd_pesanan,
                'kd_transaksi' => $kd_transaksi,
                'total_harga' => $total_harga_pesanan,
                'ongkir' => $ongkirs[$j],
                'no_resi' => $no_resis[$j],
                'city_id' => $citys_id[$j],
                'id_status' => 1,
            ];
            $total_ongkir += $ongkir[$j];
            Pesanan::create($dataPesanan);
        } //End For
        $transaksi = [
            'kd_transaksi' => $kd_transaksi,
            'kd_user' => $kd_user,
            'tgl_transaksi' => Carbon::now()->format('d.m.Y'),
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
