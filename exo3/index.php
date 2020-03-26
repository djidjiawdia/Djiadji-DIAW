<?php
    session_start();
    include_once 'functions/fonctions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Exercice 3</h1>
        <br>
        <form method="post">
            <div class="form-group">
                <label for="nbr">Donnez le nombre de mots</label>
                <input type="text" value="<?= @$_POST['nbr'] ?>" name="nbr" id="nbr" class="form-control">
            </div>


            <button class="btn"  name="valid">Ok</button>

            <?php if(isset($_POST["nbr"])){ ?>
                <div class="inputMots">
                <?php for($i=1; $i<=$_POST['nbr']; $i++){ ?>
                    <input class="form-control mt" type="text" name="<?= 'mot'.$i ?>" value="<?= @$_POST["mot{$i}"] ?>" placeholder="<?= 'Entrer le mot '.$i ?>">
                <?php } ?> 
                    <button class="btn mt" type="submit" name="resultat">Résultat</button>
                </div>
            <?php } ?>
        </form>

        <?php
            $errors = [];
            $nbr = 0;
            $tabMots = [];
            if(isset($_POST['valid'])){
                if(est_numeric($_POST['nbr'])){
                }else{
                    echo '<h4>Veuillez entrer un chiffre</h4>';
                }
            }
            if(isset($_POST['resultat'])){

                foreach(delete_last_array($_POST) as $k => $post){
                    if($k>0){
                        if(size_t($post) > 20){
                            $errors[] = 'Mot '.$k.' a dépassé 20 caractères';
                        }else if(!est_chaine($post)){
                            $errors[] = 'Mot '.$k.'  est incorrecte (espaces, caractères non alphabétiques, numeric)';
                        }else if($post === ''){
                            $errors[] = 'Mot '.$k.'  est vide';
                        }
                    }
                }
                if(empty($errors)){
                    $tabMots = delete_last_array($_POST);
                    foreach($tabMots as $k => $mot){
                        if($k > 0){
                            echo "$mot ";
                            if(contient_caract($mot, 'M')){
                                $nbr++;
                            }
                        }
                    }
                    echo "<br>Le nombre de mots qui contient 'M': $nbr"; 
                }else{
                    foreach($errors as $err){
                        echo '<h4>'.$err.'</h4>';
                    }
                }
                // var_dump($_POST);
            }
        ?>

    </div>
</body>
</html>