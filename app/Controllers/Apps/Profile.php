<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;


class Profile extends BaseController
{
    public function index()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('profile', $data);
        echo view('templates/footer');
    }
    public function ganti_tema()
    {
        $user = $this->UserModel->where('username', session()->get('username'))->first();
        $theme = $this->request->getPost('theme');

        $data = array(
            'theme' => $theme
        );

        $where = array(
            'username' => $user['username']
        );


        $this->BasicModel->update_($where, $data, 'user');
        session()->setFlashdata('message', 'Tema Berhasil Disimpan');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/profile');
    }



    public function profile_update_control()
    {


        $id = $this->request->getPost('id');

        $D2 = $this->request->getPost('name');
        $check = $this->request->getPost('check');


        $ps1 = $this->request->getPost('password1');
        $ps2 = $this->request->getPost('password2');

        if ($check == 1) {
            $validationRules = [
                'password1' => 'trim|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]|matches[password2]',
            ];

            $validationMessages = [

                'password1' => [
                    'min_length' => 'Password terlalu pendek (minimal 8 karakter)',
                    'regex_match' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol',
                    'matches' => 'Password tidak sama'
                ],
            ];

            $this->validation->setRules($validationRules, $validationMessages);

            // Run the validation
            if (!$this->validation->withRequest($this->request)->run()) {
                // If validation fails, display error message
                $data['validation'] = $this->validation;
                foreach ($this->validation->getErrors() as $field => $error) {
                    switch ($error) {
                        case 'The username field must contain a unique value.':
                            $errorMessage = $validationMessages['is_unique'];
                            break;
                        case 'The password1 field does not match the password2 field.':
                            $errorMessage = $validationMessages['matches'];
                            break;
                        case 'The password1 field must be at least 8 characters in length.':
                            $errorMessage = $validationMessages['min_length'];
                            break;
                        case 'The password1 field is not in the correct format.':
                            $errorMessage = $validationMessages['regex_match'];
                            break;
                        default:
                            $errorMessage = $error;
                            break;
                    }
                }
                session()->setFlashdata('message', $errorMessage);
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
                return redirect()->to('apps/profile');
            } else {
                $D8 = password_hash($this->request->getPost('password1'), PASSWORD_DEFAULT);
                $user = $this->UserModel->where('username', session()->get('username'))->first();

                $data = array(
                    'name' => $D2,
                    'password' => $D8
                );

                $where = array(
                    'id' => $id,
                );


                session()->setFlashdata('message', 'Perubahan Akun Berhasil Disimpan');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Sukses');
                $this->BasicModel->update_($where, $data, 'user');
                return redirect()->to('auth/lo');
            }
        } else {
            $user = $this->UserModel->where('username', session()->get('username'))->first();

            $data = array(
                'name' => $D2,
            );

            $where = array(
                'id' => $id,
            );

            session()->setFlashdata('message', 'Perubahan Akun Berhasil Disimpan');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Sukses');
            $this->BasicModel->update_($where, $data, 'user');
            return redirect()->to('apps/profile');
        }
    }
}
