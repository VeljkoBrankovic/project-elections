<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table      = 'members';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    public function getMembersBySection($id_section, $surname=NULL, $name=NULL, $license_num=NULL){
        $builder = $this->builder();
        $builder->where('id_section', $id_section);
        if (isset($surname))
            $builder->like('surname', $surname); 
        if (isset($name))
            $builder->like('name', $name); 
        if (isset($license_num))
            $builder->like('license_num', $license_num);     
        $builder-> select('id, surname, name, email, license_num');
        return $builder->get()->getResultObject();

    }
    
}
?>