<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\NominatedPaperModel;

class Sendmail extends BaseController
{


  public function index()
  {
    return redirect()->to('');
  }

  public function send_voter_list($id_section)
  {
    $email = \Config\Services::email();

    $model = new MemberModel();
    $member_for_mail = $model->getMembersBySection($id_section);

    foreach ($member_for_mail as $m) {

      $email->setTo($m->email);
      $email->setSubject('Biracki spisak');
      $url = "Candidate/get_voter_list/$m->id";
      $link = anchor($url, 'Pogledaj');
      $email->setMessage("Postovani $m->name,\n ovde mozete videti kandidate \n". $link."\n Hvala");

      if ($email->send()) {
        echo ("Biracki spisak je uspesno prosledjen $m->surname $m->name. <br>");
      } else echo ("Doslo je do greske u slanju. Biracki spisak NIJE prosledjen $m->surname $m->name <br>");
    }
  }


  public function send_nomination_paper($id_section)
  {
    $email = \Config\Services::email();

    $model = new MemberModel();
    $member_for_mail = $model->getMembersBySection($id_section);

    $nominated_model = new NominatedPaperModel();

    foreach ($member_for_mail as $m) {
      //  var_dump($m->id)  ;
      $nominated = $nominated_model->where('id_member', $m->id)->first();
      //  var_dump($nominated->nominated_paper_no);
      if (($nominated == null) || (!$nominated->is_sent)) {

        $email->setTo($m->email);
        $email->setSubject('Elektronski kandidacioni listic');
        $url = "Candidate/candidates/$m->id";
        $link = anchor($url, 'Kandiduj');
        $email->setMessage("Postovani $m->name,\n ovde mozete glasati \n $link \n Hvala");
        $nominated_paper_no = $id_section * 1000 + $m->id;
        //var_dump($nominated_paper_no);
        $nom = [
          'id_member' => $m->id,
          'nominated_paper_no' => $nominated_paper_no,
          'is_sent' => true,
          'link' => $link
        ];
        if ($email->send()) {
          $nominated_model->insert($nom);
          echo ("Kandidacioni listic je uspesno prosledjen $m->surname $m->name. <br>");
        } else echo ("Doslo je do greske u slanju. Kandidacioni listic NIJE prosledjen $m->surname $m->name. <br>");
      } else echo ("Kandidacioni listic je ranije prosledjen $m->surname $m->name. Nije moguce proslediti ga ponovo. <br>");
    }
  }
}
