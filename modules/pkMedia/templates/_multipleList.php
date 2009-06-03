<?php use_helper('jQuery') ?>

<script type="text/javascript">
function pkMediaItemsIndicateSelected(ids)
{
  <?php // Clean up any previous selection indicators ?>
  $('.pk-media-item-thumbnail').removeClass('pk-media-selected');
  $('.pk-media-selected-overlay').remove();
  var i;
  for (i = 0; (i < ids.length); i++)
  {
    id = ids[i];
    var selector = '#pk-media-item-thumbnail-' + id;
    if (!$(selector).hasClass('pk-media-selected')) 
    {
      $(selector).addClass('pk-media-selected');
      var overlayId = 'pk-media-selected-overlay-' + id;
      var overlaySelector = '#' + overlayId;
      $(selector).prepend('<div id="' + overlayId + '" class="pk-media-selected-overlay"></div>');

     	$(overlaySelector).fadeTo(0, 0.66);
    }
  }
}
</script>
<?php $ids = array() ?>

<?php foreach ($items as $item): ?>
<li id="pk-media-selection-list-item-<?php echo $item->getId() ?>" class="pk-media-selection-list-item">
	<?php $id = $item->getId() ?>
  <ul class="pk-controls pk-media-multiple-list-controls">	
	  <li><?php echo jq_link_to_remote("remove this item",
    array(
      "url" => "pkMedia/multipleRemove?id=$id",
      "update" => "pk-media-selection-list"
    ), array("class"=>"pk-btn icon pk-delete icon-only")) ?>
		</li>
	</ul>	

  <img src="<?php echo url_for("pkMedia/image?" .
    http_build_query(array(
      "slug" => $item->getSlug(),
      "width" => 
        pkMediaTools::getOption("selected_width"),
      "height" => 
        pkMediaTools::getOption("selected_height"),
      "resizeType" => 
        pkMediaTools::getOption("selected_resizeType"),
      "format" =>
        $item->getFormat())))
    ?>" />

	  <?php $ids[] = $item->getId() ?>

</li>
<?php endforeach ?>

<?php // Wait for the page to be ready, then show which items are selected ?>
<script type="text/javascript">
	$(document).ready(function() { 
		pkMediaItemsIndicateSelected(<?php echo json_encode($ids) ?>) 
	});
</script>
