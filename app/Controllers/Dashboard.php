<?php

namespace App\Controllers;

use App\Models\ModelKoran;
use App\Models\ModelSetoran;
use App\Models\ModelUser;
use App\Models\ModelLogin;

class Dashboard extends BaseController
{

    function __construct()
    {
        $this->setoran = new ModelSetoran();
        $this->model = new ModelKoran();
        $this->user = new ModelUser();
        $this->admin = new ModelLogin();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $tanggal = date('Y-m-d');
        $bulan = date('Y-m');
        $data['mitra'] = $this->model->hitung();

        $data['setoran'] = $this->setoran->hitungsetoran();

        $today = $this->setoran->where('tanggal', $tanggal)->get();
        $data['today'] = $today->getNumRows();

        $month = $this->setoran->like('tanggal', $bulan)->get();
        $data['month'] = $month->getNumRows();

        $data['user'] = $this->user->hitungUser();

        return  view('template/header') .
            view('template/sidebar') .
            view('dashboard_view', $data) .
            view('template/footer');
    }

    public function ubahPW($id)
    {
        $baru = md5($this->request->getPost('pwBaru'));
        $konfirm = md5($this->request->getPost('pwKonfirm'));
        $data = $this->admin->where('id', $id)->first();
        if ($baru === $konfirm) {
            if ($data) {
                $nilai = [
                    'password' => $baru,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->admin->update($id, $nilai);
                session()->destroy();
                return redirect()->to('/');
            } else {
                session()->setFlashData('error', 'data tidak ditemukan');
                return redirect()->to('/dashboard');
            }
        } else {
            session()->setFlashData('error', 'konfirmasi password salah');
            return redirect()->to('/dashboard');
        }
    }
}
