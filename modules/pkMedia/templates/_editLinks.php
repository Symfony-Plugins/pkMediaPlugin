<?php use_helper('jQuery') ?>
<?php if ($mediaItem->userHasPrivilege('edit')): ?>
	<ul class="pk-controls pk-media-edit-links">

    <?php if ($mediaItem->getType() === 'video'): ?>
      <li><?php echo link_to("Edit", "pkMedia/editVideo", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn icon pk-edit")) ?></li>
    <?php elseif ($mediaItem->getType() === 'pdf'): ?>
      <li><?php echo link_to("Edit", "pkMedia/editPdf", array("query_string" => http_build_query(array("slug" => $mediaItem->getSlug())), "class" => "pk-btn icon pk-edit")) ?></li>
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
