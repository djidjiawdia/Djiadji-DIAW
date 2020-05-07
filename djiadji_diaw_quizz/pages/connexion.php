<?php
    $message = '';

    if(isset($_GET['errorPass'])){
        $message = "Le mot de passe est incorrect";
    }elseif(isset($_GET['errorLog'])){       
        $message = "Le login n'existe pas!";
    }
    if(!empty($_POST['loginConn']) && !empty($_POST['passwordConn'])){
        var_dump($_POST);
        $login = $_POST['loginConn'];
        $password = $_POST['passwordConn'];
        $user = searchLogin($login);
        if($user){
            if($user['password'] === $password){
                $_SESSION['user'] = [
                    "id" => $user["id"],
                    "nom" => $user["nom"],
                    "prenom" => $user["prenom"],
                    "login" => $user["login"],
                    "role" => $user["role"],
                    "profil" => $user["profil"],
                    "bonneRep" => $user["bonneRep"],
                    "score" => $user["score"]
                ];
                if($user['role'] === "admin"){
                    //var_dump($_SESSION);
                    header('location:index.php?page=accueil');
                }else{
                    header('location:index.php?page=quizz');
                }
            }else{
                header('location:./index.php?errorPass');
            }
        }else{
            header('location:./index.php?errorLog');
        }
    } 
?>


<div class="center">
    <div class="card card-md">
        <div class="card-header connexion-header">
            <h3 class="card-title">Login Form</h3>
            <span>x</span>
        </div>
        <div class="card-body">
            <form class="form-c" method="post" id="indexForm">
                <div class="form-group">
                    <img src="./public/icones/ic-login.png" alt="ic-login">
                    <input type="text" class="form-control bg-input" name="loginConn" placeholder="Login" value="<?= @$login ?>">
                </div>
                <div class="form-group">
                    <img src="./public/icones/ic-password.png" alt="ic-password">
                    <input type="password" class="form-control bg-input" name="passwordConn" placeholder="Password" >
                </div>
                <div class="form-group-btn">
                    <button type="submit" name="btn_conn" class="btn btn-lg btn-primary">Connexion</button>
                    <a href="index.php?page=creer_joueur">S'inscrire pour jouer?</a>
                </div>
            </form>
            <?php
                if($message != ""){
                    echo '<p style="color:red;">'.$message.'</p>';
                }
            ?>
        </div>
    </div>
</div>