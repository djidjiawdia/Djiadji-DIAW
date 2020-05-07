<?php

    $nameAvatar = "Avatar admin";
    $title = "Pour proposer des quizz";

    if(!empty($_POST)){
        extract($_POST);
        if(searchLogin($login)){
            header("location:index.php?page=accueil&menu=creerA&errorLog");
        }else{
            
            $fileName = $_FILES['avatar']['name'];
            $fileExt = explode(".", $fileName);
            $fileActExt = strtolower(end($fileExt));
            
            $newFileName = $login.".".$fileActExt;
            $fileDest = './uploads/'.$newFileName;
            $path = "./uploads/".$newFileName;
            if(saveUser($nom, $prenom, $login, $password, $path, "admin")){
                move_uploaded_file($_FILES['avatar']['tmp_name'], $fileDest);
                header('location:index.php?page=accueil&menu=listeJ');
            }else{
                header("location:index.php?page=accueil&menu=creerA&errorSave");
            }
    
        }
    }

    include_once './pages/inscription.php';

?>