<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;


class DEM extends BaseController
{

    // Index -------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['gula'] = $this->GulaModel->get_guladarah_by_user_top(base64_encode($data['user']['username']));

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/index', $data);
        echo view('templates/footer');
    }
    public function chat_list()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/chat_list', $data);
        echo view('templates/footer');
    }
    public function artikel_list()
    {
        $perPage = 6; // Jumlah artikel per halaman

        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['artikel'] = $this->ArtikelDEMModel->get_all_artikel($perPage);
        $data['pager'] = $this->ArtikelDEMModel->pager; // Pager untuk pagination

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/artikel_list', $data);
        echo view('templates/footer');
    }

    public function artikel_detail()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();
        $uri = $this->request->getUri();
        $id = base64_decode($uri->getSegment(4));
        $data['artikel'] = $this->ArtikelModel->get_artikel_by_id($id);


        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/artikel_detail', $data);
        echo view('templates/footer');
    }



    public function guladarah_list()
    {

        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $data['gula'] = $this->GulaModel->get_guladarah_by_user(base64_encode($data['user']['username']));



        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/GulaDarah/guladarah_list', $data);
        echo view('templates/footer');
    }
    public function guladarah_add_form()
    {

        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();


        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/GulaDarah/guladarah_add_form', $data);
        echo view('templates/footer');
    }
    public function guladarah_add_control()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $guladarah = $this->request->getPost('guladarah');
        $tanggal = $this->request->getPost('tanggal');


        $data = array(
            'guladarah' => $guladarah,
            'tanggal' => $tanggal,
            'ak' => base64_encode($data['user']['username']),
        );

        $this->BasicModel->insert_($data, 'tbl_guladarah');
        session()->setFlashdata('message', 'Data Gula Darah Berhasil Ditambahkan');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dem/guladarah_list');
    }

    public function guladarah_update_form()
    {

        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();
        $id = $this->request->getPost('id');
        $data['gula'] = $this->GulaModel->get_guladarah_by_id($id);

        echo view('templates/header', $data);
        echo view('templates/topbar', $data);
        echo view('templates/sidebar', $data);
        echo view('dem/GulaDarah/guladarah_update_form', $data);
        echo view('templates/footer');
    }

    public function guladarah_update_control()
    {
        $data['user'] = $this->UserModel->where('username', session()->get('username'))->first();

        $id = $this->request->getPost('id');
        $guladarah = $this->request->getPost('guladarah');
        $tanggal = $this->request->getPost('tanggal');


        $data = array(
            'guladarah' => $guladarah,
            'tanggal' => $tanggal
        );

        $where = array(
            'id' => $id
        );

        $this->BasicModel->update_($where, $data, 'tbl_guladarah');
        session()->setFlashdata('message', 'Data Gula Darah Berhasil Ditambahkan');
        session()->setFlashdata('icon', 'success');
        session()->setFlashdata('title', 'Sukses');
        return redirect()->to('apps/dem/guladarah_list');
    }
}
