<?php include_once 'fonctions/fonctions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 3</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">

        <form method="post">
            <div class="form-group">
                <label for="nbr">Donnez le nombre de mots</label>
                <input class="form-control" type="text" name="nbr" id="nbr" value="<?= @$_POST['nbr'] ?>">
            </div>

            <button class="btn"  name="valid">Ok</button>

            <?php if(isset($_POST['nbr'])){ ?>
                <div class="inputMots">
                    <?php for($i=1; $i<=$_POST['nbr']; $i++){ ?>
                        <input class="form-control" type="text" name="mot[]" value="<?= @$_POST['mot'][$i-1] ?>" placeholder="<?= 'Entrer le mot '.$i ?>">
                    <?php } ?>
                    <button class="btn" name="resultat">Résultat</button>
                </div>
            <?php } ?>
        </form>

        <?php
            $erreurs = [];
            $nbr = 0;
            if(isset($_POST['valid'])){
                if(!is_numeric($_POST['nbr']) || $_POST['nbr'] <= 0){
                    echo '<h4>Veuillez entrer un entier positif</h4>';
                }
            }
            if(isset($_POST['resultat'])){

                foreach($_POST['mot'] as $k => $mot){
                    $mot = del_espace($mot);
                    if(size_t($mot) > 20){
                        $erreurs[] = 'Mot '.($k+1).' a dépassé 20 caractères';
                    }elseif(!est_chaine($mot)){
                        $erreurs[] = 'Mot '.($k+1).'  est incorrecte (espaces, caractères non alphabétiques, numeric)';
                    }elseif($mot === ''){
                        $erreurs[] = 'Mot '.($k+1).'  est vide';
                    }
                }


                if(empty($erreurs)){
                    foreach($_POST['mot'] as $mot){
                        if(contient_caract($mot, 'M')){
                            $nbr++;
                        }
                    }
                    echo "<br>Le nombre de mots qui contient 'M': $nbr"; 
                }else{
                    foreach($erreurs as $err){
                        echo '<h4>'.$err.'</h4>';
                    }
                }
            }
        ?>
    </div>

</body>
</html>