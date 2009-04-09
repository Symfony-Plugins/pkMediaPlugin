<?php $type = pkMediaTools::getAttribute('type') ?>
<?php if (!$type): ?>
<?php $type = "media item" ?>
<?php endif ?>
<div class="pk-media-select">
  <p>Use the browsing and searching features to locate the <?php echo $type ?> you want, then click on that <?php echo $type ?> to select it.
  <?php if ($limitSizes): ?>
  Only appropriately sized <?php echo $type ?>s are shown.
  <?php endif ?>
  </p>
  <p>
    <?php echo link_to("cancel", "pkMedia/selectCancel", array("class"=>"cancel")) ?>
  </p>
</div>
