<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <link rel="stylesheet" href="./public/css/quizz.css">
    <script src="./public/js/chart.js"></script>
</head>
<body>
    <div class="header">
        <a  class="logo" href="/"><img src="./public/images/logo-QuizzSA.png" alt="Logo SA"></a>
        <div class="header-title">Le plaisir de jouer</div>
    </div>
    <div class="container">    
        <?php
            session_start();
            require_once './traitement/functions.php';
            if(isset($_GET['deconnexion'])){
                $_SESSION['user'] = [];
                unset($_SESSION['user']);
                header('location:./index.php');
            }
        
            if(isset($_GET['page'])){
                if(!empty($_SESSION['user'])){
                    if($_SESSION['user']['role'] === "admin"){
                        $_GET['page'] = 'accueil';
                    }else{
                        $_GET['page'] = 'quizz';
                    }
                }else{
                    $_GET['page'] = '';
                }
                switch($_GET['page']){
                    case '' :
                        require_once './pages/connexion.php';
                    break;
                    case 'accueil' :
                        require_once './pages/admin/accueil_admin.php';
                    break;
                    case 'quizz' :
                        require_once './pages/joueur/interface_joueur.php';
                    break;
                    case 'creer_joueur' :
                        require_once './pages/joueur/creer_joueur.php';
                    break;
                    default:
                        require_once './pages/not_found.php';
                    break;
                }
            }else{
                require_once './pages/connexion.php';
            }
        ?>
    
    </div>

    <script src="./public/js/main.js"></script>
</body>
</html>