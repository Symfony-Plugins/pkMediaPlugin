<div class="pk-media-select">
<?php $type = pkMediaTools::getAttribute('type') ?>
<?php if (!$type): ?>
<?php $type = "media item" ?>
<?php endif ?>
	<p>Select one or more <?php echo $type ?>s by clicking on them. You can remove and reorder <?php echo $type ?>s using the controls on the right. Drag and drop <?php echo $type ?>s to reorder them within the list of selected items. 
  <?php if ($limitSizes): ?>
  Only appropriately sized <?php echo $type ?>s are shown.
  <?php endif ?>
  When you're done, click "Save."</p>

	<ul id="pk-media-selection-list">
	<?php include_component("pkMedia", "multipleList") ?>
	</ul>

	<?php echo jq_sortable_element("#pk-media-selection-list", array("url" => "pkMedia/multipleOrder")) ?>

	<br class="c"/>

	<ul class="pk-controls pk-media-slideshow-controls">
		<li><?php echo link_to("Save", "pkMedia/selected", array("class"=>"pk-btn save")) ?></li>
 	  <li><?php echo link_to("cancel", "pkMedia/selectCancel", array("class"=>"pk-btn icon pk-cancel event-default")) ?></li>
	</ul>
	
</div>
	<br class="c"/>