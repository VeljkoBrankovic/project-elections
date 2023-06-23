<?php 

namespace App\Cells;
use App\Models\MemberModel;

class Cand
{
    // public function show(array $params): string
    // {
    //     return "<div class="alert alert-{$params['type']}">{$params['message']}</div>";
    // }

public function add($id){
        // $candidatesId=array();
        // array_push($candidatesId, $id);
        $candidateModel = new MemberModel();
        $candidate = $candidateModel->find($id);
        // array_push($candidates, $candidate);
     //   return redirect()->to('candidate/candidates/{$id}');
        return view ('selected_candidates', ['candidate'=>$candidate]); 


    }
}