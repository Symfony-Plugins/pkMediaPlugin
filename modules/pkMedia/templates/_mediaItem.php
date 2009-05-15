<div class="pk-media-item-content" id="pk-media-item-content-<?php echo $mediaItem->getId() ?>">

  <?php $type = $mediaItem->getType() ?>
  <?php $id = $mediaItem->getId() ?>
  <?php $serviceUrl = $mediaItem->getServiceUrl() ?>
  <?php $slug = $mediaItem->getSlug() ?>
  <?php $width = pkMediaTools::getOption("gallery_width") ?>
  <?php $height = pkMediaTools::getOption("gallery_height") ?>
  <?php // Don't let anything render smaller than actual size on either axis ?>
  <?php if ($mediaItem->getWidth() < $width): ?>
    <?php $width = $mediaItem->getWidth() ?>
    <?php if ($height !== false): ?>
      <?php $height = $width * pkMediaTools::getOption("gallery_height") / pkMediaTools("gallery_width") ?>
    <?php endif ?>
  <?php endif ?>
  <?php if ($mediaItem->getHeight() < $height): ?>
    <?php $height = $mediaItem->getHeight() ?>
    <?php $width = $height * pkMediaTools::getOption("gallery_width") / pkMediaTools("gallery_height") ?>
  <?php endif ?>
  <?php if ($height === false): ?>
    <?php $height = ceil(($width * $mediaItem->getHeight()) / $mediaItem->getWidth()) ?>
  <?php endif ?>
  <?php $resizeType = pkMediaTools::getOption("gallery_resizeType") ?>
  <?php $format = $mediaItem->getFormat() ?>
  <?php if (pkMediaTools::isSelecting()): ?>
    <?php if (pkMediaTools::isMultiple()): ?>
      <?php $linkAttributes = 'href = "#" onClick="' . 
        jq_remote_function(
          array("update" => "pk-media-selection-list", 
            "url" => "pkMedia/multipleAdd?id=$id")) . '; return false;"' ?>
    <?php else: ?>
      <?php $linkAttributes = 'href = "' . url_for("pkMedia/selected?id=$id") . '"' ?>
    <?php endif ?>
  <?php else: ?>
    <?php $linkAttributes = 'href = "' . url_for("pkMedia/show?" . http_build_query(array("slug" => $slug))) . '"' ?>
  <?php endif ?>
		<h3><a <?php echo $linkAttributes ?>><?php echo htmlspecialchars($mediaItem->getTitle()) ?></a><?php if ($mediaItem->getViewIsSecure()): ?><span class="pk-media-is-secure"></span><?php endif ?></h3>
  	<?php include_partial('pkMedia/editLinks', array('mediaItem' => $mediaItem)) ?> 

	<div class="pk-media-item-thumbnail" id="pk-media-item-thumbnail-<?php echo $mediaItem->getId() ?>">
    <a <?php echo $linkAttributes ?> class="pk-media-thumb-link">
      <?php if ($type == 'video'): ?>
        <span class="pk-media-play-btn"></span>
      <?php endif ?>
      <img src="<?php echo url_for("pkMedia/image?" . http_build_query(array("slug" => $slug, "width" => $width, "height" => $height, "resizeType" => $resizeType, "format" => $format))) ?>" />
    </a>
	</div>
	
  <?php // Stored as HTML ?>
  <div class="pk-media-description"><?php echo $mediaItem->getDescription() ?></div>
  <div class="pk-media-createdat pk-media-meta"><span>Uploaded:</span> <?php echo pkDate::pretty($mediaItem->getCreatedAt()) ?></div>
  <div class="pk-media-credit pk-media-meta"><span>Credit:</span> <?php echo htmlspecialchars($mediaItem->getCredit()) ?></div>
  <div class="pk-media-tags pk-media-meta"><span>Tags:</span> <?php include_partial('pkMedia/showTags', array('tags' => $mediaItem->getTags())) ?></div>
</div>
