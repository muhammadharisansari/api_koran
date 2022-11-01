<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelLogin;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('login_view');
    }

    public function auth()
    {
        $session = session();
        $model = new ModelLogin();

        $nama = $this->request->getPost('nama');
        $password = md5($this->request->getPost('password'));
        // dd($password);

        $data = $model->where('nama', $nama)->first();
        if ($data) {
            $pass = $data['password'];
            // $verify_pass = password_verify($password, $pass);
            if ($pass === $password) {
                $ses_data = [
                    'id'        => $data['id'],
                    'nama'      => $data['nama'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashData('error', 'password salah');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashData('error', 'data tidak ditemukan');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
