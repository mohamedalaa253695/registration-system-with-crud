<?php namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name'];

    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
     
          'name'     => 'required|alpha_numeric_space|min_length[3]'       
        
    ];

    protected $validationMessages = [
        'name'        => [
            'min_length' => 'Sorry. the minimum length is 3 characters.',
            'required' => 'the name is required.'
        ]
    ];
    protected $skipValidation     = false;

    public function getRule(string $rule)
  {
    return $this->validationRules;
  }
}