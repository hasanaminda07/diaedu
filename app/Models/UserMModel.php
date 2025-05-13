<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMModel extends Model
{
    protected $protectFields = false;

    public function get_profile($username)
    {
        $builder = $this->db->table('user');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function get_all_user()
    {
        $builder = $this->db->table('user');
        $builder->where('id<>', 1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_all_user_by_id($id)
    {
        $builder = $this->db->table('user');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function jumlah_akun()
    {
        $builder = $this->db->table('user');
        $builder->where('id<>', 1);
        $num_rows = $builder->countAllResults();
        return $num_rows;
    }


    public function get_username_token($username, $token)
    {
        $builder = $this->db->table('tbl_token');
        $builder->where('username', $username);
        $builder->where('token', $token);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
