<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $allowedFields = ["email", "pin", "verify", "created_at"];

    protected $validationRules = [
        "email"         => 'required|valid_email',
        "pin"           => 'required',
        "verify"        => 'required',
        "created_at"    => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'email tidak valid',
        ],
        'pin' => [
            'required' => 'Nama koran tidak boleh kosong'
        ],
        'verify' => [
            'required' => 'verify tidak boleh kosong'
        ],
        'created_at' => [
            'required' => 'created_at tidak boleh kosong'
        ],

    ];

    public function hitung()
    {
        $query = $this->get();
        return $query->getNumRows();
    }

}
