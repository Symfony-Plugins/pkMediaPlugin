<?php $previewable = pkValidatorFilePersistent::previewAvailable($form['file']->getValue()) ?>
<?php $errors = $form['file']->hasError() ?>
<div class="form-row newfile <?php echo(($first || $previewable || $errors) ? "" : "initially-inactive") ?>">
<?php echo $form['file']->renderError() ?>
<?php echo $form['file']->render() ?>
<?php if (!$first): ?>
  <a href="#" class="pk-remove">Remove</a>
<?php endif ?>
</div>
