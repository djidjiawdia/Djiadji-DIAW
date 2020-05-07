<?php

    $players = getPlayers();

?>

<div class="admin-card listeJ">
    <h1>Liste des joueurs par score</h1>
    <table id="listeJ">
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Score</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($players as $p): ?>
            <tr>
                <td style="text-transform:uppercase;"><?= $p['nom'] ?></td>
                <td style="text-transform:capitalize;"><?= $p['prenom'] ?></td>
                <td><?= $p['score'].' pts' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="nextPrev">
        <button id="prev" class="btn btn-md btn-secondary">Précédent</button>
        <button id="next" class="btn btn-md btn-light">Suivant</button>
    </div>
</div>