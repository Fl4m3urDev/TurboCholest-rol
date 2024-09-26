<h1  class="mt-4">Entrer une Activité Physique</h1>
<?php if (session()->has('error')): ?>
    <p><?= esc(session('error')); ?></p>
<?php endif; ?>
<!-- <div class="mt-3">

    <form action="/calculate-food" method="post">
        <label for="activite">Activité :</label>
        <input type="text" id="activite" name="activite" required>
    
        <label for="duree">Durée (minutes) :</label>
        <input type="number" id="duree" name="duree" required>
    
        <button type="submit">Calculer la nourriture équivalente</button>
    </form>

</div> -->

<!-- <h1 class="mt-4">Entrer une Activité Physique</h1> -->
<?php if (session()->has('error')): ?>
    <p><?= esc(session('error')); ?></p>
<?php endif; ?>
<div class="mt-3">
    <form action="/calculate-food" method="post">
        <label for="activite">Activité :</label>
        <select id="activite" name="activite" required>
            <option value="">-- Sélectionnez une activité --</option>
            <?php foreach ($activities as $activity): ?>
                <option value="<?= esc($activity['nom']); ?>"><?= esc($activity['nom']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="duree">Durée (minutes) :</label>
        <input type="number" id="duree" name="duree" required>

        <button type="submit">Calculer la nourriture équivalente</button>
    </form>
</div>


