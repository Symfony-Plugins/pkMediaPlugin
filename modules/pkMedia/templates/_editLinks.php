<?php use_helper('jQuery') ?>
<?php if ($mediaItem->userHasPrivilege('edit')): ?>
  <?php $id = "pk-media-iframe-container-" . $mediaItem->getId() ?>
  <script>
  <?php if ($mediaItem->getType() === 'image'): ?>
    $('#<?php echo $id?>').data('editUrl',
      <?php echo json_encode(url_for("pkMedia/editImage?" . http_build_query(
        array("slug" => $mediaItem->getSlug(), "iframe" => true)))) ?>);
  <?php else: ?>
    $('#<?php echo $id?>').data('editUrl',
      <?php echo json_encode(url_for("pkMedia/editVideo?" . http_build_query(
        array("slug" => $mediaItem->getSlug(), "iframe" => true)))) ?>);
  <?php endif ?>
  </script>
	<div class="pk-media-edit-links">
    <?php $imagewidth = pkMediaTools::getOption("gallery_width") ?>
    <?php $imageheight = pkMediaTools::getOption("gallery_height") ?>
    <?php if ($imageheight === false): ?>
      <?php $imageheight = ceil($imagewidth * ($mediaItem->getHeight() / $mediaItem->getWidth())); ?>
    <?php endif ?>
    <?php $height = $imageheight + 500 ?>
    <?php $mid = $mediaItem->getId() ?>
  	<?php echo link_to_function("Edit<span></span>", "$('#$id').html('<iframe id=\"pk-media-edit-iframe-$mid\" frameborder=\"0\" border=\"0\" width=\"340\" height=\"$height\" src=\"' + $('#$id').data('editUrl') + '\"></iframe>'); $('#pk-media-item-content-".$mediaItem->getId()."').hide();", array("class"=>"pk-btn")) ?>
  	<?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
    	array("slug" => $mediaItem->getSlug())),
    	array("confirm" => "Are you sure you want to delete this item?", "class"=>"pk-btn delete")) ?>
	</div>
<script>
function pkResizeIframe(id, height)
{
  $('#pk-media-edit-iframe-' + id)[0].height = height;
}
</script>
<?php endif ?>
