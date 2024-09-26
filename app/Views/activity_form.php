<h2 class="mt-4">Entre ton activité de la journée, et découvre ce que tu peux manger !</h2>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?= form_open('/sauver-activite') ?>

<div class="form-group">
    <?= form_label('Nom de l\'Activité', 'nom') ?>
    <?= form_input(['name' => 'nom', 'id' => 'nom', 'class' => 'form-control', 'required' => 'required']) ?>
</div>
<div class="form-group">
    <?= form_label('Calories brûlées par minute', 'calories') ?>
    <?= form_input(['name' => 'calories', 'id' => 'calories', 'type' => 'number', 'class' => 'form-control', 'required' => 'required']) ?>
</div>
<?= form_submit(['value' => 'Ajouter Activité', 'class' => 'btn btn-primary']) ?>
<?= form_close() ?>