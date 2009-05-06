<?php if (!isset($n)): ?>
<?php $n = 0 ?>
<?php endif ?>
<?php if (!$item): ?>	
<div class="pk-media-item <?php echo ($n%2) ? "odd" : "even" ?>">
	<div class="pk-media-item-edit-form">
<?php endif ?>
<?php if ($item): ?>
<form method="POST" id="pk-media-edit-form" enctype="multipart/form-data" 
  action="<?php echo url_for(pkUrl::addParams("pkMedia/editImage",
    array("slug" => $item->getSlug())))?>">
<?php endif ?>

		<div class="form-row title">
		<?php echo $form['title']->renderLabel() ?>
		<?php if (!$firstPass): ?>
		  <?php echo $form['title']->renderError() ?>
		<?php endif ?>
		<?php echo $form['title']->render() ?>
		</div>
		<?php $previewAvailable = pkValidatorFilePersistent::previewAvailable($form['file']->getValue()) ?>
		<?php if ($previewAvailable || $item): ?>
		<div class="form-row image">
		<?php if (0): ?>
		  <?php // Maybe Rick doesn't want this... ?>
		  <?php echo $form['file']->renderLabel() ?>
		<?php endif ?>
		<?php // But we must have this ?>
		<?php echo $form['file']->renderError() ?>
		<?php // Output the item's image only if a preview of a newer one is ?>
		<?php // not already present courtesy of the persistent file upload widget ?>
		<?php if (!$previewAvailable): ?>
		  <?php $slug = $item->getSlug() ?>
		  <?php $width = pkMediaTools::getOption("gallery_width") ?>
		  <?php $height = pkMediaTools::getOption("gallery_height") ?>
      <?php if ($height === false): ?>
        <?php $height = ceil(($width * $item->getHeight()) / $item->getWidth()) ?>
      <?php endif ?>
		  <?php $resizeType = pkMediaTools::getOption("gallery_resizeType") ?>
		  <?php $format = $item->getFormat() ?>
		  <img src="<?php echo url_for("pkMedia/image?" . http_build_query(array("slug" => $slug, "width" => $width, "height" => $height, "resizeType" => $resizeType, "format" => $format))) ?>" />
		<?php endif ?>
		<?php echo $form['file']->render() ?>
		<?php else: ?>
		<div class="form-row newfile">
		<?php echo $form['file']->renderRow() ?>
		</div>
		<?php endif ?>
		</div>
		<?php echo $form['id']->render() ?>
		<div class="form-row description">
			<?php echo $form['description']->renderLabel() ?>
			<?php echo $form['description']->renderError() ?>
			<?php echo $form['description']->render() ?>
		</div>
		<div class="form-row credit"><?php echo $form['credit']->renderRow() ?></div>

    <div class="form-row tags help">
    Tags should be separated by commas. Example: student life, chemistry, laboratory
    </div>
		<div class="form-row tags"><?php echo $form['tags']->renderRow() ?></div>

    <div class="form-row permissions help">
			Hidden Photos can be used in photo slots, but are not displayed in the Media section.
    </div>
		<div class="form-row permissions">
			<?php echo $form['view_is_secure']->renderLabel() ?>
			<?php echo $form['view_is_secure']->renderError() ?>
			<?php echo $form['view_is_secure']->render() ?>
		</div>

    <?php if ($item): ?>
	    <div class="pk-media-edit-footer">
      <input type="submit" value="Save" class="submit" />
      <span class="or">or</span>
      <?php $id = $item->getId() ?>
      <?php echo link_to("cancel", "pkMedia/resumeWithPage", array("class" => "cancel")) ?>
        <?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
          array("slug" => $item->slug)),
          array("confirm" => "Are you sure you want to delete this item?", "class"=>"pk-btn delete"),
          array("target" => "_top")) ?>
      </form>
    	</div>
    <?php endif ?>
				
<?php if (!$item): ?>
	</div>
</div>
<?php endif ?>

<?php include_partial('pkMedia/itemFormScripts') ?>
