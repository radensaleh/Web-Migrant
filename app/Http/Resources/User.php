<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
                'kd_user' =>$this->kd_user,
                'nama_lengkap' =>$this->nama_lengkap,
                'jenis_kelamin' =>$this->jenis_kelamin,
                'nomer_hp' => $this->nomer_hp,
                'email' => $this->email,
                'provinsi' => $this->provinsi,
                'daerah' => $this->daerah,
                'nama_daerah' => $this->nama_daerah,
                'detail_alamat' => $this->detail_alamat,
                'status' =>$this->status,
                'foto_user' => $this->foto_user
            ];
    }
}
