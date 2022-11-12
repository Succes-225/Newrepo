
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo RACINE_SITE;?>inc/css/style.css">
  
    
    <title>Document</title>
</head>
<body>
<header>
    <div class='conteneur'>
        <div class='logo'>
            <a href="" title="Mon Site">MonSite.com</a>
        </div>
        <nav>
        <?php
        if(internautConnecteAdmin()){
        ?>
            <a href="<?php echo RACINE_SITE;?>admin/gestion_membre.php"><span>Gestion des membres</span></a>
            <a href="<?php echo RACINE_SITE;?>admin/gestion_commande.php"><span>Gestion des commandes</span></a>
            <a href="<?php echo RACINE_SITE;?>admin/gestion_boutique.php"><span>Gestion de la boutique</span></a>
        <?php
        }
        ?>
        <?php
        if(!internauteConnecte()){

        ?>
            <a href="<?php echo RACINE_SITE;?>inscription.php"><span>Inscription</span></a>';
            <a href="<?php echo RACINE_SITE;?>connexion.php"><span>Connexion</span></a>';
            <a href="<?php echo RACINE_SITE;?>boutique.php"><span>Acces à la boutique</span></a>';
            <a href="<?php echo RACINE_SITE;?>panier.php"><span>Voir votre Panier</span></a>';
        <?php
        }
        else{
        ?>
            <a href="<?php echo RACINE_SITE;?>profil.php"><span>Mon profil</span></a>
            <a href="<?php echo RACINE_SITE;?>boutique.php"><span>Voir la boutique</span></a>
            <a href="<?php echo RACINE_SITE;?>panier.php"><span>Voir votre panier</span></a>
            <a href="<?php echo RACINE_SITE;?>deconnexion.php"><span>Deconnexion</span></a>
        <?php
        }
        ?>

        </nav>
    </div>
</header>
<section>
    <div class='content'>
    
