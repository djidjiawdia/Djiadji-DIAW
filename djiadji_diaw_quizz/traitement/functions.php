<?php

function searchLogin($login){
    $users = getData();
    foreach($users as $u){
        if(strtolower(trim($login)) === strtolower($u['login'])){
            return $u;
        }
    }
    return false;
}

function saveUser($nom, $prenom, $login, $password, $profil, $role){
    $users = getData();
    $users[] = [
        "nom" => $nom,
        "prenom" => $prenom,
        "login" => $login,
        "password" => $password,
        "profil" => $profil,
        "score" => 0,
        "bonneRep" => [],
        "role" => $role
    ];

    if(file_put_contents("./data/users.json", json_encode($users))){
        return true;
    }else{
        return false;
    }

}

function changeScore($login, $score){
    $newTabusers = [];
    $users = getData();
    foreach($users as $u){
        if(strtolower(trim($login)) === strtolower($u['login'])){
            $u['score'] = $score;
        }
        $newTabusers[] = $u; 
    }
    if(file_put_contents("./data/users.json", json_encode($newTabusers))){
        return true;
    }else{
        return false;
    }
}

function changeBonneRep($login, $tabRep){
    $newTabusers = [];
    $users = getData();
    foreach($users as $u){
        if(strtolower(trim($login)) === strtolower($u['login'])){
            $u['bonneRep'] = $tabRep;
        }
        $newTabusers[] = $u; 
    }
    if(file_put_contents("./data/users.json", json_encode($newTabusers))){
        return true;
    }else{
        return false;
    }
}

function getPlayers(){
    $users = getData();
    $players = [];
    foreach($users as $u){
        if($u['role'] === "joueur"){
            $players[] = $u;
        }
    }
    return $players;
}

function topScores(){
    $players = getPlayers();
    for($i=0; $i<sizeof($players); $i++){
        for($j=$i+1; $j<sizeof($players); $j++){
            if((int)$players[$i]['score'] < (int)$players[$j]['score']){
                $svg = $players[$i];
                $players[$i] = $players[$j];
                $players[$j] = $svg;
            }
        }
    }
    $n = (sizeof($players) < 5)?sizeof($players):5;
    return array_slice($players, 0, $n);
}

function idQuestion() {
    $questions = getData('questions')['questions'];
    $id = $questions[count($questions)-1]['id'];
    return ++$id;
}

function saveNbrQuest($post){
    $questions = getData('questions');

    $questions['nbrQuestion'] = $post;

    if(file_put_contents("./data/questions.json", json_encode($questions))){
        return true;
    }else{
        return false;
    }
}

function saveQuestion($post){
    $questions = getData('questions');
    $post = array_merge(["id" => idQuestion()], $post);
    $questions['questions'][] = $post;

    if(file_put_contents("./data/questions.json", json_encode($questions))){
        return true;
    }else{
        return false;
    }
}

function interfaceQuestions(array $rep){
    $tabs = [];
    $tabQuest = [];
    $questions = getData('questions');
    foreach($questions['questions'] as $q){
        if(!in_array($q['id'], $rep)){
            $tabQuest[] = $q;
        }
    }
    $nbrQuest = (sizeof($tabQuest) > $questions['nbrQuestion']) ? $questions['nbrQuestion'] : sizeof($tabQuest);
    if(!empty($tabQuest)){
        $rand = array_rand($tabQuest, $nbrQuest);
        for($i=0; $i<$nbrQuest; $i++){
            $tabs[] = $tabQuest[$rand[$i]];
        }
    }
    return $tabs;
}

function getData(string $file = 'users'){
    $fetchJson = file_get_contents("./data/". $file . ".json");
    return json_decode($fetchJson, true);
}