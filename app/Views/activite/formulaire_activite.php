<div class="container-fluid">
    <h2 class='mt-2 text-center'><?php echo $TitreDeLaPage ?></h2>
    <hr />

    <?php form_open('Activite/formulaire_activite') ?>
    <div class="mb-3">
        <?php echo form_label('Nom de l\'Activité', 'txtNom') ?>
        <?php echo form_input('txtNom', set_value('txtNom'), 'class="form-control"') ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Calories brûlées par minute', 'txtCalorie') ?>
        <?php echo form_input(['txtCalorie', set_value('txtCalorie'), 'type' => 'number', 'class' => 'form-control']) ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit('submit', 'Ajouter Activité', 'class="btn btn-primary"');
        echo form_close() ?>
    </div>
</div>