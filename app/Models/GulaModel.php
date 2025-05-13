<?php

namespace App\Models;

use CodeIgniter\Model;

class GulaModel extends Model
{
    protected $protectFields = false;

    public function get_guladarah_by_user($user)
    {
        $builder = $this->db->table('tbl_guladarah');
        $builder->where('ak', $user);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_guladarah_by_user_top($user)
    {
        $builder = $this->db->table('tbl_guladarah');
        $builder->orderBy('tanggal', 'DESC');
        $builder->where('ak', $user);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function get_guladarah_by_id($id)
    {
        $builder = $this->db->table('tbl_guladarah');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
