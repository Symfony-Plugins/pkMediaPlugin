<?php $type = $mediaItem->getType() ?>
<?php $id = $mediaItem->getId() ?>
<?php $serviceUrl = $mediaItem->getServiceUrl() ?>
<?php $slug = $mediaItem->getSlug() ?>
<?php $width = pkMediaTools::getOption("gallery_width") ?>
<?php $height = pkMediaTools::getOption("gallery_height") ?>
<?php $resizeType = pkMediaTools::getOption("gallery_resizeType") ?>
<?php $format = $mediaItem->getFormat() ?>

<?php if ($height === false): ?>
  <?php $height = ceil(($width * $mediaItem->getHeight()) / $mediaItem->getWidth()) ?>
<?php endif ?>
<?php if (($width > $mediaItem->width) || ($height > $mediaItem->height)): ?>
  <?php $width = $mediaItem->width ?>
  <?php $height = $mediaItem->height ?>
<?php endif ?>


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
    <img src="<?php echo url_for("pkMedia/image?" . http_build_query(array("slug" => $slug, "width" => $width, "height" => $height, "resizeType" => $resizeType, "format" => $format))) ?>" />
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
<li class="pk-media-item-createdat pk-media-item-meta"><span>Uploaded:</span> <?php echo pkDate::pretty($mediaItem->getCreatedAt()) ?></li>
<li class="pk-media-item-credit pk-media-item-meta"><span>Credit:</span> <?php echo htmlspecialchars($mediaItem->getCredit()) ?></li>
<li class="pk-media-item-tags pk-media-item-meta"><span>Tags:</span> <?php include_partial('pkMedia/showTags', array('tags' => $mediaItem->getTags())) ?></li>