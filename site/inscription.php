<?php
require_once('inc/init.inc.php');
 inscriptionTreat();
?>
<?php require_once('inc/haut.inc.php');
 
?>

<form action="" method="post">
    <?php echo $contenu;?>
    <div class='txt'>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" required="required" placeholder="Votre nom">
    </div>
    <div class='txt'>
        <label for="fname">Prénom</label>
        <input type="text" name="fname" id="fname" required="required" placeholder="Votre prénom">
    </div>
    <div class='txt'>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" maxlengh="20"
         pattern="[a-zA-Z0-9-_.]{1,20}" required="required" title="Caractère autorisé(a-zA-Z0-9)">
    </div>
    <div class='txt'>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" required="required" placeholder="Un mot de passe">
    </div>
    <div class='txt'>
        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail" required="required" placeholder="example@example.com">
    </div>
    <div class='txt'>
        <label for="cv">Civilité</label>
        <input type="radio" name="cv" value="m" checked>  HOMME
        <input type="radio" name="cv" value="f">  FEMME
    </div>
    <div class='txt'>
        <label for="city">Ville</label>
        <input type="text" name="city" id="city" required placeholder="Ex: ABIDJAN">
    </div>
    <div class='txt'>
        <label for="cp">Code postall</label>
        <input type="text" name="cp" id="cp" required="required" placeholder="Ex: 126 BP 1024 RUE 3 COCODY">
    </div>
    <div class='txt'>
        <label for="adresse">Adresse</label><br>
        <textarea  id="adresse" name="adresse" id="adresse" placeholder="votre adresse" 
        pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."></textarea>
    </div>
    <div class="">
        <input type="submit" value="S'inscrire" name="ok">
    </div>
</form>
<?php require_once('inc/bas.inc.php');?>