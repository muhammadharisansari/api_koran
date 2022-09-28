<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKoran extends Model
{
    protected $table = "koran";
    protected $primaryKey = "id_koran";
    protected $allowedFields = ["koran", "created_at", "updated_at"];

    protected $validationRules = [
        "koran"         => 'required',
        // "created_at"    => 'required',
    ];

    protected $validationMessages = [
        'koran' => [
            'required' => 'Nama koran tidak boleh kosong'
        ],
        // 'created_at' => [
        //     'required' => 'created_at tidak boleh kosong'
        // ],
    ];

    public function hitung()
    {
        $query = $this->get();
        return $query->getNumRows();
    }
}
