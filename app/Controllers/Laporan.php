<?php

namespace App\Controllers;

use App\Models\ModelKoran;
use App\Models\ModelSetoran;

class Laporan extends BaseController
{

    function __construct()
    {
        $this->setoran = new ModelSetoran();
        $this->model = new ModelKoran();
    }

    public function index()
    {
        $data['mitra'] = $this->model->hitung();
        $data['setoran'] = $this->setoran->hitungsetoran();
        // dd($data['mitra'], $data['setoran']);

        return  view('template/header') .
            view('laporan_view', $data) .
            view('template/footer');
    }
}
