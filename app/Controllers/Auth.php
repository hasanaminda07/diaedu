<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function index()
    {
        helper(['form']);
        $username = $this->request->getVar('a1=35%'); // Mendekripsi username
        $password = $this->request->getVar('c#6*a'); // Mendekripsi password

        if (!empty($username && $password)) {
            // Jika ada inputan, arahkan ke metode login
            return $this->_login();
        } else {
            // Jika tidak ada inputan, tampilkan view login
            echo view('login');
        }
    }



    private function _login()
    {
        $session = session();
        $model = new AuthModel();
        $username = base64_decode($this->request->getVar('a1=35%')); // Mendekripsi username
        $password = base64_decode($this->request->getVar('c#6*a')); // Mendekripsi password
        $data = $model->where('username', $username)->first();
        if ($data) {
            if ($data['aktif'] == 0) {
                $session->setFlashdata('title', 'Mohon Maaf');
                $session->setFlashdata('message', 'Akun Belum Aktif');
                $session->setFlashdata('icon', 'error');
                return redirect()->to('');
            } else if ($data['aktif'] == 1) {
                $pass = $data['password'];
                $verify_pass = password_verify($password, $pass);
                if ($verify_pass) {
                    $ses_data = [
                        'username' => $data['username'],
                        'name' => $data['name'],
                        'role_id' => base64_encode($data['role_id']),
                        'tkn' => base64_encode($data['name']),
                    ];
                    $session->set($ses_data);
                    if ($data['role_id'] == 1) {
                        return redirect()->to('apps/dema');
                    } else if ($data['role_id'] == 2) {
                        return redirect()->to('apps/dem');
                    } else {
                        return redirect()->to('');
                    }
                } else {
                    $session->setFlashdata('title', 'Mohon Maaf');
                    $session->setFlashdata('message', 'Password Salah');
                    $session->setFlashdata('icon', 'error');
                    return redirect()->to('');
                }
            } else {
                return redirect()->to('');
            }
        } else {
            $session->setFlashdata('title', 'Mohon Maaf');
            $session->setFlashdata('message', 'User Tidak Ditemukan');
            $session->setFlashdata('icon', 'error');
            return redirect()->to('');
        }
    }

    public function lo()
    {
        // Hapus semua data sesi
        session()->destroy();

        // Set pesan logout dinamis
        session()->setFlashdata('message', 'Anda Telah Keluar Dari Sistem');

        // Redirect ke halaman login
        return redirect()->to('');
    }
}
