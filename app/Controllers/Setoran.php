<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelSetoran;

class Setoran extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelSetoran();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data = $this->model->orderBy('tanggal', 'desc')->findAll();
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
        // $data = $this->request->getPost();

        $potong = substr($this->request->getVar('tanggal'), 5, 2);
        $bulan = bulan($potong);
        $data = [
            'nama_koran' => $this->request->getVar('nama_koran'),
            'bulan' => $bulan,
            'tanggal' => $this->request->getVar('tanggal'),
            'jumlah' => $this->request->getVar('jumlah'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->request->getVar('created_by'),
            'updated_at' => '0000-00-00 00:00:00',
            'updated_by' => 'none'
        ];

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
        $input = $this->request->getRawInput();

        $isExist = $this->model->find($id);
        if (!$isExist) return $this->failNotFound("Data tidak ditemukan dengan id : $id");

        $potong = substr($input['tanggal'], 5, 2);
        $bulan = bulan($potong);
        $data = [
            'nama_koran' => $input['nama_koran'],
            'tanggal' => $input['tanggal'],
            'bulan' => $bulan,
            'jumlah' => $input['jumlah'],
            'created_at' => $isExist['created_at'],
            'created_by' => $isExist['created_by'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $input['updated_by']
        ];

        // return $this->respond($data);

        if (!$this->model->update($id, $data)) return $this->fail($this->model->errors());

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
        $data = $this->model->where('id', $id)->findAll();
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
