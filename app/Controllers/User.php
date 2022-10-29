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

    public function show($email = null)
    {
        $existEmail = $this->model->where('email', $email)->findAll();
        if ($existEmail != null) {
            $response = [
                'massages' => [
                    'success' => 'email user ditemukan'
                ],
                'data' => $existEmail
            ];
            return $this->respond($response);
        } else {
            return $this->fail('email user sudah terdaftar sebelumnya');
        }
    }

    public function create()
    {
        $email = $this->request->getPost('email');
        $existEmail = $this->model->where('email', $email)->findAll();

        if ($existEmail) {
            $massage = 'email sudah terdaftar sebelumnya';
            $data = [];
        } else {
            $massage = 'email berhasil disimpan';
            $data = [
                'email' => $email,
                'verify' => 'N',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            //--------- jika data gagal disimpan maka tampilkan pesan error
            if (!$this->model->save($data)) return $this->fail($this->model->errors());
        }

        $response = [
            'massages' => [
                'Note' => $massage
            ],
            'data' => $data
        ];
        return $this->respond($response);
    }
}
