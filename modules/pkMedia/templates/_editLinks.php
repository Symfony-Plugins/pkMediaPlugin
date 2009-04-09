<?php use_helper('jQuery') ?>
<?php if ($mediaItem->userHasPrivilege('edit')): ?>
	<div class="pk-media-edit-links">
    <?php $imagewidth = pkMediaTools::getOption("gallery_width") ?>
    <?php $imageheight = pkMediaTools::getOption("gallery_height") ?>
    <?php if ($imageheight === false): ?>
      <?php $imageheight = ceil($imagewidth * ($mediaItem->getHeight() / $mediaItem->getWidth())); ?>
    <?php endif ?>
    <?php $height = $imageheight + 500 ?>
    <?php $mid = $mediaItem->getId() ?>
    <?php if ($mediaItem->getType() === 'video'): ?>
      <?php echo link_to("Edit<span></span>", "pkMedia/editVideo", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn")) ?>
    <?php else: ?>
      <?php echo link_to("Edit<span></span>", "pkMedia/editImage", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn")) ?>
    <?php endif ?>
  	<?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
    	array("slug" => $mediaItem->getSlug())),
    	array("confirm" => "Are you sure you want to delete this item?", "class"=>"pk-btn delete")) ?>
	</div>
<?php endif ?>
