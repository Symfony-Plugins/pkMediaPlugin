<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>

	<?php // Rick and I wanted to put the breadcrumb and the browser back because this page felt naked and out of place without it.
				// I know it's not functionally relavent to the task at hand, but visually it's less startling to move from the upload page to this page now. ?>

	<?php include_component('pkMedia', 'breadcrumb', array("item" => $item)) ?>
	<?php include_component('pkMedia', 'browser') ?>

	<div class="main">
		<div class="content-container">
			<div class="content">

	      <div class="pk-admin-controls shadow caution">
	        <div class="pk-admin-controls-padding caution-padding">
		
						<h3>You are editing: <?php echo $item->getTitle() ?></h3>
			
					</div>
				</div>
					
					
<?php include_partial('pkMedia/editImage', array('item' => $item, 'firstPass' => false, 'form' => $form)) ?>

			</div>
		</div>
	</div>
		
