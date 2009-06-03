<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<?php include_component('pkMedia', 'browser') ?>

<div class="pk-media-toolbar">
	<h3>Annotate Images</h3>
</div>

<div class="pk-media-library">				
	<form method="POST" action="<?php echo url_for("pkMedia/editImages") ?>" enctype="multipart/form-data" id="pk-media-edit-form">
	
	<input type="hidden" name="active" value="<?php echo implode(",", $active) ?>" />

	<?php $n = 0 ?>

	<ul>
		<?php for ($i = 0; ($i < pkMediaTools::getOption('batch_max')); $i++): ?>
		  <?php if (isset($form["item-$i"])): ?>
		    <?php // What we're passing here is actually a widget schema ?>
		    <?php // (they get nested when embedded forms are present), but ?>
		    <?php // it supports the same methods as a form for rendering purposes ?>
		    <?php include_partial('pkMedia/editImage', 
							array(
								"item" => false, 
		        		"firstPass" => $firstPass, 
								"form" => $form["item-$i"], 
								"n" => $n, 
								'i' => $i,
								'itemFormScripts' => 'false',
								)) ?>
				<?php $n++ ?>
		  <?php endif ?>
		<?php endfor ?>
	</ul>

	<?php include_partial('pkMedia/itemFormScripts', array('i'=>$i)) ?>

	<?php //We should wrap this with logic to say 'photo' if only one object has been uploaded ?>
	<ul class="pk-controls pk-media-edit-footer">
		<li><input type="submit" name="submit" value="Save Images" class="pk-submit" /></li>
		<li><?php echo link_to("cancel", "pkMedia/resume", array("class"=>"pk-cancel pk-btn icon event-default")) ?></li>
	</ul>
	</form>
</div>