<?php $type = $mediaItem->getType() ?>
<?php $id = $mediaItem->getId() ?>
<?php $serviceUrl = $mediaItem->getServiceUrl() ?>
<?php $slug = $mediaItem->getSlug() ?>

<?php if (pkMediaTools::isSelecting()): ?>

  <?php if (pkMediaTools::isMultiple()): ?>
    <?php $linkAttributes = 'href = "#" onClick="'. 
      jq_remote_function(array(
				"update" => "pk-media-selection-list",
				'complete' => "pkUI('pk-media-selection-list');",  
        "url" => "pkMedia/multipleAdd?id=$id")).'; return false;"' ?>
  <?php else: ?>
    <?php $linkAttributes = 'href = "' . url_for("pkMedia/selected?id=$id") . '"' ?>
  <?php endif ?>

<?php else: ?>

  <?php $linkAttributes = 'href = "' . url_for("pkMedia/show?" . http_build_query(array("slug" => $slug))) . '"' ?>

<?php endif ?>

<li class="pk-media-item-thumbnail">
<?php include_partial('pkMedia/editLinks', array('mediaItem' => $mediaItem)) ?>
  <a <?php echo $linkAttributes ?> class="pk-media-thumb-link">
    <?php if ($type == 'video'): ?><span class="pk-media-play-btn"></span><?php endif ?>
    <?php if ($type == 'pdf'): ?><span class="pk-media-pdf-btn"></span><?php endif ?>
    <img src="<?php echo url_for($mediaItem->getScaledUrl(pkMediaTools::getOption('gallery_constraints'))) ?>" />
  </a>
</li>

<?php // Stored as HTML ?>
<li class="pk-media-item-title">
	<h3>
		<a <?php echo $linkAttributes ?>><?php echo htmlspecialchars($mediaItem->getTitle()) ?></a>
		<?php if ($mediaItem->getViewIsSecure()): ?><span class="pk-media-is-secure"></span><?php endif ?>
	</h3>
</li>

<li class="pk-media-item-description"><?php echo $mediaItem->getDescription() ?></li>
<li class="pk-media-item-dimensions pk-media-item-meta"><span>Original Dimensions:</span> <?php echo $mediaItem->getHeight(); ?>x<?php echo $mediaItem->getWidth(); ?></li>
<li class="pk-media-item-createdat pk-media-item-meta"><span>Uploaded:</span> <?php echo pkDate::pretty($mediaItem->getCreatedAt()) ?></li>
<li class="pk-media-item-credit pk-media-item-meta"><span>Credit:</span> <?php echo htmlspecialchars($mediaItem->getCredit()) ?></li>
<li class="pk-media-item-tags pk-media-item-meta"><span>Tags:</span> <?php include_partial('pkMedia/showTags', array('tags' => $mediaItem->getTags())) ?></li>
<?php if ($mediaItem->getType() === 'pdf'): ?>
  <li class="pk-media-item-link pk-media-item-meta">
		<span>URL:</span>
		<input type="text" id="pk-media-item-link-value-<?php echo $id ?>" name="pk-media-item-link-value" value="<?php echo url_for("pkMedia/original?".http_build_query(array("slug" => $mediaItem->getSlug(),"format" => $mediaItem->getFormat())), true) ?>">
	</li>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#pk-media-item-link-value-<?php echo $id ?>').focus(function(){
				$(this).select();
			})
		});
		
	</script>
<?php endif ?>
  