<?php

namespace App\Controllers;

use App\Models\ModelKoran;
use App\Models\ModelSetoran;
use App\Models\ModelUser;

class Dashboard extends BaseController
{

    function __construct()
    {
        $this->setoran = new ModelSetoran();
        $this->model = new ModelKoran();
        $this->user = new ModelUser();
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
            view('dashboard_view', $data) .
            view('template/footer');
    }
}
