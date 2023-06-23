<?php

namespace App\Controllers;
use App\Models\MemberModel;


class Member extends BaseController
{
    public function index()
    {
        $name = $this->session->get("member")->name;
        return view('member', ['name'=> $name]);
    }

    public function login() {
        if(!$this->validate(['username'=>'required', 'password'=>'required'])){
        $errorMsg = $this->validator->listErrors();
        return view ('login_member', ['error'=>$errorMsg]);
        }
        $model = new MemberModel();
        $member = $model->where('username', $this->request->getVar('username'))->first();
        if($member == null){
            return view ('login_member', ['error'=>'Korisnik ne postoji']);
        }
        if($member->password != $this->request->getVar('password')) {
            return view('login_member', ['error' =>'Pogresan password!'] );
        }
        $this->session->set('member', $member);
        return redirect()->to('Member');

    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to("");
    }

    public function vote() {
        return view ('voting_paper');
    }
   
} 
?>