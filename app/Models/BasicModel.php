<?php

namespace App\Models;

use CodeIgniter\Model;

class BasicModel extends Model
{
    protected $protectFields = false;

    public function insert_($data, $table)
    {
        $this->table = $table;
        return $this->insert($data);
    }


    public function update_($where, $data, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    function delete_($where, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->delete();
        return true;
    }
}
