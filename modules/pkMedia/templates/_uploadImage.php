<?php $previewable = pkValidatorFilePersistent::previewAvailable($form['file']->getValue()) ?>
<?php $errors = $form['file']->hasError() ?>

<div class="form-row newfile <?php echo(($first || $previewable || $errors) ? "" : "initially-inactive") ?>">
	<?php echo $form['file']->renderError() ?>
	<?php echo $form['file']->render() ?>
	<?php if (!$first): ?>
	  <ul class="pk-controls pk-media-upload-subform-controls"><li><a href="#" class="pk-btn icon icon-only pk-close">Remove</a></li></ul>
	<?php endif ?>
</div>
