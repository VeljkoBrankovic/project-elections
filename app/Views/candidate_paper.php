<?=$this->extend('default');?>

<?= $this->section('mainSection')?>

<h2>Elektronski kandidacioni listic</h2>

<?php
echo $error ?? "";
echo "<br>";

echo form_open('Candidate/candidates/'.$id);

echo form_label('Prezime: ', 'surname');
echo form_input('surname', set_value('surname'));
echo "<br>";

echo form_label('Ime: ', 'name');
echo form_input('name', set_value('name'));
echo "<br>";

echo form_label('Broj licence: ', 'license_num');
echo form_input('license_num', set_value('license_num'));
echo "<br>";

echo form_submit('candidates', 'Pretraga');
echo form_close();
echo "<br>";

if(isset($members)){
    if(sizeof($members)==0){
        echo "Nema rezultata pretrage.";
    }
    else{       
    ?>
        <table border="1" cellpadding="2" cellspacing="1">
            <tr>
                <th>Prezime</th><th>Ime</th><th>Br.licence</th><th>Izaberi</th>
            </tr>
            <?php foreach($members as $m){
                 echo "
                <tr>
                    <td>{$m->surname}</td>
                    <td>{$m->name}</td>
                    <td>{$m->license_num}</td>
                <td>";
            $url= "Candidate/add_vote/$id/{$m->id}";
            echo anchor($url, "Izaberi",["class"=>'btn']);  
            }
           echo "</td></tr>";
            ?>
        </table>
        
    <?php
}
}
//  $this->renderSection('selected_candidates');
?>
<?= $this->endSection();?>