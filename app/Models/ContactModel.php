<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table            = 'contacts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["first_name", "last_name", "tel", "email"];

    // Validation
    protected $validationRules      = [
        "email"         => "required|valid_email|max_length[48]",
        "first_name"    => "required|min_length[2]|max_length[32]",
        "last_name"     => "required|min_length[2]|max_length[32]",
        "tel"           => "required|regex_match[/^\+421(?:\s?\d){9}$/]",
    ];
    protected $validationMessages   = [];
}
