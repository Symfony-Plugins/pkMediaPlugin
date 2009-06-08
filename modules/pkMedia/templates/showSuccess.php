<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<div id="pk-media-plugin">
	
<?php include_component('pkMedia', 'browser') ?>

<div class="pk-media-library">
	
<?php $id = $mediaItem->getId() ?>
<?php $slug = $mediaItem->getSlug() ?>
<?php $width = pkMediaTools::getOption("gallery_width") ?>
<?php $height = pkMediaTools::getOption("gallery_height") ?>
<?php $resizeType = pkMediaTools::getOption("gallery_resizeType") ?>
<?php $format = $mediaItem->getFormat() ?>
<?php $embedCode = $mediaItem->getEmbedCode($width, $height, $resizeType, $format) ?>

<ul class="pk-media-item-content" id="pk-media-item-content-<?php echo $mediaItem->getId()?>">

	<li class="pk-media-item-source">
		<?php include_partial('pkMedia/editLinks', array('mediaItem' => $mediaItem)) ?>

		<?php if ($mediaItem->getType() === 'image'): ?>
    	<?php echo $embedCode // media object src tag ?>
    <?php else: ?>
    	<?php echo $embedCode // Why is there an if here, why was this commented out? ?>
    <?php endif ?>
	</li>

  <?php // Stored as HTML ?>
	<li class="pk-media-item-title"><h3><?php echo htmlspecialchars($mediaItem->getTitle()) ?></h3></li>
  <li class="pk-media-description"><?php echo $mediaItem->getDescription() ?></li>
  <li class="pk-media-createdat pk-media-meta"><span>Uploaded:</span> <?php echo pkDate::pretty($mediaItem->getCreatedAt()) ?></li>
  <li class="pk-media-credit pk-media-meta"><span>Credit:</span> <?php echo htmlspecialchars($mediaItem->getCredit()) ?></li>
  <li class="pk-media-tags pk-media-meta"><span>Tags:</span> <?php include_partial('pkMedia/showTags', array('tags' => $mediaItem->getTags())) ?></li>

</ul>

<script type="text/javascript">
function pkMediaItemRefresh(id)
{
  <?php // We're updating essentially the whole page, it's not worth building ?>
  <?php // a custom ajax action for it. Also we can ignore the id passed to this ?>
  <?php // function which will always be the one this page was generated for. ?>
  window.location = <?php echo json_encode(url_for("pkMedia/show?slug=" . $mediaItem->getSlug())) ?>;
}
</script>

</div>

</div>