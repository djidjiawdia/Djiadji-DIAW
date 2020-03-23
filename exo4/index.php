<?php
    include_once 'functions/fonctions.php';

    $phrases = [];
    $textCorrige = '';
    $afficheText = true;
    if(isset($_POST['valider'])){
        extract($_POST);
        $p = '';
        for($i=0; $i<size_t($text); $i++){
            if($text[$i] != '.'){
                $p .= $text[$i];
            }else{
                $phrases[] = $p;
                $p = '';
            }
        }
        if(!empty($phrases)){
            
            foreach($phrases as $k => $p){
                if(size_t($p) > 200){
                    echo '<h4>La phrase '. ($k+1) .' dépasse 200 caractères</h4>';
                    $afficheText = false;
                }else if(!espaces($p)){
                    $mots = get_chaine($p);
                    $mots[0][0] = car_toupper($mots[0][0]);
                    $mots[size_t($mots)-1] .= '.';
        
                    foreach($mots as $m){
                        $textCorrige .= $m.' ';
                    }
        
                }
            }
        }

        
    }
    

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
        <form method="post">
            <div class="form-group">
                <label for="text">Entrer un texte</label>
                <textarea name="text" id="text" class="form-control"><?= @$_POST['text']; ?></textarea>
            </div>
            <button class="btn" name="valider">Valider</button>
        </form>
        <?php if($afficheText){ ?>
        <div class="form-group">
            <label for="text">Texte corrigé</label>
            <textarea name="text" id="text" readonly class="form-control"><?= $textCorrige; ?></textarea>
        </div>
        <?php } ?>
    </div>
</body>
</html>

<!-- Le texte commence par un lettre majuscule. et se termine par un poi,t. dkfdjsfndsjkfhhdsbdjdjcvdjfbdjbfjdfbdhfdjfdhgvfdfhgdsv hdfbhsfidbc sdbfugdfhd dsfbudhfids idfsfbsiyb ssbfydsifb dfishfsid dfisdhis isdfishdf sdfhuhids sdifhidhs difhidsfids idfhdihsd idsfuihdf dsfihisdf idfhifisdhfsid dsfbisdfhdsbi d. -->