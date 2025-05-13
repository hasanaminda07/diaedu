<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $protectFields = false;

    public function get_all_artikel()
    {
        $builder = $this->db->table('tbl_artikel');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_artikel_by_id($id)
    {
        $builder = $this->db->table('tbl_artikel');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function jumlah_artikel()
    {
        $builder = $this->db->table('tbl_artikel');
        $num_rows = $builder->countAllResults();
        return $num_rows;
    }
}
