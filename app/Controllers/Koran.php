<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelKoran;

class Koran extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelKoran();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data = $this->model->orderBy('id_koran', 'desc')->findAll();
        $response = [
            'massages' => [
                'success' => 'Berhasil mengambil data koran'
            ],
            'data' => $data
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $response = [
                'massages' => [
                    'success' => 'Berhasil mengambil data koran'
                ],
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data dengan id : $id tidak ditemukan");
        }
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = '0000-00-00 00:00:00';

        if (!$this->model->save($data)) return $this->fail($this->model->errors());

        $response = [
            'massages' => [
                'success' => 'Berhasil memasukkan data koran'
            ],
            'data' => $data
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();

        $data['id_koran'] = $id;
        $isExist = $this->model->where('id_koran', $id)->findAll();
        if (!$isExist) return $this->failNotFound("Data tidak ditemukan dengan id : $id");

        if (!$this->model->save($data)) return $this->fail($this->model->errors());

        $response = [
            'messages' => [
                'success' => "Data id : $id berhasil diupdate"
            ],
            'data' => $data
        ];

        return $this->respondUpdated($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id_koran', $id)->findAll();
        if (!$data) {
            return $this->failNotFound("Data dengan id : $id tidak ditemukan");
        }

        $this->model->delete($id);
        $response = [
            'messages' => [
                'success' => "Data dengan id : $id berhasil dihapus"
            ]
        ];

        return $this->respondDeleted($response);
    }
}
