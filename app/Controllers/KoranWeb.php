<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelKoran;

class KoranWeb extends BaseController
{
    use ResponseTrait;



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

        $data['koran'] = $this->request->getPost('nama_mitra');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = '0000-00-00 00:00:00';
        // dd($data);

        if (!$this->model->save($data)) return $this->fail($this->model->errors());
        return redirect('koranweb');
    }

    public function update($id)
    {
        $data['koran'] = $this->request->getPost('nama_mitra');

        $data['id_koran'] = $id;
        // dd($data);
        $isExist = $this->model->where('id_koran', $id)->findAll();
        if ($isExist) {
            if (!$this->model->save($data)) return $this->fail($this->model->errors());
        }


        return redirect('koranweb');
    }

    public function delete($id)
    {
        $data = $this->model->where('id_koran', $id)->findAll();
        if (!$data) {
            return $this->failNotFound("Data dengan id : $id tidak ditemukan");
        }

        $this->model->delete($id);

        return redirect('koranweb');
    }
}
