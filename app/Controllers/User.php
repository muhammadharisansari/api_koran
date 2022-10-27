<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelUser;

class User extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelUser();
        date_default_timezone_set("Asia/makassar");
    }

    public function create()
    {
        $email = $this->request->getPost('email');
        $existEmail = $this->model->where('email', $email)->findAll();

        $data = [
            'email' => $email,
            'pin' => md5($this->request->getPost('pin')),
            'verify' => 'N',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        //--------- jika email sudah ada maka tidak disimpan
        if ($existEmail == null) return $this->fail('Email sudah terdaftar sebelumnya');
        //--------- jika data gagal disimpan maka tampilkan pesan error
        if (!$this->model->save($data)) return $this->fail($this->model->errors());
        $response = [
            'massages' => [
                'success' => 'Berhasil memasukkan data user'
            ],
            'data' => $data
        ];
        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $ambil = $this->request->getRawInput();

        $isExist = $this->model->find($id);
        if (!$isExist) return $this->failNotFound("User tidak ditemukan dengan id : $id");

        $data = [
            'pin' => md5($ambil['pin']),
            'email' => $isExist['email'],
            'verify' => $isExist['verify'],
            'created_at' => $isExist['created_at'],
        ];

        if (!$this->model->update($id, $data)) return $this->fail($this->model->errors());

        $response = [
            'messages' => [
                'success' => "Data id : $id berhasil diupdate"
            ],
            'data' => $data
        ];

        return $this->respondUpdated($response);
    }
}
