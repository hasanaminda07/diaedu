<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;


class DEMA extends BaseController
{

    // Index -------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['jml_artikel'] = $this->ArtikelModel->jumlah_artikel();
        $data['jml_akun'] = $this->UserMModel->jumlah_akun();
        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dema/index', $data);
        echo view('templates/footer');
    }





    public function artikel_list()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['artikel'] = $this->ArtikelModel->get_all_artikel();

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dema/artikel/artikel_list', $data);
        echo view('templates/footer');
    }
    public function artikel_add_form()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();


        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dema/artikel/artikel_add_form', $data);
        echo view('templates/footer');
    }

    public function upload()
    {
        $file = $this->request->getFile('upload');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getName(); // Menggunakan nama asli file
            $file->move('gallery', $newName);

            $imageUrl = base_url('gallery/' . $newName);
            return $this->response->setJSON(['url' => $imageUrl]);
        }

        return $this->response->setJSON(['error' => 'Gagal mengunggah gambar.']);
    }

    public function gallery()
    {
        $path = FCPATH . 'gallery/'; // Pastikan folder ada di public/gallery
        $files = array_diff(scandir($path), ['.', '..']);

        $images = [];
        foreach ($files as $file) {
            if (is_file($path . $file)) {
                $images[] = [
                    'src' => base_url('gallery/' . $file),
                    'thumb' => base_url('gallery/' . $file),
                    'name' => $file
                ];
            }
        }

        return $this->response->setJSON($images);
    }



    public function delete()
    {
        $filename = $this->request->getPost('filename'); // Ambil nama file dari POST
        $filePath = FCPATH . 'gallery/' . $filename;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return $this->response->setJSON([
                    "status" => "success",
                    "message" => "Gambar berhasil dihapus."
                ]);
            } else {
                return $this->response->setJSON([
                    "status" => "error",
                    "message" => "Gagal menghapus gambar."
                ])->setStatusCode(500);
            }
        }

        return $this->response->setJSON([
            "status" => "error",
            "message" => "Gambar tidak ditemukan."
        ])->setStatusCode(404);
    }



    public function artikel_add_control()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $judul = $this->request->getPost('judul');
        $kategori = $this->request->getPost('kategori');
        $banner = $this->request->getPost('banner');
        $konten = $this->request->getPost('konten');
        $created_by = $data['user']['name'];
        $created_date = date('Y-m-d H:i:s');
        $modified_by = $data['user']['name'];
        $modified_date = date('Y-m-d H:i:s');

        $data = array(
            'judul' => $judul,
            'kategori' => $kategori,
            'banner' => $banner,
            'konten' => $konten,
            'created_by' => $created_by,
            'created_date' => $created_date,
            'modified_by' => $modified_by,
            'modified_date' => $modified_date,
        );

        $this->BasicModel->insert_($data, 'tbl_artikel');
        session()->setFlashdata('message', 'Artikel Berhasil Ditambahkan');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dema/artikel_list');
    }

    public function artikel_delete_control()
    {
        $id = $this->request->getPost('id');
        $where = array(
            'id' => $id
        );

        $this->BasicModel->delete_($where, 'tbl_artikel');
        session()->setFlashdata('message', 'Artikel Berhasil Dihapus');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dema/artikel_list');
    }



    public function artikel_update_form()
    {
        $id = $this->request->getPost('id');
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();
        $data['artikel'] = $this->ArtikelModel->get_artikel_by_id($id);

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dema/artikel/artikel_update_form', $data);
        echo view('templates/footer');
    }
    public function artikel_update_control()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $kategori = $this->request->getPost('kategori');
        $banner = $this->request->getPost('banner');
        $konten = $this->request->getPost('konten');
        $modified_by = $data['user']['name'];
        $modified_date = date('Y-m-d H:i:s');

        $data = array(
            'judul' => $judul,
            'kategori' => $kategori,
            'banner' => $banner,
            'konten' => $konten,
            'modified_by' => $modified_by,
            'modified_date' => $modified_date,
        );

        $where = array(
            'id' => $id
        );

        $this->BasicModel->update_($where, $data, 'tbl_artikel');
        session()->setFlashdata('message', 'Artikel Berhasil Disimpan');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dema/artikel_list');
    }



    public function akun_list()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['akun'] = $this->UserMModel->get_all_user();

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dema/akun/akun_list', $data);
        echo view('templates/footer');
    }


    public function akun_delete_control()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $id = $this->request->getPost('id');

        $where = array(
            'id' => $id
        );

        $this->BasicModel->delete_($where, $data, 'tbl_artikel');
        session()->setFlashdata('message', 'Akun Berhasil Dihapus');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dema/akun_list');
    }
}
