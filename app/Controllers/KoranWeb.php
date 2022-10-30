<?php

namespace App\Controllers;

use App\Models\ModelKoran;

class KoranWeb extends BaseController
{

    function __construct()
    {
        $this->model = new ModelKoran();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data['mitra'] = $this->model->orderBy('id_koran', 'desc')->findAll();
        // dd($data);
        return  view('template/header') .
            view('koranWeb_view', $data) .
            view('template/footer');
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama_mitra' => 'required',
            ],
            [   // Errors
                'nama_mitra' => [
                    'required' => 'Form koran harus diisi',
                ],
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $data = [
                'koran' => $this->request->getPost('nama_mitra'),
                'created_by' => 'admin web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'none',
                'updated_at' => '0000-00-00 00:00:00'
            ];

            $this->model->save($data);

            session()->setFlashData('pesan', 'Data berhasil disimpan');
        } else {
            session()->setFlashData('error', $validation->listErrors());
        }
        // dd($data);
        return redirect('koranweb');
    }

    public function update($id)
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'nama_mitra' => 'required',
            ],
            [   // Errors
                'nama_mitra' => [
                    'required' => 'Form koran harus diisi',
                ],
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $isExist = $this->model->where('id_koran', $id)->findAll();
            $data = [
                'koran' => $this->request->getPost('nama_mitra'),
                'updated_by' => 'admin web',
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            // dd($data);
            if ($isExist) {
                $this->model->update($id, $data);
                session()->setFlashData('pesan', 'Data berhasil diperbarui');
            } else {
                session()->setFlashData('error', 'ID tidak ditemukan');
            }
        } else {
            session()->setFlashData('error', $validation->listErrors());
        }

        return redirect('koranweb');
    }

    public function delete($id)
    {
        $data = $this->model->where('id_koran', $id)->findAll();
        if (!$data) {
            session()->setFlashData('error', 'ID tidak ditemukan');
        }

        $this->model->delete($id);
        session()->setFlashData('pesan', 'Data berhasil dihapus');

        return redirect('koranweb');
    }
}
