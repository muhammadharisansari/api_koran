<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKoran extends Model
{
    protected $table = "koran";
    protected $primaryKey = "id_koran";
    protected $allowedFields = ["koran", "created_at", "created_by", "updated_at", "updated_by"];

    protected $validationRules = [
        "koran"         => 'required',
        "created_at"    => 'required',
        "created_by"    => 'required',
        "updated_at"    => 'required',
        "updated_by"    => 'required',
    ];

    protected $validationMessages = [
        'koran' => [
            'required' => 'Nama koran tidak boleh kosong'
        ],
        'created_at' => [
            'required' => 'created_at tidak boleh kosong'
        ],
        'created_by' => [
            'required' => 'created_by tidak boleh kosong'
        ],
        'updated_at' => [
            'required' => 'updated_at tidak boleh kosong'
        ],
        'updated_by' => [
            'required' => 'updated_by tidak boleh kosong'
        ],
    ];

    public function hitung()
    {
        $query = $this->get();
        return $query->getNumRows();
    }
}
