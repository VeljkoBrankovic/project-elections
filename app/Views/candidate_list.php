<?=$this->extend('default');?>

<?= $this->section('mainSection')?>
<?php
echo "<h3> Regionalni centar: $reg_center->name_reg_center </h3>";
echo "<h3>Maticna sekcija: $section->name_section <h3>";
echo "<h2>Lista kandidata u Vasoj maticnoj sekciji</h2>";
 
if(isset($members)){          
    ?>
        <table border="1" cellpadding="2" cellspacing="1">
            <tr>
                <th>Prezime</th><th>Ime</th><th>Br.licence</th>
            </tr>
            <?php foreach($members as $m){
                 echo "
                <tr>
                    <td>{$m->surname}</td>
                    <td>{$m->name}</td>
                    <td>{$m->license_num}</td>"; 
            }
           echo "</tr>";
            ?>
        </table>        
        <?php        
}
echo "<h3> Uskoro cete dobiti kandidacione listice.</h3>"
?>
<?= $this->endSection();?>


