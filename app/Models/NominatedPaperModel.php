<?php

namespace App\Models;

use CodeIgniter\Model;

class NominatedPaperModel extends Model
{
    protected $table      = 'nominated_papers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id', 'id_member','nominated_paper_no', 'is_sent', 'is_nominate', 'link'];

    public function getByIdMember($id_member){
        $builder = $this->builder();
        $builder->where('id_member', $id_member);           
       // $builder-> select('id, surname, name, email, license_num');
        return $builder->get()->getResultObject();
    }

    public function how_many_paper_is_sent($id_section){
      $builder = $this->builder();
      $builder->join('members','members.id = nominated_papers.id_member');
      $builder->where('members.id_section',$id_section);
      $builder->where('nominated_papers.is_sent',1);
      $builder->selectCount('nominated_papers.id');
      return $builder->countAllResults();
    
      //return $builder->get();  

    }

    public function how_many_is_nominate($id_section){
      $builder = $this->builder();
      $builder->join('members','members.id = nominated_papers.id_member');
      $builder->where('members.id_section',$id_section);
      $builder->where('nominated_papers.is_nominate',1);
      $builder->selectCount('nominated_papers.id');
      return $builder->countAllResults();
    
      //return $builder->get();  

    }
    
}
?>