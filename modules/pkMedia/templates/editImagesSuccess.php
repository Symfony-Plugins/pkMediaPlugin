<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<?php include_component('pkMedia', 'breadcrumb') ?>

<?php include_component('pkMedia', 'browser') ?>

<div class="main">
	<div class="content-container">
		<div class="content">
			
				<div class="pk-admin-controls shadow caution">
					<div class="pk-admin-controls-padding caution-padding">
						<h3>Annotate Images</h3>
					</div>
				</div>
				
				<form method="POST" 
				  action="<?php echo url_for("pkMedia/editImages") ?>" 
				  enctype="multipart/form-data"
				  id="pk-media-edit-form">
				<input type="hidden" name="active" value="<?php echo implode(",", $active) ?>" />
				<?php $n = 0 ?>
				<ul>
				<?php for ($i = 0; ($i < pkMediaTools::getOption('batch_max')); $i++): ?>
				  <?php if (isset($form["item-$i"])): ?>
				    <?php // What we're passing here is actually a widget schema ?>
				    <?php // (they get nested when embedded forms are present), but ?>
				    <?php // it supports the same methods as a form for rendering purposes ?>
				    <?php include_partial('pkMedia/editImage',
				      array("item" => false, 
				        "firstPass" => $firstPass, "form" => $form["item-$i"], "n" => $n, 'i' => $i, )) ?>
						<?php $n++ ?>
				  <?php endif ?>
				<?php endfor ?>
				</ul>
				<?php //We should wrap this with logic to say 'photo' if only one object has been uploaded ?>
				<div class="pk-media-edit-footer">
					<?php echo link_to_function("Save Images<span></span>", "$('#pk-media-edit-form').submit()", array("class"=>"pk-btn")) ?>
					<span class="or"> or </span><?php echo link_to("cancel", "pkMedia/resume", array("class"=>"cancel")) ?>
				</div>
				</form>

	</div>
</div>
