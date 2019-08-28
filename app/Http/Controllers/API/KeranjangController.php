<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Barang;
use App\ListBarangKeranjang;
use App\Keranjang;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get Keranjang by kd_user
    public function index($kd_user)
    {
        $keranjang = Keranjang::where('kd_user',$kd_user)->first();

        if ($keranjang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada keranjang'
            ]);
        }
        else {
            return response()->json([
                $keranjang
            ]);
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

                if($barang->toko->kd_toko == $listBarangKeranjang->barang->toko->kd_toko && $kd_user == $listBarangKeranjang->keranjang->kd_user)
                    {
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
    //Update Keranjang
    public function updateKeranjang(Request $request)
    {
        $keranjang = Keranjang::findOrFail($request->$kd_user);
        $keranjang->update($request->all());

        if($keranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Success update keranjang'
            ],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_keranjang)
    {
        $keranjang = Keranjang::destroy($id_keranjang);

        if ($keranjang) {
            return response()->json([
                'response' => true,
                'message' => 'Keranjang berhasil di hapus'
            ],200);
        }
    }
}
