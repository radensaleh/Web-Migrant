<?php

namespace App\Http\Controllers\API;

use App\Pesanan;
use App\ListBarang;
use App\ListBarangKeranjang;
use App\Transaksi;
use App\Bank;
use App\Keranjang;
use App\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function konfirmasiPesanan(Request $request)
    {
        $kd_pesanan = $request->kd_pesanan;

        $pesanan = Pesanan::findOrFail($kd_pesanan);
        
        if($pesanan) {
            $pesanan->id_status = 3;
            $pesanan->save();

            return response()->json([
                'response' => true,
                'message' => 'Berhasil Konfirmasi Pesanan'
            ]);
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Failed konfirmasi pesanan !'
            ]);
        }
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


        //Data dari Keranjang untuk dimasukkan ke pesanan dan listBarang
        $keranjang = Keranjang::where('kd_user', $kd_user)->get();
        $total_harga_pesanan = 0;
        $total_ongkir = 0;
        $total_harga_all_pesanan = 0;
        $comission_fee = 0;

        //Create Transaksi
        $dataTransaksi = array(
            'kd_transaksi' => $kd_transaksi,
            'kd_user' => $kd_user,
            'nama_penerima' => $nama_penerima
        );
        Transaksi::create($dataTransaksi);

        for($j=0; $j<sizeof($keranjang); $j++) {
            $getDate = Carbon::now('Asia/Jakarta');
            $tgl = str_replace('-','', $getDate);
            $jam = str_replace(':','', $tgl);
            $kd_pesanan = 'PSN'.str_replace(' ','',$jam).$j;

            //GetListBarangKeranjang
            $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $keranjang[$j]->id_keranjang)->get();
            //CreatePesanan
            $dataPesanan = array (
                'kd_pesanan' => $kd_pesanan,
                'kd_transaksi' => $kd_transaksi,
                'city_id' => $city_id,
                'id_status' => 1,
            );
            Pesanan::create($dataPesanan);
            //Input Ke listBarang
            for($i=0; $i<sizeof($listBarangKeranjang); $i++) {
                $dataBarang = array(
                    'kd_pesanan' => $kd_pesanan,
                    'kd_barang' => $listBarangKeranjang[$i]->kd_barang,
                    'kuantitas' => $listBarangKeranjang[$i]->kuantitas,
                    'harga' => $listBarangKeranjang[$i]->harga
                ); 
                $total_harga_pesanan += $listBarangKeranjang[$i]->harga*$listBarangKeranjang[$i]->kuantitas;
                ListBarang::create($dataBarang);
                //Update Stok Barang
                $barang = Barang::where('kd_barang',$listBarangKeranjang[$i]->kd_barang)->first();
                $stokBarang = $barang->stok;
                $updateStok = array (
                    'stok' => $stokBarang-$listBarangKeranjang[$i]->kuantitas);

                $updateBarang = Barang::findOrFail($listBarangKeranjang[$i]->kd_barang);
                $updateBarang->update($updateStok);
            } //End For 2
            $total_harga_all_pesanan += $total_harga_pesanan;
            $pesanan = [
                'kd_pesanan' => $kd_pesanan,
                'kd_transaksi' => $kd_transaksi,
                //Total Harga Pesanan
                'total_harga' => $total_harga_pesanan,
                'ongkir' => $ongkirs[$j],
                'city_id' => $city_id,
                'id_status' => 1,
            ];
            $total_ongkir += $ongkirs[$j];
            $updatePesanan = Pesanan::findOrFail($kd_pesanan);
            $updatePesanan->update($pesanan);
            $total_harga_pesanan = 0;
        } //End For 1
        $comission_fee = ($total_harga_all_pesanan + $total_ongkir) * 5 / 100;
        $transaksi = [
            'kd_transaksi' => $kd_transaksi,
            'kd_user' => $kd_user,
            'tgl_transaksi' => Carbon::now('Asia/Jakarta'),
            //Total Harga Transaksi, sudah plus keuntungan migrant
            'total_harga' => $total_harga_all_pesanan + $total_ongkir + $comission_fee,
            'nama_penerima' => $nama_penerima
        ];
        $updateTransaksi = Transaksi::findOrFail($kd_transaksi);
        $bank = Bank::first();

        if($updateTransaksi->update($transaksi)) {
            for($i=0; $i<sizeof($keranjang); $i++) {
                DB::table('tb_list_barang_keranjang')->where('id_keranjang', $keranjang[$i]->id_keranjang)->delete();
            }
            DB::table('tb_keranjang')->where('kd_user', $kd_user)->delete();
            return response()->json([
                'response' => true,
                'message' => 'Transaction Successfull',
                'transaksi' => $updateTransaksi,
                'bank' => $bank
            ]);
        } else {
            return response()->json([
                'response' => false,
                'message' => 'Transaction Failed !'
            ]);
        } //end else

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Upload Resi per pesanan
    /* Parameter
        -kd_pesanan,
        -no_resi
    */
    public function upload(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->kd_pesanan);
        
        if($pesanan->update($request->all())) {
            DB::table('tb_pesanan')->where('kd_pesanan', $request->kd_pesanan)->update(['id_status' => 4]);
            return response()->json([
                'response' => true,
                'message' => 'upload nomor resi success'
            ]);
        } 
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'upload Failed !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Get Pesanan By kd_user
    /* Parameter 
        -kd_user
    */
    public function show(Request $request)
    {
        $kd_user = $request->kd_user;
        $pesanan = Pesanan::where('id_status',1)
        ->whereHas('transaksi', function($query) {
            $query->where('kd_user', request('kd_user'));
        })->get();

        if($pesanan) {
            return response()->json(
                $pesanan
            );
        }
        else 
        {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada pesanan !'
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Get Pesanan By Toko
    /*Parameter
        -kd_toko
    */
    public function getPesananByToko(Request $request)
    {
        $kd_toko = $request->kd_toko;
        $pesanan = Pesanan::where('id_status', 2)
        ->whereHas('list_barang', function($query) {
            $query->whereHas('barang', function($query) {
                $query->where('kd_toko', request('kd_toko'));
            });
        })->first();

        return response()->json(
            $pesanan
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Api untuk konfirmasi barang diterima
    /*Parameter
        -kd_pesanan
    */
    public function finish(Request $request)
    {
       $finish = DB::table('tb_pesanan')->where('kd_pesanan', $request->kd_pesanan)->update(['id_status' => 5]);
       
       if($finish) {
           return response()->json([
               'response' => true,
               'message' => 'Barang sudah diterima '
           ]);
       }
       else 
       {
           return response()->json([
               'response' => false,
               'message' => 'Failed !'
           ]);
       }
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
