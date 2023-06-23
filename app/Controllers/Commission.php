<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\SectionModel;
use App\Models\RegCenterModel;
use App\Models\NominatedPeperModel;
use App\Models\CandidateModel;
use App\Models\NominatedPaperModel;

class Commission extends BaseController
{
    public function index()
    {
        $commision = $this->session->get("commission");
        return view('commission', ['commision'=>$commision]);
    }

    public function login() {
        if(!$this->validate(['username'=>'required', 'password'=>'required'])){
        $errorMsg = $this->validator->listErrors();
        return view ('login_commission', ['error'=>$errorMsg]);
        }
        $model = new MemberModel();
        $commission = $model->where('username', $this->request->getVar('username'))->first();
        if($commission == null){
            return view ('login_commission', ['error'=>'Clan ne postoji']);
        }
        if($commission->password != $this->request->getVar('password')) {
            return view('login_commission', ['error' =>'Pogresan password!'] );
        }
        if($commission->commission_member !=1){
            return view('login_commission', ['error' =>'Niste clan komisije'] );
        }
        $this->session->set('commission', $commission);
        return redirect()->to('Commission');

    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to("");
    }   

    public function get_candidacy_results($id_section)
    {              
        $sectionModel = new SectionModel();
        $section = $sectionModel->find($id_section);

        $regCenterModel = new RegCenterModel();
        $regCenter = $regCenterModel->find($section->id_reg_center); 

        $nominatedPaperModel = new NominatedPaperModel();
        $sentPaper = $nominatedPaperModel->how_many_paper_is_sent($id_section);
        $nominatedPaper = $nominatedPaperModel->how_many_is_nominate($id_section);

        $candidateModel = new CandidateModel();
        $candidates = $candidateModel->getCandidatesDescBySection($id_section);
        
        var_dump($candidates);
        $memberModel = new MemberModel();
        $members = $memberModel->getMembersBySection($id_section);
        //   $this->session->set('member', $member);
        return view('candidacy_results', ['section' =>$section, 'reg_center'=>$regCenter, 'candidates' => $candidates, 
        'sentPaper'=> $sentPaper, 'nominatedPaper'=> $nominatedPaper]);
    }
}
