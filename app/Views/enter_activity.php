<h1>Entrer une Activité Physique</h1>
<?php if (session()->has('error')): ?>
    <p><?= esc(session('error')); ?></p>
<?php endif; ?>
<form action="/calculate-food" method="post">
    <label for="activite">Activité :</label>
    <input type="text" id="activite" name="activite" required>

    <label for="duree">Durée (minutes) :</label>
    <input type="number" id="duree" name="duree" required>

    <button type="submit">Calculer la nourriture équivalente</button>
</form>