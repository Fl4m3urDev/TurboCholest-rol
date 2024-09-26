<h1>Résultat</h1>
<p>Vous avez pratiqué : <?= esc($activite); ?> pendant <?= esc($duree); ?> minutes</p>
<p>Calories dépensées : <?= esc($caloriesDepensees); ?> kcal</p>
<h2>Nourriture Équivalente</h2>
<img src="<?= base_url('images/foods/' . $imageAliment); ?>" alt="<?= esc($aliment); ?>" width="200">
<p>Vous pouvez consommer environ <strong><?= esc($quantiteNecessaire); ?>g</strong> de <strong><?= esc($aliment); ?></strong> pour équilibrer votre apport calorique.</p>
<a href="/ranking">Découvre le classement</a>