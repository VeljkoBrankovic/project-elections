<h3>Uspesno ste prosledili predlog za kandidata</h3>

<?php 
if(isset($candidates)){
    if(sizeof($candidates)==0){
        echo "Jos uvek niste nikog kandidovali. Izaberite vaseg kandidata.";
    }
    else{
        
    ?>
        <table border="1" cellpadding="2" cellspacing="1">
            <tr>
                <th>Prezime</th><th>Ime</th><th>Br.licence</th><th>Izaberi</th>
            </tr>
            <?php foreach($candidates as $c){
                    echo "
                <tr>
                    <td>{$c['surname']}</td>
                    <td>{$c['name']}</td>
                    <td>{$c['license_num']}</td>
                <td>";
            $url= "Candidate/del/{$c['id']}";
            echo anchor($url, "Obrisi",["class"=>'btn']);  
            }
            echo "</td></tr>"
            ?>
        </table>
        <?php } }?>