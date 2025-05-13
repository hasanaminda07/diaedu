<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BasicModel;
use App\Models\UserMModel;

class Reset extends BaseController
{
    protected $validation;
    protected $authModel;
    protected $basicModel;
    protected $basicModel2;
    protected $userMModel;

    public function __construct()
    {
        helper(['form']);
        $this->validation = \Config\Services::validation();
        $this->authModel = new AuthModel();
        $this->basicModel = new BasicModel();
        $this->basicModel2 = new BasicModel();
        $this->userMModel = new UserMModel();
    }

    public function index()
    {
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');

        if (!empty($username)  && !empty($name)) {
            return $this->_reset();
        } else {
            return view('reset'); // Pastikan view ini tersedia
        }
    }

    private function _reset()
    {
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');

        // Cek apakah username sudah ada
        $data = $this->authModel
            ->where('username', $username)
            ->orWhere('name', $name)
            ->first();

        if ($data) {
            $password = substr(bin2hex(random_bytes(2)), 0, 4);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                'password' => $hashedPassword,
            );

            $where = array(
                'username' => $username
            );

            $this->basicModel->update_($where, $data, 'user');

            $email = \Config\Services::email();
            $config = new \Config\Email();
            $email->initialize($config->adminDiabEdu);
            $email->setFrom($config->adminDiabEdu['SMTPUser'], 'DiaEdu');

            $email->setTo($username); // If it's already a string, use it as is
            $email->setSubject('Reset Akun DiaEdu');

            // Membuat isi email dengan format profesional
            $message = "<div style='font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 20px;'>";

            // Header
            $message .= "<div style='padding: 20px; color: white;'>";
            $message .= '<img src="' . base_url('assets/images/logo.png') . '" width="300px"></img>';
            $message .= "</div>";

            // Isi Email
            $message .= "<div style='background-color: white; padding: 20px; border-radius: 5px; margin-top: 20px;'>";
            $message .= "<p>Yth. " . $name . ",</p><br>";


            $message .= "<p>Password anda telah diubah menjadi : " . $password . "<br></p>";

            $message .= "<br><p>Terima kasih atas perhatian Anda.</p>";

            // Footer
            $message .= "</div>";
            $message .= "<div style='text-align: center; font-size: 12px; color: #999; margin-top: 20px;'>";
            $message .= "<p>DiaEdu</p>";
            $message .= "<p>Ini adalah email otomatis, mohon tidak membalas email ini.</p>";
            $message .= "</div>";
            $message .= "</div>";

            // Set isi pesan
            $email->setMessage($message);
            if ($email->send()) {
                session()->setFlashdata('title', 'Sukses');
                session()->setFlashdata('message', 'Password berhasil diubah dan password baru akan dikirim di email');
                session()->setFlashdata('icon', 'success');
                return redirect()->to('');
            } else {
            }
        } else {
            session()->setFlashdata('title', 'Tidak ada akun');
            session()->setFlashdata('message', 'Silahkan hubungi admin melalui email');
            session()->setFlashdata('icon', 'error');
            return redirect()->to('');
        }
    }
}
