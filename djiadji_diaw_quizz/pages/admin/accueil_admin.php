<div class="card card-lg">
    <div class="card-header">
        <h2>Créer et paramétrer vos quizz</h2>
        <a class="logout-text" href="index.php?deconnexion" id="deconnexion">Déconnexion</a>
        <a class="logout-img" href="index.php?deconnexion" id="deconnexion">
            <img src="./public/images/logout.svg">
        </a>
    </div>
    <div class="card-body row">
        <div class="col-sm">
            <div class="profil-card">
                <div class="profil-card-header">
                    <img class="icon-profil" src="<?= $_SESSION['user']['profil'] ?>" alt="Avatar">
                    <div>
                        <h2 class="prenom"><?= $_SESSION['user']['prenom']; ?></h2>
                        <h2 class="nom"><?= $_SESSION['user']['nom']; ?></h2>
                    </div>
                </div>
                <div class="profil-card-body">
                    <ul class="menu">
                        <li>
                            <a class="nav-link" href="index.php?page=accueil&menu=listeQ">Liste Questions</a>
                            <img src="./public/icones/ic-liste.png">
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?page=accueil&menu=creerA">Créer Admin</a>
                            <img src="./public/icones/ic-ajout.png">
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?page=accueil&menu=listeJ">Liste Joueurs</a>
                            <img src="./public/icones/ic-liste.png">
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?page=accueil&menu=creerQ">Créer Question</a>
                            <img src="./public/icones/ic-ajout.png">
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?page=accueil&menu=dashboard">DashBoard</a>
                            <img src="./public/icones/ic-dashboard.png">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-page col-md">

        <?php
            if(isset($_GET['menu'])){
                switch($_GET['menu']){
                    case 'listeQ' : 
                        include_once 'liste_questions.php';
                    break;
                    case 'creerA' :
                        include_once 'creer_admin.php';
                    break;
                    case 'listeJ' :
                        include_once 'liste_joueurs.php';
                    break;
                    case 'creerQ' :
                        include_once 'creer_question.php';
                    break;
                    case 'dashboard' :
                        include_once 'dashboard.php';
                    break;
                    default :
                        echo '<h3>Page inconnue</h3>';
                    break;
                }
            }else{
                include_once 'liste_questions.php';
            }
        ?>
            
        </div>
    </div>
</div>
>
