<?php use_helper('jQuery') ?>
<?php if ($mediaItem->userHasPrivilege('edit')): ?>
	<ul class="pk-controls pk-media-edit-links">

    <?php $imagewidth = pkMediaTools::getOption("gallery_width") ?>
    <?php $imageheight = pkMediaTools::getOption("gallery_height") ?>

    <?php if ($imageheight === false): ?>
      <?php $imageheight = ceil($imagewidth * ($mediaItem->getHeight() / $mediaItem->getWidth())); ?>
    <?php endif ?>

    <?php $height = $imageheight + 500 ?>
    <?php $mid = $mediaItem->getId() ?>

    <?php if ($mediaItem->getType() === 'video'): ?>
      <li><?php echo link_to("Edit", "pkMedia/editVideo", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn icon pk-edit")) ?></li>
    <?php else: ?>
      <li><?php echo link_to("Edit", "pkMedia/editImage", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn icon pk-edit")) ?></li>
    <?php endif ?>
  	
		<?php if ($mediaItem->getType() !== 'video' && $sf_params->get('action') == 'show'): ?>
	  <li class="pk-media-download-original">
	     <?php // download link ?>
	     <?php echo link_to("Download Original", "pkMedia/original?".http_build_query(array(
	             "slug" => $mediaItem->getSlug(),
	             "format" => $mediaItem->getFormat())),
	              array(
					"class"=>"pk-btn icon pk-download"
					))?>
		</li>
		<?php endif ?>


		<li><?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
    	array("slug" => $mediaItem->getSlug())),
    	array("confirm" => "Are you sure you want to delete this item?", "class"=>"pk-btn icon pk-delete")) ?></li>
	</ul>
<?php endif ?>
