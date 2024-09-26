<h1>Entrer la Nourriture Consommée</h1>
<?php if (session()->has('error')): ?>
    <p><?= esc(session('error')); ?></p>
<?php endif; ?>
<form action="/calculate-activity" method="post">
    <label for="aliment">Aliment :</label>
    <input type="text" id="aliment" name="aliment" required>

    <label for="quantite">Quantité (grammes) :</label>
    <input type="number" id="quantite" name="quantite" required>

    <button type="submit">Calculer l'activité recommandée</button>
</form>