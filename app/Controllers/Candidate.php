<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use App\Models\MemberModel;
use App\Models\NominatedPaperModel;
use App\Models\RegCenterModel;
use App\Models\SectionModel;

class Candidate extends BaseController
{
    public function index()
    {
        return redirect()->to('');
    }

    public function get_voter_list($id)
    {
               
        $model = new MemberModel();
        $member = $model->find($id);

        $sectionModel = new SectionModel();
        $section = $sectionModel->find($member->id_section);

        $regCenterModel = new RegCenterModel();
        $regCenter = $regCenterModel->find($section->id_reg_center);

        $memberModel = new MemberModel();
        $members = $memberModel->getMembersBySection($member->id_section);
        //   $this->session->set('member', $member);
        return view('candidate_list', ['members' => $members, 'id' => $id, 'section' =>$section, 'reg_center'=>$regCenter]);
    }

    public function candidates($id)
    {
        $model = new MemberModel();
        $member = $model->find($id);

        $nominated_model = new NominatedPaperModel();
        $nominated = $nominated_model->where('id_member', $id)->first();

        if (!$nominated->is_nominate) {
        $memberModel = new MemberModel();
        $members = $memberModel->getMembersBySection(
            $member->id_section,
            $this->request->getVar('surname'),
            $this->request->getVar('name'),
            $this->request->getVar('license_num')
        );
        //   $this->session->set('member', $member);
        return view('candidate_paper', ['members' => $members, 'id' => $id]);
    }
    else echo ("Vec ste kandidovali, ne mozete ponovo");
    }

    public function add_vote($id, $candidateId)
    {
        $nominated_model = new NominatedPaperModel();
        $nominated = $nominated_model->where('id_member', $id)->first();
        var_dump($nominated->id_member);

        $candidate_model = new CandidateModel();
        $candidate = $candidate_model->where('id_member', $candidateId)->first();

        if (!$nominated->is_nominate) {
            $nominated_model->set('is_nominate', true);
            $nominated_model->where('id_member', $id);
            $nominated_model->update();

            if ($candidate == null) {
                $first_vote = 1;
                $cand = [
                    'id_member' => $candidateId,
                    'votes_no' => $first_vote
                ];
                $candidate_model->insert($cand);
            } else {
                $votes = $candidate->votes_no + 1;
                $candidate_model->set('votes_no', $votes);
                $candidate_model->where('id_member', $candidateId);
                $candidate_model->update();
            }
            echo ("Uspesno ste kandidovali");
        } else echo ("Vec ste kandidovali, ne mozete ponovo");
    }
}
