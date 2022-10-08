<?php

namespace App\Controllers;

// use CodeIgniter\API\ResponseTrait;

use App\Models\ModelSetoran;

use App\Models\ModelKoran;

class SetoranWeb extends BaseController
{
    // use ResponseTrait;

    function __construct()
    {

        $this->model = new ModelSetoran();
        $this->modelKoran = new ModelKoran();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data['koran']      = $this->modelKoran->findAll();
        $data['setoran']    = $this->model->orderBy('tanggal', 'desc')->findAll();
        return view('template/header') .
            view('setoranWeb_view', $data) .
            view('template/footer');
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama_mitra' => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required',
            ],
            [   // Errors
                'nama_mitra' => [
                    'required' => 'Form koran harus diisi',
                ],
                'tanggal' => [
                    'required' => 'Form tanggal harus diisi',
                ],
                'jumlah' => [
                    'required' => 'Form jumlah harus diisi',
                ],
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {

            $potong = substr($this->request->getPost('tanggal'), 5, 2);
            $bulan = bulan($potong);

            $data = [
                'nama_koran' => $this->request->getPost('nama_mitra'),
                'bulan' => $bulan,
                'tanggal' => $this->request->getPost('tanggal'),
                'jumlah' => $this->request->getPost('jumlah'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => '0000-00-00 00:00:00'
            ];

            if (!$this->model->save($data)) {
                session()->setFlashData('error', 'Data gagal disimpan');
            }
            session()->setFlashData('pesan', 'Data berhasil disimpan');
        } else {
            session()->setFlashData('error', $validation->listErrors());
        }
        // dd($data);
        return redirect('setoranweb');
    }

    public function update($id)
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama_mitra' => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required',
            ],
            [   // Errors
                'nama_mitra' => [
                    'required' => 'Form koran harus diisi',
                ],
                'tanggal' => [
                    'required' => 'Form tanggal harus diisi',
                ],
                'jumlah' => [
                    'required' => 'Form jumlah harus diisi',
                ],
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $isExist = $this->model->where('id', $id)->findAll();
            if ($isExist) {

                $potong = substr($this->request->getPost('tanggal'), 5, 2);
                $bulan = bulan($potong);

                $data = [
                    'nama_koran' => $this->request->getPost('nama_mitra'),
                    'bulan' => $bulan,
                    'tanggal' => $this->request->getPost('tanggal'),
                    'jumlah' => $this->request->getPost('jumlah'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->model->update($id, $data);

                session()->setFlashData('pesan', 'Data berhasil diperbarui');
            } else {
                session()->setFlashData('error', 'Data tidak ditemukan');
            }
        } else {
            session()->setFlashData('error', $validation->listErrors());
        }
        // dd($data);
        return redirect('setoranweb');
    }

    public function delete($id)
    {
        $data = $this->model->where('id', $id)->findAll();
        if (!$data) {
            return session()->setFlashData('error', 'Data tidak ditemukan');
        }

        $this->model->delete($id);
        session()->setFlashData('pesan', 'Data berhasil diperbarui');

        return redirect('setoranweb');
    }
}
