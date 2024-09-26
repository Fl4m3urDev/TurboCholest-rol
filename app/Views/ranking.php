<h1>Classement des Gros Mangeurs</h1>
<table>
    <tr>
        <th>Position</th>
        <th>Utilisateur</th>
        <th>Total Calories</th>
    </tr>
    <?php foreach ($eaters as $index => $eater): ?>
    <tr>
        <td><?= $index + 1; ?></td>
        <td><?= esc($eater['nom']); ?></td>
        <td><?= esc($eater['total_calories']); ?> kcal</td>
    </tr>
    <?php endforeach; ?>
</table>

<h1>Classement des Plus Sportifs</h1>
<table>
    <tr>
        <th>Position</th>
        <th>Utilisateur</th>
        <th>Total Calories Dépensées</th>
    </tr>
    <?php foreach ($athletes as $index => $athlete): ?>
    <tr>
        <td><?= $index + 1; ?></td>
        <td><?= esc($athlete['nom']); ?></td>
        <td><?= esc($athlete['total_calories']); ?> kcal</td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="/choose-action">Changer les données</a>