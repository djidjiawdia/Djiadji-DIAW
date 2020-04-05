<?php

$caracteres = [
    ['a', 'A'], ['b', 'B'], ['c', 'C'], ['d', 'D'], ['e', 'E'], ['f', 'F'],
    ['g', 'G'], ['h', 'H'], ['i', 'I'], ['j', 'J'], ['k', 'K'], ['l', 'L'],
    ['m', 'M'], ['n', 'N'], ['o', 'O'], ['p', 'P'], ['q', 'Q'], ['r', 'R'],
    ['s', 'S'], ['t', 'T'], ['u', 'U'], ['v', 'V'], ['w', 'W'], ['x', 'X'],
    ['y', 'Y'], ['z', 'Z']
];

function car_tolower($car){
    global $caracteres;
    foreach($caracteres as $lettres){
        for($i=0; $i<size_t($lettres); $i++){
            if($lettres[$i] === $car){
                return $lettres[0];
            }
        }
    }
    return $car;
}

function car_toupper($car){
    global $caracteres;
    foreach($caracteres as $lettres){
        for($i=0; $i<size_t($lettres); $i++){
            if($lettres[$i] === $car){
                return $lettres[1];
            }
        }
    }
    return $car;
}

function est_chiffre($car){
    return ($car >= '0' && $car <= '9');
}

function is_lower($car){
    return ($car >= 'a' && $car <= 'z');
}

function is_upper($car){
    return ($car >= 'A' && $car <= 'Z');
}

function est_caractere($car){
    return (($car >= 'a' && $car <= 'z') || ($car >= 'A' && $car <= 'Z'));
}

function size_t($chaine){
    for($i=0; true; $i++){
        if(!isset($chaine[$i])){
            break;
        }
    }
    return $i;
}

function est_numeric($nbr){
    for($i=0; $i<size_t($nbr); $i++){
        if(!est_chiffre($nbr[$i])){
            return false;
        }
    }
    return true;
}

function est_chaine($chaine){
    $n = size_t($chaine);
    for($i=0; $i<$n; $i++){
        if(!est_caractere($chaine[$i])){
            return false;
        }
    }
    return true;
}

function del_espace($chaine){
    $new = '';
    for($i=0; $i<size_t($chaine); $i++){
        if($chaine[$i] != ' '){
            $new .= $chaine[$i];
        }
    }
    return $new;
}

function contient_caract($chaine, $car){
    for($i=0; $i<size_t($chaine); $i++){
        if($chaine[$i] === car_tolower($car) || $chaine[$i] === car_toupper($car)){
            return true;
        }
    }
    return false;
}

function my_trim($chaine){
    for($i=0; $i<size_t($chaine); $i++){
        if($chaine[$i] != ' '){
            $mot .= $chaine[$i];
        }
    }
}

function get_phrases($text){
    $phrases = [];
    $p = '';
    for($i=0; $i<size_t($text); $i++){
        if($text[$i] !== '.' && $text[$i] !== '!' && $text[$i] !== '?'){
            $p .= $text[$i];
        }else{
            $p .= $text[$i];
            $phrases[] = $p;
            $p = '';
        }
    }
    return $phrases;
}

function get_mots($phrase){
    $tabMots = [];
    $mot = '';
    for($i=0; $i<size_t($phrase); $i++){
        if($phrase[$i] !== ' ' ){
            $mot .= $phrase[$i];
        }else if($mot != ''){
            $tabMots[] = $mot;
            $mot = '';
        }
    }
    if($mot != ''){
        $tabMots[] = $mot;
    }
    return $tabMots;
}

function del_espace_inutile($phrase){
    $p = '';
    $mots = get_mots($phrase);
    foreach($mots as $k => $m){
        if($k < size_t($mots)-1){
            $p .= $m.' ';
        }else{
            $p .= $m;
        }
    }
    if(est_caractere($p[0])){
        $p[0] = car_toupper($p[0]);
    }
    return $p;
}

function est_phrase($chaine){
    $n = size_t($chaine);
    if(is_upper($chaine[0]) && ($chaine[$n-1] === '.' || $chaine[$n-1] === '!' || $chaine[$n-1] === '?')){
        return true;
    }else{
        return false;
    }
}
