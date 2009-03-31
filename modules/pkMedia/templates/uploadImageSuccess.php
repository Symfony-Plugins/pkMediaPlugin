<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<h3>Add an Image</h3>
<form method="POST" id="pk-media-edit-form" enctype="multipart/form-data" 
  action="<?php url_for('pkMedia/uploadImage') ?>">
<?php echo $form ?>
<div>
<input type="submit" value="Save" class="submit" />
<span class="or">or</span>
<?php echo link_to("cancel", "pkMedia/resume") ?>
</div>
</form>
