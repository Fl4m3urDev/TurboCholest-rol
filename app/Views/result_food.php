<h1>Résultat</h1>
<p>Vous avez consommé : <?= esc($quantite); ?>g de <?= esc($aliment); ?></p>
<p>Calories ingérées : <?= esc($caloriesIngerees); ?> kcal</p>
<h2>Activité Recommandée</h2>
<img src="<?= base_url('images/activities/' . $imageActivite); ?>" alt="<?= esc($activite); ?>" width="200">
<p>Pour brûler ces calories, vous devez pratiquer <strong><?= esc($activite); ?></strong> pendant environ <strong><?= esc($tempsNecessaire); ?></strong> minutes.</p>
<a href="/ranking">Découvre le classement</a>