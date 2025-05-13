<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelDEMModel extends Model
{
    protected $table = 'tbl_artikel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'kategori', 'banner', 'created_date'];

    public function get_all_artikel($limit)
    {
        return $this->orderBy('created_date', 'DESC') // Urutkan berdasarkan tanggal terbaru
            ->paginate($limit, 'artikel_pagination');
    }
}
