<?php
    $questions = getData('questions')['questions'];

    $nbrQ = getData('questions')['nbrQuestion'];
    
    if(isset($_POST) && !empty($_POST)){
        saveNbrQuest($_POST['nbrQuest']);
    }

?>

<div class="admin-card shadow">
    <div class="card-body card-lg">
        <form method="post" class="nbrQuestF" id="nbrQuestForm">
            <label for="nbrQuest">Nombre de question/jeu</label>
            <input type="text" name="nbrQuest" id="nbrQuest" value="<?= $nbrQ ?>">
            <button class="btn" type="submit">OK</button>
        </form>
        <div class="border border-listeQ" id="listeQ">
            <?php foreach($questions as $k => $q): ?>
            <div class="quest-group tab">
                <h3><?= ($k+1).'. '.$q['question'] ?></h3>
                <div class="responses">
                    <?php foreach($q['reponse'] as $k => $rep): ?>
                        <div class="resp-group">
                            <?php if($q['typeRep'] === "texte"){ ?>
                                <input class="respText" type="text" value="<?= $rep ?>" readonly>
                            <?php }else{ ?>
                                <input class="listeQ-Choix" type="<?= $q['typeRep'] ?>" <?= (in_array($k, $q['repC'])) ? 'checked' : '' ?> disabled>
                                <label class="listeQ-label"><?= htmlentities($rep, ENT_QUOTES) ?></label>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card-footer">
        <button id="prev" class="btn btn-md btn-secondary">Précédent</button>
        <button id="next" class="btn btn-md btn-light">Suivant</button>
    </div>
</div>