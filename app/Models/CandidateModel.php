<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table      = 'candidates';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id', 'id_member','votes_no'];

    public function getCandidatesDescBySection($id_section){
        $builder = $this->builder();
        $builder->join('members','members.id = candidates.id_member');
        $builder->where('members.id_section',$id_section);
        $builder->orderBy('votes_no','DESC');
        $builder-> select('members.surname, members.name, members.license_num, candidates.votes_no');


        // $builder->where('nominated_papers.is_nominate',1);
        // $builder->selectCount('nominated_papers.id');
        // return $builder->countAllResults();
        // if (isset($surname))
        //     $builder->like('surname', $surname); 
        // if (isset($name))
        //     $builder->like('name', $name); 
        // if (isset($license_num))
        //     $builder->like('license_num', $license_num);     
        // $builder-> select('id, surname, name, email, license_num');
        return $builder->get()->getResultObject();

    }
    
}
?>