<?php

    $caracteres = [
        ['a', 'A'], ['b', 'B'], ['c', 'C'], ['d', 'D'], ['e', 'E'], ['f', 'F'],
        ['g', 'G'], ['h', 'H'], ['i', 'I'], ['j', 'J'], ['k', 'K'], ['l', 'L'],
        ['m', 'M'], ['n', 'N'], ['o', 'O'], ['p', 'P'], ['q', 'Q'], ['r', 'R'],
        ['s', 'S'], ['t', 'T'], ['u', 'U'], ['v', 'V'], ['w', 'W'], ['x', 'X'],
        ['y', 'Y'], ['z', 'Z']
    ];

    $speciales = [
        'espace' => ' ',
        'point' => '.'
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

    function is_lower($car){
        return ($car >= 'a' && $car <= 'z');
    }

    function is_upper($car){
        return ($car >= 'A' && $car <= 'Z');
    }

    function est_caractere($car){
        return (($car >= 'a' && $car <= 'z') || ($car >= 'A' && $car <= 'Z'));
    }

    function est_chiffre($car){
        return ($car >= '0' & $car <= '9');
    }

    function size_t($chaine){
        for($i=0; true; $i++){
            if(!isset($chaine[$i])){
                break;
            }
        }
        return $i;
    }

    function size_Tab($tab){
        $i = 0;
        foreach($tab as $t){
            if(!isset($t)){
                break;
            }else{
                $i++;
            }
        }
        return $i;
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

    function contient_caract($chaine, $car){
        for($i=0; $i<size_t($chaine); $i++){
            if($chaine[$i] === car_tolower($car) || $chaine[$i] === car_toupper($car)){
                return true;
            }
        }
        return false;
    }

    function delete_last_elt($tab){
        $newTab = [];
        for($i=0; $i<size_t($tab)-1; $i++){
            $newTab[] = $tab[$i];
        }
        return $newTab;
    }

    function delete_last_array($tab){
        $newTab = [];
        $i = 0;
        foreach($tab as $t){
            if($i<size_Tab($tab)-1){
                $newTab[] = $t;
                $i++;
            }else{
                break;
            }
        }
        return $newTab;
    }

    function get_chaine($phrase){
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

    function espaces($chaine){
        for($i=0; $i<size_t($chaine); $i++){
            if($chaine[$i] != ' '){
                return false;
            }
        }
        return true;
    }

