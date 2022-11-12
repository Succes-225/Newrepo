<?php
require_once('../inc/init.inc.php');
if(!internautConnecteAdmin()){
    header('Location:../connexion.php');
    exit();//pour que la redirection se fasse immediatemment si l'internaute connecté n'est pas admin
}
//*********ENREGISTREMENT PRODUIT */
$table = '';
if(isset($_POST['ok'])){
    if(!empty(htmlspecialchars($_POST['reference'])) && !empty(htmlspecialchars($_POST['categorie']))){
        if(!empty(htmlspecialchars($_POST['titre'])) AND !empty(htmlspecialchars($_POST['description'] && !empty(htmlspecialchars($_POST['couleur']))))){
            if(isset($_FILES['pic']) && $_FILES['pic']['error'] == 0){
                if($_FILES['pic']['size']<=5000000){
                    $infosfichier = pathinfo($_FILES['pic']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extension_autorise = ['png', 'jpg', 'jpeg', 'gif'];
                    $nom_photo = $_POST['reference'] . '_' .$_FILES['pic']['name'];
                    $photo_bdd = RACINE_SITE . "photo/$nom_photo"; //chemin de la pic dans le bdd
                    if(in_array($extension_upload, $extension_autorise)){
                        move_uploaded_file($_FILES['pic']['tmp_name'], '../photo/' . 
                        basename($nom_photo));
                        $req=executeRequete('INSERT INTO produit SET reference=?, categorie=?, titre=?, description=?,
                        couleur=?, taille=?, public=?, photo=?, prix=?, stock=?');
                        $req->execute([$_POST['reference'], $_POST['categorie'], $_POST['titre'], $_POST['description']
                        , $_POST['couleur'], $_POST['taille'], $_POST['public'],$photo_bdd, 
                        htmlspecialchars($_POST['prix']), htmlspecialchars($_POST['stock'])]);
                        $contenu .= '<div class="validation">Le produit a été ajouté</div>';
                    }
                    else{
                        $contenu .= "<div class='erreur'>Extension de fichier pas autorisé</div>";
                    }
                }
                else{
                    $contenu .= "<div class='erreur'>Inserez une image <= 5 Mo svp!</div>";
                }
            }else{
                $contenu .= "<div class='erreur'>Veuillez choisir une image du produit ou une erreur est présente sur l'image</div>";
            }
        }
        else{
            $contenu .= "<div class='erreur'>Remplissez tous les champs</div>";
        }
    }else{
        $contenu .= "<div class='erreur'>Remplissez tous les champs</div>";
    }
}

$option .= "<div class='option'> <a href='?action=affichage'>Afficher les produits</a></div>";
$option .= " <div class='option'><a href='?action=ajout'>Ajouter des produits</a></div>";
if(isset($_GET['action']) && $_GET['action']=='affichage'){
    $req=executeRequete('SELECT * FROM produit');
    $req->execute();
    $produit=$req->fetch(PDO::FETCH_OBJ);
    $contenu .= "<h1>AFFICHAGE DES PRODUITS</h1>";
    $contenu .= "<span>Le nombre de produit(s) dans la boutique est : ".
    $nombreProduit = $req->rowCount();
    $contenu .= '<table border="2px"><tr>';
    $contenu .= '<tr> <th>id_produit</th>
    <th>reference</th>
    <th>categorie</th>
    <th>titre</th>
    <th>descrisption</th>
    <th>couleur</th>
    <th>taille</th>
    <th>public</th>
    <th>photo</th>
    <th>prix</th>
    <th>stock</th>
    <th>modification</th>
    <th>suppression</th>';
    while($produit = $req->fetch(PDO::FETCH_ASSOC)){ //fetch_field pour recuperer tous les champs
        /*$contenu .= '<tr>'.'<td>'.$produit["id_produit"].'</td>';
        $contenu .= '<td>'.$produit["reference"].'</td>';
        $contenu .= '<td>'.$produit["categorie"].'</td>';
        $contenu .= '<td>'.$produit["titre"].'</td>';
        $contenu .= '<td>'.$produit["description"].'</td>';
        $contenu .= '<td>'.$produit["couleur"].'</td>';
        $contenu .= '<td>'.$produit["taille"].'</td>';
        $contenu .= '<td>'.$produit["public"].'</td>';*/
        $contenu .= '<tr>';
        foreach ($produit as $indice => $information){
            if($indice == "photo"){
                $contenu .= '<td><img src="' . $information . '" ="70" height="70"></td>';
            }else{
                $contenu .= '<td>' . $information . '</td>';
            }
        }
            
        $contenu .= '<td><a href="?action=modification&id_produit=' . $produit['id_produit'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $produit['id_produit'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img
        src="../inc/img/delete.png"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</tr></table> <br/>';
}

?>
<?php require_once('../inc/haut.inc.php');?>
<?= $contenu ;?>
<?= $option ;?>
<?php
if(isset($_GET['action']) && $_GET['action']=='ajout'){
?>
<form action="" method="post" enctype="multipart/form-data">
<h2 style="text-align:center; font-size:16px; margin:5px; background-color: rgba(80, 156, 163, 0.383); padding:5px">
    GESTIONNAIRE DE LA BOUTIQUE</h2><br><br>
    
    <label for="reference">reference</label><br>
    <input type="text" id="reference" name="reference" placeholder="la référence de produit"> <br><br>
    
    <label for="categorie">categorie</label><br>
    <input type="text" id="categorie" name="categorie" placeholder="la categorie de produit"><br><br>
    
    <label for="titre">titre</label><br>
    <input type="text" id="titre" name="titre" placeholder="le titre du produit"> <br><br>
    
    <label for="description">description</label><br>
    <textarea name="description" id="description" placeholder="la description du produit"></textarea><br><br>
    
    <label for="couleur">couleur</label><br>
    <input type="text" id="couleur" name="couleur" placeholder="la couleur du produit"> <br><br>
    
    <label for="taille">Taille</label><br>
    <select name="taille">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select><br><br>
    
    <label for="public">public</label><br>
    <input type="radio" name="public" value="m" checked>Homme
    <input type="radio" name="public" value="f">Femme<br><br>
    
    <label for="photo">photo</label><br>
    <input type="file" id="photo" name="pic"><br><br>
    
    <label for="prix">prix</label><br>
    <input type="text" id="prix" name="prix" placeholder="le prix du produit"><br><br>
    
    <label for="stock">stock</label><br>
    <input type="text" id="stock" name="stock" placeholder="le stock du produit"><br><br>
    
    <input type="submit" name="ok" value="enregistrement du produit">
</form>

<?php } require_once('../inc/bas.inc.php');?>