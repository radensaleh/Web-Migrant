<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Barang;
use App\ListBarangKeranjang;
use App\Keranjang;
use App\Toko;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get Keranjang by kd_user
    public function index()
    {
      $kd_user=request()->kd_user;
        $keranjang = Keranjang::where('kd_user',$kd_user)->get();

        $listKeranjang=[];

        for($i=0;$i<sizeof($keranjang);$i++){

          $barang = DB::table('tb_barang')
                    ->join('tb_list_barang_keranjang', 'tb_barang.kd_barang', '=', 'tb_list_barang_keranjang.kd_barang')
                    ->select('*')
                    ->where('tb_list_barang_keranjang.id_keranjang', $keranjang[$i]->id_keranjang)
                    ->get();
          $toko= Toko::where('kd_toko', $barang[0]->kd_toko)->first();
            $listKeranjang[$i]=[
              'id_keranjang' => $keranjang[$i]->id_keranjang,
              'toko' => $toko,
              'list_barang' => $barang
            ];
        }

        if ($keranjang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada keranjang'
            ]);
        }
        else {
            return response()->json(
                $listKeranjang
            );
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Create Keranjang
    public function tambahBarangKeranjang(Request $request)
    /* ==Parameter
        -kd_barang, ->required
        -kuantitas, ->required
        -kd_user -> required
    */
    {
        $kd_barang = $request->kd_barang;
        $kuantitas = $request->kuantitas;
        $kd_user = $request->kd_user;

        $barang = Barang::where('kd_barang', $kd_barang)->first();
        $keranjang = Keranjang::where('kd_user', $kd_user)->get();

        if($barang->stok >= $kuantitas) {
            if(count($keranjang)==0) {
                //CreateKeranjang
                $data = array(
                    'kd_user' => $kd_user
                );
                $createKeranjang = Keranjang::create($data);
                //Insert Ke ListBarangKeranjang
                $listBarangKeranjang = new ListBarangKeranjang;
                $listBarangKeranjang->id_keranjang = $createKeranjang->id_keranjang;
                $listBarangKeranjang->kd_barang= $kd_barang;
                $listBarangKeranjang->kuantitas = $kuantitas;
                $listBarangKeranjang->harga = $barang->harga_jual;

                if($listBarangKeranjang->save()) {
                    return response()->json([
                        'response' => true,
                        'message' => 'Data Berhasil Dimasukkan ke Keranjang'
                    ]);
                } else {
                    return response()->json([
                        'response' => false,
                        'message' => 'Failed !'
                    ]);
                }

            } //end if
            else
            {
                /* Start for ke 1 */
                for($i=0; $i<sizeof($keranjang); $i++) {
                    $id_keranjang = $keranjang[$i]->id_keranjang;
                    $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $id_keranjang)->first();

                    //untuk digunakan handle ketika user klik barang yang sama
                    $barangKeranjang = ListBarangKeranjang::where('id_keranjang', $id_keranjang)->get();

                    if($barang->toko->kd_toko == $listBarangKeranjang->barang->toko->kd_toko
                    && $kd_user == $listBarangKeranjang->keranjang->kd_user)
                        {
                            for($n=0; $n<sizeof($barangKeranjang); $n++) {
                                if($kd_barang == $barangKeranjang[$n]->kd_barang) {
                                    //Handle
                                    $kuantitas = $barangKeranjang[$n]->kuantitas+1;
                                    $barangKeranjang[$n]->kuantitas = $kuantitas;
                                    $barangKeranjang[$n]->save();

                                    return response()->json([
                                        'response' => true,
                                        'message' => 'Berhasil ditambahkan !'
                                    ]);

                                }
                            } //End For

                            for ($z=0; $z<sizeof($barangKeranjang); $z++) {
                                if($kd_barang != $barangKeranjang[$z]->kd_barang) {
                                    $data = array(
                                        'id_keranjang' => $id_keranjang,
                                        'kd_barang' => $kd_barang,
                                        'kuantitas' => $kuantitas,
                                        'harga' => $barang->harga_jual
                                    );

                                    if($createListBarangKeranjang = ListBarangKeranjang::create($data)) {
                                        return response()->json([
                                            'response' => true,
                                            'message' => 'Data Berhasil Ditambah ke Keranjang'
                                        ]);
                                    } //end If
                                } //end if
                            } //end for

                        } //End If
                }// End For ke 1

                /* Start For ke 2*/
                for($i=0; $i<sizeof($keranjang); $i++) {
                    $id_keranjang = $keranjang[$i]->id_keranjang;
                    $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $id_keranjang)->first();

                    if($barang->toko->kd_toko != $listBarangKeranjang->barang->toko->kd_toko && $kd_user == $listBarangKeranjang->keranjang->kd_user)
                        {
                            $dataKeranjang = array(
                                'kd_user' => $kd_user
                            );

                            $keranjang = Keranjang::create($dataKeranjang);
                            $data = array(
                                'id_keranjang' => $keranjang->id_keranjang,
                                'kd_barang' => $kd_barang,
                                'kuantitas' => $kuantitas,
                                'harga' => $barang->harga_jual
                            );

                            if($createListBarangKeranjang = ListBarangKeranjang::create($data)) {
                                return response()->json([
                                    'response' => true,
                                    'message' => 'Data Berhasil Ditambah ke Keranjang'
                                ]);
                            } //end If

                        } //End If
                }// End For ke 2
            } //end else
        } //End IF
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Limit'
            ]);
        }
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
    /*Parameter
        -kd_user
        -kd_barang
    */
    public function deleteBarangKeranjang(Request $request)
    {
        $keranjang = Keranjang::where('kd_user', $request->kd_user)->get();

        for($i=0; $i<sizeof($keranjang); $i++) {
            $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $keranjang[$i]->id_keranjang)->get();

            for($j=0; $j<sizeof($listBarangKeranjang); $j++) {

                $get_id_list_keranjang = ListBarangKeranjang::where('kd_barang', $request->kd_barang)
                ->where('id_keranjang', $keranjang[$i]->id_keranjang)->first();
                if ($request->kd_barang == $listBarangKeranjang[$j]->kd_barang && sizeof($listBarangKeranjang) == 1) {
                    //Hapus Barang dan Hapus Keranjang
                    $deleteBarangKeranjang = ListBarangKeranjang::destroy($get_id_list_keranjang->id_list_keranjang);
                    $deleteKeranjang = Keranjang::destroy($keranjang[$i]->id_keranjang);

                    if($deleteBarangKeranjang && $deleteKeranjang) {
                        return response()->json([
                            'response' => true,
                            'message' => 'Barang dan Keranjang dihapus '
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
                else
                {
                    //Hapus Barang
                    $deleteBarangKeranjang = ListBarangKeranjang::destroy($get_id_list_keranjang->id_list_keranjang);
                    if ($deleteBarangKeranjang) {
                        return response()->json([
                            'response' => true,
                            'message' => 'Barang dikeranjang dihapus '
                        ]);
                    }
                    else {
                        return response()->json([
                            'response' => false,
                            'message' => 'Failed ! di else'
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Update Keranjang
    /**
     * Parameter
     *id_keranjang
     *kd_barang
     *kuantitas_baru
     */
    //Update Stok Barang yang akan dibeli dikeranjang
    public function updateStokBarangKeranjang(Request $request)
    {
        $kd_barang = $request->kd_barang;
        $kuantitasBaru = $request->kuantitas_baru;
        $id_keranjang=$request->$id_keranjang;
        $listBarangKeranjang = ListBarangKeranjang::where('id_keranjang', $id_keranjang)->get();

        for($i=0; $i<sizeof($listBarangKeranjang); $i++) {
            if($kd_barang == $listBarangKeranjang[$i]->kd_barang) {
                $kuantitas = $kuantitasBaru;

                //ambil stok Barang
                $stokBarang = Barang::where('kd_barang', $kd_barang)->first();

                if($kuantitas <= $stokBarang->stok) {

                $updateKuantitas = DB::table('tb_list_barang_keranjang')
                ->where('id_keranjang', $request->id_keranjang)
                ->where('kd_barang', $kd_barang)
                ->update(['kuantitas' => $kuantitas]);
                    if($updateKuantitas==1) {
                        return response()->json([
                            'response' => true,
                            'message' => 'Berhasil update kuantitas'
                        ]);
                    }
                } //end if
                else
                {
                    return response()->json([
                        'response' => false,
                        'message' => 'Failed kuantitas melebihi stok !'
                    ]);
                }
            } // end if
        } //End For
        return response()->json([
            'response' => false,
            'message' => 'Tidak terupdate, kuantitas sama seperti sebelumnya !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      $id_keranjang=request()->id_keranjang;
        $keranjang = Keranjang::destroy($id_keranjang);

        if ($keranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Keranjang berhasil di hapus'
            ],200);
        }
    }
}
