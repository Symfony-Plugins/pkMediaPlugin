<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>

			<?php include_component('pkMedia', 'breadcrumb', array("item" => $mediaItem)) ?>
			<?php include_component('pkMedia', 'browser') ?>
			
<div class="main">
  <?php if ($mediaItem->userHasPrivilege('edit')): ?>
    <?php $id = "pk-media-iframe-container-" . $mediaItem->getId() ?>
    <div id="<?php echo $id ?>" class="pk-media-item-edit-form"></div>
  <?php endif ?>
  <?php // The edit iframe looks for this one ?>
  <div class="pk-media-item-content" id="pk-media-item-content-<?php echo $mediaItem->getId()?>">
    <div class="content-container">
      <div class="content">
        <?php include_partial('pkMedia/editLinks', array('mediaItem' => $mediaItem)) ?>
        <?php $id = $mediaItem->getId() ?>
        <?php $slug = $mediaItem->getSlug() ?>
        <h3><?php echo htmlspecialchars($mediaItem->getTitle()) ?></h3>
        <?php $width = pkMediaTools::getOption("gallery_width") ?>
        <?php $height = pkMediaTools::getOption("gallery_height") ?>
        <?php $resizeType = pkMediaTools::getOption("gallery_resizeType") ?>
        <?php $format = $mediaItem->getFormat() ?>
        <?php $embedCode = $mediaItem->getEmbedCode(
          $width, $height, $resizeType, $format) ?>
        <?php if ($mediaItem->getType() === 'image'): ?>
          <?php // media object src tag ?>
          <?php echo $embedCode ?>
          <?php else: ?>
            <?php // Why is there an if here, why was this commented out? ?>
            <?php echo $embedCode ?>
          <?php endif ?>
          <?php // Stored as HTML ?>
          <div class="pk-media-description"><?php echo $mediaItem->getDescription() ?></div>
          <div class="pk-media-createdat pk-media-meta"><span>Uploaded:</span> <?php echo pkDate::pretty($mediaItem->getCreatedAt()) ?></div>
          <div class="pk-media-credit pk-media-meta"><span>Credit:</span> <?php echo htmlspecialchars($mediaItem->getCredit()) ?></p>
          <div class="pk-media-tags pk-media-meta"><span>Tags:</span> <?php include_partial('pkMedia/showTags', array('tags' => $mediaItem->getTags())) ?>
          </div>

          <?php if ($mediaItem->getType() !== 'video'): ?>
            <?php // download link ?>
            <?php echo link_to(
              "Download Original<span></span>",
              "pkMedia/original?" .
                http_build_query(
                  array(
                    "slug" => $mediaItem->getSlug(),
                    "format" => $mediaItem->getFormat())), 
                    array("class"=>"pk-btn download")) ?>
          <?php endif ?>
      </div>
    </div>
	</div>
</div>


<script>
function pkMediaItemRefresh(id)
{
  <?php // We're updating essentially the whole page, it's not worth building ?>
  <?php // a custom ajax action for it. Also we can ignore the id passed to this ?>
  <?php // function which will always be the one this page was generated for. ?>
  window.location = <?php echo json_encode(url_for("pkMedia/show?slug=" . $mediaItem->getSlug())) ?>;
}
</script>
