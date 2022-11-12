<?php
function executeRequete($req)
{
    global $db;
    $resultat=$db->prepare($req);
    if(!$resultat){
        die("Erreur sur la requete sql.<br>Message : "
        . $db->error . "<br>Code: " . $req);
    }
    return $resultat;
}

//**************************Fonction pour le traitement de l'inscription //
function inscriptionTreat(){
    global $contenu;
    if(isset($_POST['ok'])){
        $name=htmlspecialchars($_POST['name']);
        $fname=htmlspecialchars($_POST['fname']);
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $mdp=sha1($_POST['mdp']);
        $cp=htmlspecialchars($_POST['cp']);
        $mail=$_POST['mail'];
        $civilite=$_POST['cv'];
        $ville=htmlspecialchars($_POST['city']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
        if($verif_caractere && strlen($pseudo)>2 OR strlen($pseudo)>=20){
            $req=executeRequete('SELECT pseudo FROM membre WHERE pseudo=?');
            $req->execute([$pseudo]);
            $pseudoExiste= $req->rowCount();
            if($pseudoExiste==0){
                if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                    $req=executeRequete('INSERT INTO membre SET pseudo=?, nom=?, prenom=?, email=?
                        ,civilite=?, ville=?, code_postal=?, adresse=?, mdp=?');
                    $req->execute([$pseudo, $name, $fname, $mail, $civilite, $ville, $cp
                    , $adresse, $mdp]);
                    $contenu .= "<div class='validation'>Inscription reussi. Allez à la page de connexion pour vous connectez</div>";
                }
                else{
                    $contenu .= "<div class='erreur'>Email invalide</div>";
                }
            }
            else{
                $contenu .= "<div class='erreur'>Ce pseudo est déja pris. Veuillez en choisir un autre SVP!</div>";
            }
        }
        else{
            $contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 
            et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
        }
    }
    else{
    
    }
    
}

//***********************************Fonction de traitement la connection*****************//
function connexionTreat(){
    global $contenu;
    if(isset($_POST['ok'])){
        if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){
    
            $pseudo = $_POST['pseudo'];
            
            $req=executeRequete('SELECT * FROM membre WHERE pseudo=? and mdp=?');
            $mp=sha1($_POST['password']);
            $req->execute([$pseudo, $mp]);
            $compte = $req->rowCount();
            if($compte == 1){
                $membre = $req->fetch(PDO::FETCH_OBJ);
                $_SESSION['auth']=$membre;
                header('Location:profil.php');
            }
            else{
                $contenu .= "<div class='erreur'>Ce compte n'existe pas</div>";
            }
        }
        else{
            $contenu .= "<div class='erreur'>Veuillez remplir les champs SVP!</div>";
        }
    }
}

//*********************Fonction pour determiner les membres connectés*************** */
function  internauteConnecte(){
    if(isset($_SESSION['auth'])){
        return true;
    }
    else{
        return false;
    }
}

function internautConnecteAdmin(){
    if(internauteConnecte() && $_SESSION['auth']->status == 1){
        return true;
    }
    else{
        return false;
    }
}
?>
