<h2>Saisie d'Activités</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php form_open('activite/formulaire_activite') ?>

<div class="form-group">
    <?php form_label('Nom de l\'Activité', 'nom') ?>
    <?php form_input(['name' => 'nom', 'id' => 'nom', 'class' => 'form-control', 'required' => 'required']) ?>
</div>
<div class="form-group">
    <?php form_label('Calories brûlées par minute', 'calories') ?>
    <?php form_input(['name' => 'calories', 'id' => 'calories', 'type' => 'number', 'class' => 'form-control', 'required' => 'required']) ?>
</div>
<?php form_submit(['value' => 'Ajouter Activité', 'class' => 'btn btn-primary']) ?>
<?php form_close() ?>