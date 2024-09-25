<div class="container-fluid">
    <h2 class='mt-2 text-center'>Saisie d'Activités</h2>
    <hr />

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php form_open('Activite/formulaire_activite') ?>
    <div class="mb-3">
        <?php echo form_label('Nom de l\'Activité', 'nom') ?>
        <?php echo form_input(['name' => 'nom', 'id' => 'nom', 'class' => 'form-control', 'required' => 'required']) ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Calories brûlées par minute', 'calories') ?>
        <?php echo form_input(['name' => 'calories', 'id' => 'calories', 'type' => 'number', 'class' => 'form-control', 'required' => 'required']) ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit(['value' => 'Ajouter Activité', 'class' => 'btn btn-primary']) ?>
        <?php echo form_close() ?>
    </div>
</div>