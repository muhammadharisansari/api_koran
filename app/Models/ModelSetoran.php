<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetoran extends Model
{
    protected $table = "setoran";
    protected $primaryKey = "id";
    protected $allowedFields = ["nama_koran", "bulan", "tanggal", "jumlah", "created_at", "updated_at"];

    protected $validationRules = [
        "nama_koran"    => 'required',
        "bulan"         => 'required',
        "tanggal"       => 'required',
        "jumlah"        => 'required',
        "created_at"    => 'required',
        "updated_at"    => 'required',
    ];

    protected $validationMessages = [
        'nama_koran' => [
            'required' => 'Nama koran tidak boleh kosong'
        ],
        'bulan' => [
            'required' => 'bulan tidak boleh kosong'
        ],
        'tanggal' => [
            'required' => 'tanggal tidak boleh kosong'
        ],
        'jumlah' => [
            'required' => 'jumlah tidak boleh kosong'
        ],
        'created_at' => [
            'required' => 'created_at tidak boleh kosong'
        ],
        'updated_at' => [
            'required' => 'updated_at tidak boleh kosong'
        ],

    ];

    public function hitungsetoran()
    {
        $query = $this->get();
        return $query->getNumRows();
    }
}
