<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'User';
    protected $allowedFields = ['username'];
}
