<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $allowedFields = ["email", "verify", "created_at"];

    protected $validationRules = [
        "email"         => 'required|valid_email',
        "verify"        => 'required',
        "created_at"    => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required'      => 'Email tidak boleh kosong',
            'valid_email'   => 'email tidak valid',
        ],
        'verify' => [
            'required' => 'verify tidak boleh kosong'
        ],
        'created_at' => [
            'required' => 'created_at tidak boleh kosong'
        ],

    ];

    public function hitungUser()
    {
        $query = $this->get();
        return $query->getNumRows();
    }
}
