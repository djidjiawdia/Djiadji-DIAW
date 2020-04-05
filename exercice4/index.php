<?php include_once 'fonctions/fonctions.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 4</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    
        <form method="post">
            <div class="form-group">
                <label for="text">Entrer un texte: </label>
                <textarea name="text" id="text" class="form-control"><?= @$_POST['text'] ?></textarea>
            </div>
            <button class="btn" type="submit" name="valider">Valider</button>
        </form>

        <?php
            $textCorrect = '';
            $erreurs = [];
            if(isset($_POST['valider'])){
                if(empty($_POST['text'])){
                    echo 'le champ est vide';
                }else{
                    $phrases = get_phrases($_POST['text']);
                    foreach($phrases as $k => $p){
                        $p = del_espace_inutile($p);
                        if(!est_phrase($p)){
                            $erreurs[] = 'Phrase '.($k+1).' n\'est pas correcte!!!';
                        }elseif(size_t($p) > 200){
                            $erreurs[] = 'Phrase '.($k+1).' est superieure à 200 caractères.';
                        }else{
                            if($k < size_t($phrases)){
                                $textCorrect .= $p.' ';
                            }else{
                                $textCorrect .= $p;
                            }
                        }
                    }
                }
                if(!empty($erreurs)){
                    foreach($erreurs as $err){
                        echo '<h4>'.$err.'</h4>';
                    }
                }
            }
            if(empty($erreurs)){
        ?>    
        
        <textarea readonly class="form-control"><?= $textCorrect; ?></textarea>
        <?php } ?>
    </div>
</body>
</html>