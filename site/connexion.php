<?php
require_once('inc/init.inc.php');
connexionTreat();
if(internauteConnecte()){
    header('location:profil.php');
}
?>
<?php  require_once('inc/haut.inc.php');?>
<div class="container">
        <div class="row" style="margin-top:15%;">
            <div class="col-md-8 col-xs-12 offset-md-2 login" >
                <h1 class="alert-success text-center">
                    AUTHENTIFICATION
                </h1>
                <?php
                    if(isset($contenu)):
                ?>
                <div class="col-md-12 col-xs-12 alert alert-danger">
                <?=
                    $contenu;
                ?>
                </div>
                <?php
                    endif;
                ?>
                <form action="" method="post">
                    <div class="txt">
                        <label for="pseudo">Pseudo :</label>
                        <input type="text" name="pseudo" placeholder="Entrer votre pseudo" class="form-control"/>
                    </div>
                    <div class="txt">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" placeholder="*************" class="form-control"/>
                    </div>
                    <div class="">
                        <input type="submit" name='ok' value="Se connecter" class="btn btn-primary"/>
                    </div>
                </form>
            </div>

        </div>
    </div>