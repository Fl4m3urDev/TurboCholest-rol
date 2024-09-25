<div class="container-fluid">
  <h1 class='mt-2 text-center'><?php echo $TitreDeLaPage ?></h1>
  <hr />
  <?php echo form_open('Visiteur/voirCalculDepense') ?>
  <div class="mb-3">
        <?php echo form_label('Image', 'txtNomFichierImage', ['class' => 'form-label']); ?>
    </div>
  <div class="mb-3">
        <?php echo form_label('Phrase explicatif de l\'activité à pratiquer ou la nourriture à manger', 'txtNomFichierImage', ['class' => 'form-label']); ?>
        <?php echo form_textarea('txtTexte', set_value('txtTexte'), ['class' => 'form-control']); ?>
  </div>
  <div class="mb-3">
    <button class="btn btn-primary">Recalculer un équivalent</button>
  </div>
  <div class="mb-3">
    <!-- <button class="btn btn-primary"><a class="" href="">Découvre le classement</a></button> -->
    <?php echo form_submit('submit', 'Découvre le classement', 'class="btn btn-primary"');
        echo form_close(); ?>
  </div>
</div>