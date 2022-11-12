<?php
require_once('inc/init.inc.php');
if(!internauteConnecte()){
    header('Location:connexion.php');
}
else{
    $req=executeRequete('SELECT * FROM membre WHERE id_membre=?');
    $req->execute([$_SESSION['auth']->id_membre]);
    $donne=$req->fetch();
?>
<?php require_once('inc/haut.inc.php'); ?>
    
        <div class="info_container">
            <div class="title">
                <h3>BIENVENUE <?= $donne['pseudo'] sur ton profil;?></h3>
            </div>
            <div class="generalInfo">
                
                <table width="300px" height="400px">
                    <tr><td bgcolor="rgb(130, 149, 167)" colspan='2'> <h3>Vos informations</h3></td></tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">NOM</td>
                        <td><?= $donne['nom'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">PRENOM</td>
                        <td><?= $donne['prenom'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">PSEUDO</td>
                        <td><?= $donne['pseudo'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">EMAIL</td>
                        <td><?= $donne['email'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">VILLE</td>
                        <td><?= $donne['ville'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">CODE POSTAL</td>
                        <td><?= $donne['code_postal'];?></td>
                    </tr>
                    <tr bgcolor="grey">
                        <td bgcolor="lightgreen">ADRESSE</td>
                        <td><?= $donne['adresse'];?></td>
                    </tr>

                </table>
            </div>
            
        </div>
<?php
}
?>
<?php require_once('inc/bas.inc.php'); ?>
