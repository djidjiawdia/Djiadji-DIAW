<?php 

    $nameAvatar = "Avatar du joueur";
    $title = "Pour tester votre niveau de culture générale";

    if(!empty($_POST)){
        extract($_POST);
        if(searchLogin($login)){
            header("location:./index.php?page=creer_joueur&errorLog");
        }else{
            
            $fileName = $_FILES['avatar']['name'];
            $fileExt = explode(".", $fileName);
            $fileActExt = strtolower(end($fileExt));
            
            $newFileName = $login.".".$fileActExt;
            $fileDest = './uploads/'.$newFileName;
            $path = "./uploads/".$newFileName;
            if(saveUser($nom, $prenom, $login, $password, $path, "joueur")){
                move_uploaded_file($_FILES['avatar']['tmp_name'], $fileDest);
                $_SESSION['user'] = [
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "login" => $login,
                    "role" => "joueur",
                    "profil" => $path,
                    "bonneRep" => [],
                    "score" => 0
                ];
                header('location:./index.php?page=quizz');
            }else{
                header("location:./index.php?page=creer_joueur&errorSave");
            }
    
        }
    }
    
    include_once './pages/inscription.php';
?>
