<?php

namespace App\Models;

use CodeIgniter\Model;

class RegCenterModel extends Model
{
    protected $table      = 'reg_centers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    
}
?>