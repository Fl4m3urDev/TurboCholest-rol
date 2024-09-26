<h1>Vos Informations Personnelles</h1>
<?php if (session()->has('errors')): ?>
    <div class="errors">
        <?php foreach (session('errors') as $error): ?>
            <p><?= esc($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<form action="/save-personal-data" method="post">
    <label for="poids">Poids (kg) :</label>
    <input type="number" id="poids" name="poids" required>

    <label for="taille">Taille (cm) :</label>
    <input type="number" id="taille" name="taille" required>

    <label for="age">Âge :</label>
    <input type="number" id="age" name="age" required>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
        <option value="homme">Homme</option>
        <option value="femme">Femme</option>
    </select>

    <label for="activite">Niveau d'activité quotidienne :</label>
    <select id="activite" name="niveau_activite" required>
        <option value="sedentaire">Sédentaire</option>
        <option value="faible">Faible</option>
        <option value="modere">Modéré</option>
        <option value="actif">Actif</option>
        <option value="tres_actif">Très Actif</option>
    </select>

    <button type="submit">Enregistrer</button>
</form>