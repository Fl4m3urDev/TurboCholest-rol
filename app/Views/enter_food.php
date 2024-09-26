
<h2>Entrer la Nourriture Consommée</h2>
<?php if (session()->has('error')): ?>
    <p><?= esc(session('error')); ?></p>
<?php endif; ?>
<form action="/calculate-activity" method="post">
    <label for="aliment">Aliment :</label>
    <select id="aliment" name="aliment" required>
        <option value="">-- Sélectionnez un aliment --</option>
        <?php foreach ($foods as $food): ?>
            <option value="<?= esc($food['nom']); ?>"><?= esc($food['nom']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="quantite">Quantité (grammes) :</label>
    <input type="number" id="quantite" name="quantite" required>

    <button type="submit">Calculer l'activité recommandée</button>
</form>
