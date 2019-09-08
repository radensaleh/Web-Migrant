<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PesananTokoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'kd_pesanan' => $this->kd_pesanan,
            'kd_transaksi' => $this->kd_transaksi,
            'total_harga' => $this->total_harga,
            'ongkir' => $this->ongkir,
            'no_resi' => $this->no_resi,
            'kota' => $this->city,
            'status' => $this->status,
            'estimasi_pengiriman' => $this->estimasi_pengiriman,
            'kurir' => $this->kurir,
            'nama_service' => $this->nama_service,
            'alamat_lengkap' => $this->alamat_lengkap,
            'list_barang' => $this->list_barang
        ];
    }
}
