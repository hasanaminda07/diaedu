<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BasicModel;
use App\Models\UserMModel;

class Daftar extends BaseController
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
        $password1 = $this->request->getPost('password1');
        $password2 = $this->request->getPost('password2');
        $name = $this->request->getPost('name');

        if (!empty($username) && !empty($password1) && !empty($password2) && !empty($name)) {
            return $this->_reg();
        } else {
            return view('register'); // Pastikan view ini tersedia
        }
    }

    private function _reg()
    {
        $username = $this->request->getPost('username');
        $password1 = $this->request->getPost('password1');
        $password2 = $this->request->getPost('password2');
        $name = $this->request->getPost('name');

        // Cek apakah username sudah ada
        if ($this->authModel->where('username', $username)->first()) {
            session()->setFlashdata('title', 'Mohon Maaf');
            session()->setFlashdata('message', 'Username sudah digunakan');
            session()->setFlashdata('icon', 'error');
            return redirect()->to('daftar')->withInput();
        }

        // Aturan validasi
        $validationRules = [
            'password1' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]|matches[password2]',
                'errors' => [
                    'min_length' => 'Password terlalu pendek (minimal 8 karakter)',
                    'regex_match' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol',
                    'matches' => 'Password tidak sama',
                ],
            ],
        ];

        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('title', 'Gagal');
            session()->setFlashdata('message', implode(', ', $this->validation->getErrors()));
            session()->setFlashdata('icon', 'error');
            return redirect()->to('daftar')->withInput();
        }

        // Hash password
        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

        // Simpan data user
        $userData = array(
            'name' => $name,
            'username' => $username,
            'password' => $hashedPassword,
            'role_id' => 2,
            'date_created' => date('Y-m-d'),
            'theme' => 'light',
            'aktif' => 0
        );
        $this->basicModel->insert_($userData, 'user');

        // Buat token untuk aktivasi akun
        $token = base64_encode(random_bytes(32));
        $token = strtr($token, '+/', '-_'); // Mengubah + menjadi -, dan / menjadi _ untuk URL-Safe
        $tokenData = array(
            'username' => $username,
            'token' => $token,
            'date_created' => date('Y-m-d')
        );

        $this->basicModel2->insert_($tokenData, 'tbl_token');


        $email = \Config\Services::email();
        $config = new \Config\Email();
        $email->initialize($config->adminDiabEdu);
        $email->setFrom($config->adminDiabEdu['SMTPUser'], 'DiaEdu');

        $email->setTo($username); // If it's already a string, use it as is
        $email->setSubject('Aktivasi Akun DiaEdu');

        // Membuat isi email dengan format profesional
        $message = "<div style='font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 20px;'>";

        // Header
        $message .= "<div style='padding: 20px; color: white;'>";
        $message .= '<img src="' . base_url('assets/images/logo.png') . '" width="300px"></img>';
        $message .= "</div>";

        // Isi Email
        $message .= "<div style='background-color: white; padding: 20px; border-radius: 5px; margin-top: 20px;'>";
        $message .= "<p>Yth. " . $name . ",</p><br>";


        $message .= "<p>Terima kasih anda telah melakukan registerasi akun DiaEdu. Untuk melakukan aktivasi akun anda dapat klik pada tombol dibawah<br></p>";
        $link = base_url('daftar/aktif/') . $token . "/" . base64_encode($username);
        $message .= "<p> <a href='$link' style='color: #ffffff; background-color: #007bff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Aktivasi Akun</a></p>";

        $message .= "<br><p><b>Token berlaku hanya untuk hari ini</b>. Untuk mengajukan permintaan token ulang, anda dapat klik pada tombol dibawah<br></p>";
        $link = base_url('daftar/generatetoken/') . $token . "/" . base64_encode($username);
        $message .= "<p> <a href='$link' style='color: #ffffff; background-color: #007bff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Minta Token Baru</a></p>";

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
            session()->setFlashdata('message', 'Silakan buka email anda dan lakukan aktivasi');
            session()->setFlashdata('icon', 'success');
        } else {
        }

        return redirect()->to('daftar');
    }


    public function aktif()
    {
        $uri = $this->request->getUri();
        $token = $uri->getSegment(3);
        $username = base64_decode($uri->getSegment(4));

        $username_token_db = $this->userMModel->get_username_token($username, $token);
        if (!empty($username_token_db)) {
            if ($username_token_db['date_created'] == date('Y-m-d')) {
                $data1 = array(
                    'aktif' => 1
                );
                $where1 = array(
                    'username' => $username
                );
                $this->basicModel->update_($where1, $data1, 'user');

                $where2 = array(
                    'username' => $username
                );
                $this->basicModel->delete_($where2, 'tbl_token');
                session()->setFlashdata('title', 'Akun Aktif');
                session()->setFlashdata('message', 'Silakan silahkan login');
                session()->setFlashdata('icon', 'success');
                return redirect()->to('');
            } else {
                $where2 = array(
                    'username' => $username
                );
                $this->basicModel->delete_($where2, 'tbl_token');
                session()->setFlashdata('title', 'Gagal');
                session()->setFlashdata('message', 'Token sudah tidak berlaku. Silahkan lakukan permintaan token ulang melalui link yang ada di email anda');
                session()->setFlashdata('icon', 'error');
                return redirect()->to('');
            }
        } else {
            session()->setFlashdata('title', 'Gagal');
            session()->setFlashdata('message', 'Token tidak valid');
            session()->setFlashdata('icon', 'error');
            return redirect()->to('');
        }
    }

    public function generatetoken()
    {
        $uri = $this->request->getUri();
        $tokenlama = $uri->getSegment(3);
        $username = base64_decode($uri->getSegment(4));
        $db = $this->authModel->where('username', $username)->first();
        $name = $db['name'];
        $where1 = array(
            'username' => $username
        );
        $this->basicModel->delete_($where1, 'tbl_token');

        $token = base64_encode(random_bytes(32));
        $token = strtr($token, '+/', '-_'); // Mengubah + menjadi -, dan / menjadi _ untuk URL-Safe
        $tokenData = array(
            'username' => $username,
            'token' => $token,
            'date_created' => date('Y-m-d')
        );

        $this->basicModel2->insert_($tokenData, 'tbl_token');


        $email = \Config\Services::email();
        $config = new \Config\Email();
        $email->initialize($config->adminDiabEdu);
        $email->setFrom($config->adminDiabEdu['SMTPUser'], 'DiaEdu');

        $email->setTo($username); // If it's already a string, use it as is
        $email->setSubject('Aktivasi Akun DiaEdu');

        // Membuat isi email dengan format profesional
        $message = "<div style='font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 20px;'>";

        // Header
        $message .= "<div style='padding: 20px; color: white;'>";
        $message .= '<img src="' . base_url('assets/images/logo.png') . '" width="300px"></img>';
        $message .= "</div>";

        // Isi Email
        $message .= "<div style='background-color: white; padding: 20px; border-radius: 5px; margin-top: 20px;'>";
        $message .= "<p>Yth. " . $name . ",</p><br>";


        $message .= "<p>Terima kasih anda telah melakukan registerasi akun DiaEdu. Untuk melakukan aktivasi akun anda dapat klik pada tombol dibawah<br></p>";
        $link = base_url('daftar/aktif/') . $token . "/" . base64_encode($username);
        $message .= "<p> <a href='$link' style='color: #ffffff; background-color: #007bff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Aktivasi Akun</a></p>";

        $message .= "<br><p><b>Token berlaku hanya untuk hari ini</b>. Untuk mengajukan permintaan token ulang, anda dapat klik pada tombol dibawah<br></p>";
        $link = base_url('daftar/generatetoken/') . $token . "/" . base64_encode($username);
        $message .= "<p> <a href='$link' style='color: #ffffff; background-color: #007bff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Minta Token Baru</a></p>";

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
            session()->setFlashdata('message', 'Silakan buka email anda dan lakukan aktivasi');
            session()->setFlashdata('icon', 'success');
            return redirect()->to('');
        } else {
        }
    }
}
