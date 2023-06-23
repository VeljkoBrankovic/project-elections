<?=$this->extend('default');?>

<?= $this->section('mainSection')?>
<?php
echo "<h4> Regionalni centar: $reg_center->name_reg_center </h4>";
echo "<h4>Maticna sekcija: $section->name_section <h4>";
echo "<h2>Rezultati glasanja</h2>";

echo "<p>Link za predlaganje kandidata je poslat na $sentPaper adrese.</p>";
echo "<p>U kandidovanju je ucestvovalo $nominatedPaper clana komore. </p> ";
echo "<p>Rang lista:  </p>";
if(isset($candidates)){          
    ?>
        <table border="1" cellpadding="2" cellspacing="1">
            <tr>
            <th>R.br.</th><th>Prezime</th><th>Ime</th><th>Br.licence</th><th>Broj glasova</th>
            </tr>
            <?php 
                $rb=1;
                foreach($candidates as $can){
                 echo "
                <tr>
                    <td>{$rb}</td>
                    <td>{$can->surname}</td>
                    <td>{$can->name}</td>
                    <td>{$can->license_num}</td>
                    <td>{$can->votes_no}</td>";
                    $rb++;

            }
           echo "</tr>";
            ?>
        </table>        
        <?php        
}
?>
<?= $this->endSection();?>


