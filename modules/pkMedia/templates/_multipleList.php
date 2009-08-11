<?php use_helper('jQuery') ?>

<?php $ids = array() ?>

<?php foreach ($items as $item): ?>
<li id="pk-media-selection-list-item-<?php echo $item->getId() ?>" class="pk-media-selection-list-item">
	<?php $id = $item->getId() ?>
  <ul class="pk-controls pk-media-multiple-list-controls">	
	  <li><?php echo jq_link_to_remote("remove this item",
    array(
      'url' => 'pkMedia/multipleRemove?id='.$id,
      'update' => 'pk-media-selection-list',
			'complete' => 'pkUI("pk-media-selection-list"); pkMediaDeselectItem('.$id.')', 
    ), array(
			'class'=> 'pk-btn icon pk-delete icon-only',
			'title' => 'Remove', )) ?>
		</li>
	</ul>	

  <img src="<?php echo url_for($item->getScaledUrl(pkMediaTools::getOption('selected_constraints'))) ?>" title="Drag &amp; Drop to Order" />

	  <?php $ids[] = $item->getId() ?>

</li>
<?php endforeach ?>


<script type="text/javascript">

	$(document).ready(function() { // On page ready indicate selected items
		pkMediaItemsIndicateSelected(<?php echo json_encode($ids) ?>) 
	});

	function pkMediaItemsIndicateSelected(ids)
	{

		$('.pk-media-selected-overlay').remove();
		
	  var i;
	  for (i = 0; (i < ids.length); i++)
	  {
	    id = ids[i];
	    var selector = '#pk-media-item-' + id;
	    if (!$(selector).hasClass('pk-media-selected')) 
	    {
	      $(selector).addClass('pk-media-selected');
			}
		}
	
		$('.pk-media-item').each(function(){
			if ($(this).hasClass('.pk-media-selected'))
			{
				$(this).prepend('<div class="pk-media-selected-overlay"></div>');
			}
		});

	 	$('.pk-media-selected-overlay').fadeTo(0, 0.66);

	}

	function pkMediaDeselectItem(id)
	{
		$('#pk-media-item-'+id).removeClass('pk-media-selected');
		$('#pk-media-item-'+id).children('.pk-media-selected-overlay').remove();
	}

	$('.pk-media-thumb-link').click(function(){
		$(this).addClass('pk-media-selected');
	});

</script>
