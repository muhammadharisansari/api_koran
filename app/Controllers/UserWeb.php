<?php

namespace App\Controllers;


use App\Models\ModelUser;

class UserWeb extends BaseController
{
    function __construct()
    {
        $this->model = new ModelUser();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data['user'] = $this->model->orderBy('id', 'desc')->findAll();
        // dd($data);
        return  view('template/header') .
            view('userWeb_view', $data) .
            view('template/footer');
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'email' => 'required|valid_email',
                'pin' => 'required|max_length[6]|min_length[6]',
            ],
            [   // Errors
                'email' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'email tidak valid',
                ],
                'pin'   => [
                    'required' => 'PIN tidak boleh kosong',
                    'max_length' => 'Maksimal PIN 6 karakter',
                    'min_length' => 'PIN harus 6 karakter',
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $email = $this->request->getPost('email');
            $existEmail = $this->model->where('email', $email)->findAll();

            $data = [
                'email' => $email,
                'pin' => md5($this->request->getPost('pin')),
                'verify' => 'N',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            //--------- jika email sudah ada maka tidak disimpan
            if ($existEmail) {
                session()->setFlashdata('error', 'email sudah terdaftar');
            } else {
                $this->model->save($data);
                session()->setFlashData('pesan', 'Data berhasil disimpan');
            }
        } else {
            session()->setFlashData('error', $validation->listErrors());
        }

        return redirect('userweb');
    }


    public function update($id = null)
    {
        $ambil = $this->request->getRawInput();

        $validation =  \Config\Services::validation();
        $validation->setRules(
            [
                'pin' => 'required|max_length[6]|min_length[6]',
                'pinconfirm' => 'required|matches[pin]',
            ],
            [   // Errors
                'pin'   => [
                    'required' => 'PIN tidak boleh kosong',
                    'max_length' => 'Maksimal PIN 6 karakter',
                    'min_length' => 'PIN harus 6 karakter',
                ],
                'pinconfirm'   => [
                    'required' => 'Konfirmasi PIN tidak boleh kosong',
                    'matches' => 'Konfirmasi PIN salah',
                ]
            ]
        );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $isExist = $this->model->find($id);
            if (!$isExist) {
                session()->setFlashdata('error', "User tidak ditemukan dengan id : $id");
            } else {
                $data = [
                    'pin' => md5($ambil['pin']),
                ];
                $this->model->update($id, $data);
                session()->setFlashdata('pesan', "PIN diperbarui");
            }
        } else {
            session()->setFlashdata('error', $validation->listErrors());
        }
        return redirect('userweb');
    }

    public function delete($id)
    {
        $data = $this->model->where('id', $id)->findAll();
        if (!$data) {
            session()->setFlashData('error', 'User tidak ditemukan');
        }

        $this->model->delete($id);
        session()->setFlashData('pesan', 'Data berhasil dihapus');

        return redirect('userweb');
    }

    public function verify($id)
    {
        $verify = $this->request->getRawInput();
        if ($verify['verify'] != 'N') {
            $data = [
                'verify' => 'N',
            ];
            $this->model->update($id, $data);
            session()->setFlashdata('pesan', "Status diperbarui");
        } else {
            $data = [
                'verify' => 'Y',
            ];
            $this->model->update($id, $data);
            session()->setFlashdata('pesan', "Status diperbarui");
        }
        return redirect('userweb');
    }
}
