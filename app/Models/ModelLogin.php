<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id";
    protected $allowedFields = ["nama", "password", "updated_at"];

    protected $validationRules = [
        "nama"         => 'required',
        "password"    => 'required',
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama tidak boleh kosong'
        ],
        'password' => [
            'required' => 'password tidak boleh kosong'
        ],
    ];
}
