<?php use_helper('jQuery') ?>

<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<div id="pk-media-plugin">
	
	<?php include_component('pkMedia', 'browser') ?>

	<div class="pk-media-toolbar">
		<h3>You are editing: <?php echo $item->getTitle() ?></h3>
	</div>

	<div class="pk-media-library">			
	<?php include_partial('pkMedia/editImage', array('item' => $item, 'firstPass' => false, 'form' => $form)) ?>		
	</div>

</div>