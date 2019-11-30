<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use App\ListBarang;
use App\Http\Resources\BarangResource;
use App\Toko;
use App\JenisBarang;
use Carbon\Carbon;
use DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Get All barang on table tb_barang
    public function index()
    {
        // $barangs = Barang::where('status_barang', 0)->get();
        $barangs = DB::table('tb_barang')
                  ->select('tb_barang.kd_barang', 'tb_barang.nama_barang', 'tb_barang.id_jenis', 'tb_barang.harga_jual', 'tb_barang.deskripsi', 'tb_barang.foto_barang', 'tb_barang.berat_barang', 'tb_barang.status_barang', 'tb_barang.satuan_barang', 'tb_barang.harga_modal_barang', 'tb_barang.status_stok' ,'toko.nama_toko', 'toko.kd_toko')
                  ->join('tb_toko as toko', 'toko.kd_toko', '=', 'tb_barang.kd_toko')
                  ->where('status_barang', 0)
                  ->get();

        //
        // $produkMasuk = DB::table('produk_masuk')
        //                ->where('id_produk', )

        if($barangs==null) {
            return response()->json([
                'response' => false,
                'message' => 'List Barang tidak tersedia !'
            ]);
        }
        else {
            $dataBarang = array();
            foreach ($barangs as $value) {
              $masukan = DB::table('produk_masuk')
                         ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_masuk');

              $keluar = DB::table('produk_keluar')
                         ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_keluar');

              $stok = $masukan - $keluar;

              $data['kd_barang']    = $value->kd_barang;
              $data['nama_barang']  = $value->nama_barang;
              $data['id_jenis']     = $value->id_jenis;
              $data['harga_jual']   = $value->harga_jual;
              $data['deskripsi']    = $value->deskripsi;
              $data['foto_barang']  = $value->foto_barang;
              $data['berat_barang'] = $value->berat_barang;
              $data['status_barang']= $value->status_barang;
              $data['satuan_barang']= $value->satuan_barang;
              $data['harga_modal_barang']= $value->harga_modal_barang;
              $data['status_stok']  = $value->status_stok;
              $data['stok']         = $stok;
              $data['nama_toko']    = $value->nama_toko;
              $data['kd_toko']      = $value->kd_toko;
              $dataBarang[] = $data;
            }

            return response()->json(
                $dataBarang
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Create Barang
    /*Parameter
        -kd_user
        -nama_barang
        -id_jenis
        -stok
        -harga_jual
        -deskripsi
        -foto_barang
        -berat_barang
    */
    public function createBarang(Request $request )
    {
        $barang = new Barang;
        $getDate = Carbon::now('Asia/Jakarta');
        $tgl = str_replace('-','', $getDate);
        $jam = str_replace(':','', $tgl);
        $rand = $jam . rand(1, 100);
        $kd_barang = 'BRG'.str_replace(' ','',$rand);
        $barang->kd_barang = $kd_barang;

        //findKode Toko
        $kd_toko = Toko::where('kd_user', $request->kd_user)->value('kd_toko');
        if($kd_toko==null) {
            return response()->json([
                'response' => false,
                'message' => 'Cant Find Kode Toko !'
            ]);
        }

        $barang->kd_toko = $kd_toko;
        $barang->nama_barang = $request->input('nama_barang');

        //Find ID Jenis
        $id_jenis = JenisBarang::where('id_jenis', $request->id_jenis)->first();
        if($id_jenis==null) {
            return [
                'response' => false,
                'message' => 'Cant find ID Jenis !'
            ];
        }
        $barang->id_jenis = $request->id_jenis;
        $barang->stok = $request->input('stok');
        $barang->harga_jual = $request->input('harga_jual');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->berat_barang = $request->input('berat_barang');
        $barang->status_barang = 0;

        //fotoBarang
        $fotoBrg = request()->file('foto_barang');
        $fotoBrg->move(public_path().'/images/barang', $kd_barang . "." . $fotoBrg->getClientOriginalExtension());
        $barang->foto_barang = $kd_barang . "." . $fotoBrg->getClientOriginalExtension();


        if($barang->save()) {
            return response()->json([
                'response' => true,
                'message' => 'Barang created successfull'
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

    public function createBarang2(Request $request){
      /*Parameter
          -kd_user
          -nama_barang
          -id_jenis
          -stok
          -harga_jual
          -deskripsi
          -foto_barang
          -berat_barang
          -satuan_barang
      */
      $barang = new Barang;
      // $getDate = Carbon::now('Asia/Jakarta');
      // $tgl = str_replace('-','', $getDate);
      // $jam = str_replace(':','', $tgl);
      // $rand = $jam . rand(1, 100);
      // $kd_barang = 'BRG'.str_replace(' ','',$rand);

      $kd_barang = rand();
      $barang->kd_barang = $kd_barang;

      //findKode Toko
      $kd_toko = Toko::where('kd_user', $request->kd_user)->value('kd_toko');
      if($kd_toko==null) {
          return response()->json([
              'response' => false,
              'message' => 'Cant Find Kode Toko !'
          ]);
      }

      $barang->kd_toko = $kd_toko;
      $barang->nama_barang = $request->input('nama_barang');

      //Find ID Jenis
      $id_jenis = JenisBarang::where('id_jenis', $request->id_jenis)->first();
      if($id_jenis==null) {
          return [
              'response' => false,
              'message' => 'Cant find ID Jenis !'
          ];
      }
      $barang->id_jenis = $request->id_jenis;
      //$barang->stok = $request->input('stok');
      $barang->harga_jual = $request->input('harga_jual');
      $barang->deskripsi = $request->input('deskripsi');
      $barang->berat_barang = $request->input('berat_barang');
      $barang->satuan_barang = $request->input('satuan_barang');
      $barang->status_barang = 0;
      $barang->status_stok = "Aktif";

      //fotoBarang
      $date = date('Ymd');
      $fotoBrg = request()->file('foto_barang');
      $fotoBrg->move(public_path().'/images/barang', "IMG_" . $date . "_" . $kd_barang . "." . $fotoBrg->getClientOriginalExtension());
      $barang->foto_barang = "IMG_" . $date . "_" . $kd_barang . "." . $fotoBrg->getClientOriginalExtension();

      //input table masuk produk
      $dateNow = Carbon::now('Asia/Jakarta');
      $produkMasuk = DB::table('produk_masuk')
                     ->insert([
                        'id_produk' => $kd_barang,
                        'qty_produk' => $request->input('stok'),
                        'tgl_masuk' => $dateNow
                    ]);

      $cekNamaProduk = DB::table('tb_barang')
                       ->where('nama_barang', $request->input('nama_barang'))
                       ->count();

      if($cekNamaProduk > 0){
          return response()->json([
              'response' => false,
              'message' => 'Barang Dengan Nama ' . $request->input('nama_barang')  . ' Sudah Tersedia !'
          ]);
      }else{
        if($barang->save() && $produkMasuk) {
            return response()->json([
                'response' => true,
                'message' => 'Barang ' . $request->input('nama_barang') . ' Berhasil Ditambahkan'
            ]);
        }else{
            return response()->json([
                'response' => false,
                'message' => 'Barang Gagal Ditambahkan !'
            ]);
        }
      }

    }


//Show By ID
/*Parameter
    -kd_barang
*/
    public function showById(Request $request){

      $kd_barang= request()->kd_barang;
      //Cek kd_barang ada di tb_list_barang ?
      $listBarang = ListBarang::where('kd_barang',$kd_barang);
      //handle barang yg gak ada di tb_list_barang
      $barang2 = DB::table('tb_barang')
      ->where('tb_barang.kd_barang', $kd_barang)
      ->join('tb_toko', 'tb_toko.kd_toko', '=', 'tb_barang.kd_toko')
      ->join('tb_kota', 'tb_kota.city_id', '=', 'tb_toko.city_id')
      ->join('tb_provinsi', 'tb_provinsi.province_id', '=', 'tb_kota.province_id')
      ->select('tb_barang.kd_barang','tb_barang.nama_barang','tb_barang.deskripsi','tb_barang.foto_barang', 'tb_toko.kd_toko','tb_toko.nama_toko',
      'tb_toko.foto_toko', 'tb_kota.city_name', 'tb_kota.type', 'tb_provinsi.province',
      'tb_barang.harga_jual', 'tb_barang.berat_barang')
      ->get();

      //hitung stok
      $masukan = DB::table('produk_masuk')
                 ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                 ->where('id_produk', $kd_barang)
                 ->value('qty_masuk');

      $keluar = DB::table('produk_keluar')
                 ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                 ->where('id_produk', $kd_barang)
                 ->value('qty_keluar');

      $stok = $masukan - $keluar;

      $barang = DB::table('tb_barang')
      ->where('tb_barang.kd_barang', $kd_barang)
      ->join('tb_list_barang', 'tb_list_barang.kd_barang', '=', 'tb_barang.kd_barang')
      ->join('tb_toko', 'tb_toko.kd_toko', '=', 'tb_barang.kd_toko')
      ->join('tb_kota', 'tb_kota.city_id', '=', 'tb_toko.city_id')
      ->join('tb_provinsi', 'tb_provinsi.province_id', '=', 'tb_kota.province_id')
      ->select('tb_barang.kd_barang','tb_barang.nama_barang','tb_barang.deskripsi',
      'tb_barang.foto_barang', 'tb_toko.kd_toko','tb_toko.nama_toko',
      'tb_toko.foto_toko', 'tb_kota.city_name', 'tb_kota.type', 'tb_provinsi.province', DB::raw('SUM(tb_list_barang.kuantitas) as terjual'),
      'tb_barang.harga_jual', 'tb_barang.berat_barang')
      ->groupBy('tb_barang.kd_barang')
      ->get();

      if($barang==null) {
          foreach ($barang as $value) {
            $data['kd_barang']    = $value->kd_barang;
            $data['nama_barang']  = $value->nama_barang;
            $data['deskripsi']    = $value->deskripsi;
            $data['foto_barang']  = $value->foto_barang;
            $data['kd_toko']      = $value->kd_toko;
            $data['nama_toko']    = $value->nama_toko;
            $data['foto_toko']    = $value->foto_toko;
            $data['city_name']    = $value->city_name;
            $data['type']         = $value->type;
            $data['province']     = $value->province;
            $data['harga_jual']   = $value->harga_jual;
            $data['berat_barang'] = $value->berat_barang;
            $data['stok']         = $stok;
            $data['terjual']      = $value->terjual;
          }

          return response()->json(
              $data
          );
      } else {
          foreach ($barang2 as $value) {
            $data['kd_barang']    = $value->kd_barang;
            $data['nama_barang']  = $value->nama_barang;
            $data['deskripsi']    = $value->deskripsi;
            $data['foto_barang']  = $value->foto_barang;
            $data['kd_toko']      = $value->kd_toko;
            $data['nama_toko']    = $value->nama_toko;
            $data['foto_toko']    = $value->foto_toko;
            $data['city_name']    = $value->city_name;
            $data['type']         = $value->type;
            $data['province']     = $value->province;
            $data['harga_jual']   = $value->harga_jual;
            $data['berat_barang'] = $value->berat_barang;
            $data['stok']         = $stok;
          }

          return response()->json(
            $data
          );
      }
    }

    public function getBarangByKdPesanan(){
      $kd_pesanan = request()->kd_pesanan;

      $barang=DB::table('tb_barang')
        ->select('list_barang.kd_pesanan', 'tb_barang.nama_barang', 'tb_barang.kd_barang', 'tb_barang.id_jenis', 'list_barang.kuantitas', 'list_barang.harga')
        ->join('tb_list_barang as list_barang', 'list_barang.kd_barang', '=', 'tb_barang..kd_barang')
        ->where('list_barang.kd_pesanan', $kd_pesanan)
        ->get();

        if($barang==null) {
            return response()->json([
                'response' => true,
                'message' => 'Barang tidak ada !'
            ]);
        } else {
            return response()->json(
                $barang
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*Parameter
        -id_jenis
    */
    public function showByCategory()
    {
        $id_jenis=request()->id_jenis;

        //$barang = Barang::where('id_jenis',$id_jenis)->where('status_barang', 0)->get();
        $barang = DB::table('tb_barang')
                  ->select('tb_barang.kd_barang', 'tb_barang.nama_barang', 'tb_barang.id_jenis', 'tb_barang.harga_jual', 'tb_barang.deskripsi', 'tb_barang.foto_barang', 'tb_barang.berat_barang', 'tb_barang.status_barang', 'tb_barang.satuan_barang', 'tb_barang.harga_modal_barang', 'tb_barang.status_stok', 'toko.nama_toko', 'toko.kd_toko')
                  ->join('tb_toko as toko', 'toko.kd_toko', '=', 'tb_barang.kd_toko')
                  ->where('tb_barang.id_jenis', $id_jenis)
                  ->where('status_barang', 0)
                  ->get();

        if($barang==null) {
            return response()->json([
                'response' => true,
                'message' => 'Barang tidak ada !'
            ]);
        } else {
            $dataBarang = array();
            foreach ($barang as $value) {
              $masukan = DB::table('produk_masuk')
                         ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_masuk');

              $keluar = DB::table('produk_keluar')
                         ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_keluar');

              $stok = $masukan - $keluar;

              $data['kd_barang']    = $value->kd_barang;
              $data['nama_barang']  = $value->nama_barang;
              $data['id_jenis']     = $value->id_jenis;
              $data['harga_jual']   = $value->harga_jual;
              $data['deskripsi']    = $value->deskripsi;
              $data['foto_barang']  = $value->foto_barang;
              $data['berat_barang'] = $value->berat_barang;
              $data['status_barang']= $value->status_barang;
              $data['satuan_barang']= $value->satuan_barang;
              $data['harga_modal_barang']= $value->harga_modal_barang;
              $data['status_stok']  = $value->status_stok;
              $data['stok']         = $stok;
              $data['nama_toko']    = $value->nama_toko;
              $data['kd_toko']      = $value->kd_toko;
              $dataBarang[] = $data;
            }

            return response()->json(
                $dataBarang
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Menampilkan semua barang berdasarkan kd_toko
    /*Parameter
        -kd_toko
    */
    public function show(Request $request)
    {
        $kd_toko = Toko::where('kd_user', $request->kd_user)->value('kd_toko');
        $barang = Barang::where('kd_toko', $kd_toko)->where('status_barang', 0)->get();

        if($barang==null) {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada barang !'
            ]);
        }
        else {
            $dataBarang = array();
            foreach ($barang as $value) {
              $masukan = DB::table('produk_masuk')
                         ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_masuk');

              $keluar = DB::table('produk_keluar')
                         ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_keluar');

              $stok = $masukan - $keluar;

              $data['kd_barang']        = $value->kd_barang;
              $data['kd_toko']          = $value->kd_toko;
              $data['nama_barang']      = $value->nama_barang;
              $data['id_jenis']         = $value->id_jenis;
              $data['harga_jual']       = $value->harga_jual;
              $data['deskripsi']        = $value->deskripsi;
              $data['foto_barang']      = $value->foto_barang;
              $data['berat_barang']     = $value->berat_barang;
              $data['status_barang']    = $value->status_barang;
              $data['satuan_barang']    = $value->satuan_barang;
              $data['harga_modal_barang']= $value->harga_modal_barang;
              $data['status_stok']      = $value->status_stok;
              $data['stok']             = $stok;
              $data['created_at']       = $value->created_at;
              $data['updated_at']       = $value->updated_at;
              $dataBarang[] = $data;

            }

            return response()->json(
                $dataBarang
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBarang(Request $request)
    {
        $barang = Barang::destroy($request->kd_barang);
        if($barang) {
            return response()->json([
                'response' => true,
                'message' => 'Barang deleted !'
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Kode Barang
    /*Parameter
            -kd_barang ->required
            "nama_barang": "Kue", ->optional
            "id_jenis": 1, -> optional
            "stok": 30, -> optional
            "harga_jual": 10000, -> optional
            "deskripsi": "Kue ini enaaaaaak banget", -> optional
            "foto_barang": "http://foto.com", -> optional
            "berat_barang": 2, -> optional
            "status_barang": "0", -> optional
    */
    public function update(Request $request)
    {
        $barang = Barang::findOrFail($request->kd_barang);
        $barang->update($request->all());

        if($barang) {
            return response()->json([
                'response' => true,
                'message' => 'Success Update Barang'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBarangTerbaru()
    {
        $newestBarang = Barang::where('status_barang', 0)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        if($newestBarang) {
            $barangs = array();
            foreach ($newestBarang as $value) {
              $masukan = DB::table('produk_masuk')
                         ->select(DB::raw('SUM(qty_produk) as qty_masuk'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_masuk');

              $keluar = DB::table('produk_keluar')
                         ->select(DB::raw('SUM(qty_produk_keluar) as qty_keluar'))
                         ->where('id_produk', $value->kd_barang)
                         ->value('qty_keluar');

              $stok = $masukan - $keluar;

              $data['kd_barang']        = $value->kd_barang;
              $data['kd_toko']          = $value->kd_toko;
              $data['nama_barang']      = $value->nama_barang;
              $data['id_jenis']         = $value->id_jenis;
              $data['harga_jual']       = $value->harga_jual;
              $data['deskripsi']        = $value->deskripsi;
              $data['foto_barang']      = $value->foto_barang;
              $data['berat_barang']     = $value->berat_barang;
              $data['status_barang']    = $value->status_barang;
              $data['satuan_barang']    = $value->satuan_barang;
              $data['harga_modal_barang']= $value->harga_modal_barang;
              $data['status_stok']      = $value->status_stok;
              $data['stok']             = $stok;
              $data['created_at']       = $value->created_at;
              $data['updated_at']       = $value->updated_at;
              $barangs[] = $data;
            }
            return response()->json(
                //$newestBarang
                $barangs
            );
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada Barang !'
            ]);
        }
    }

    public function getBarangTokoByKodeUser()

    {
        //params
        //-kd_user
        $kd_user = request()->kd_user;

        $barang = Barang::whereHas('toko', function($query) {
            $query->where('kd_user', request('kd_user'));
        })->get();

        if(!$barang) {
            return BarangResource::collection($barang);
        }
        else
        {
            return response()->json([
                'response' => false,
                'message' => 'Tidak ada barang atau user tidak mempunyai toko'
            ]);
        }


    }

}
