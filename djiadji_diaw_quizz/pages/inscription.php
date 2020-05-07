<?php
    $message = "";
    if(isset($_GET['errorLog'])){
        $message = "Le login existe déjà";
    }elseif(isset($_GET['errorSave'])){       
        $message = "Save failed";
    }
?>

<div class="inscription row">
    <div class="col-md">
        <div class="inscription-header">
            <h1>S'inscrire</h1>
            <p><?= $title ?></p>
        </div>
        <form class="form-i" method="post" enctype="multipart/form-data" id="inscForm">
            <?php
                if($message != ""){
                    echo '<p style="color:red;">'.$message.'</p>';
                }
            ?>
            <div class="form-group-i">
                <label class="form-label" for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Ex: Abdoulaye">
            </div>
            <div class="form-group-i">
                <label class="form-label" for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control"  placeholder="Ex: Diaw">
            </div>
            <div class="form-group-i">
                <label class="form-label" for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control" placeholder="Ex: jahji ">
            </div>
            <div class="form-group-i">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
            </div>
            <div class="form-group-i">
                <label class="form-label" for="password">Confirm password</label>
                <input type="password" name="passConfirm" id="passConfirm" class="form-control" placeholder="Confirmer votre mot de passe">
            </div>
            <div class="form-group-avatar">
                <h3>Avatar</h3>
                <div class="inputavatar">
                    <input type="file" name="avatar" id="avatar" />
                    <label class="btn-primary" for="avatar">Choisir un fichier</label>
                </div>
            </div>
            <button type="submit" name="creerCompte" class="btn-primary">Créer compte</button>
        </form>
    </div>
    <div class="col-sm">
        <div class="avatar">
            <img src="/sa_quiz/public/images/avatar.png" alt="Avatar" id="inscAvatar">
            <h2><?= $nameAvatar ?></h2>
        </div>
    </div>
</div>