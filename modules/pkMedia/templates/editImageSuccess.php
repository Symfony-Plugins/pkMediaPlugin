<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>

	<?php // Rick and I wanted to put the breadcrumb and the browser back because this page felt naked and out of place without it.
				// I know it's not functionally relavent to the task at hand, but visually it's less startling to move from the upload page to this page now. ?>

	<?php include_component('pkMedia', 'breadcrumb', array("item" => $mediaItem)) ?>
	<?php include_component('pkMedia', 'browser') ?>

<?php include_partial('pkMedia/editImage', 
  array('item' => $item, 'firstPass' => false, 'form' => $form)) ?>
