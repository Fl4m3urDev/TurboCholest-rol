<h2>Saisie d'Activités</h2>

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