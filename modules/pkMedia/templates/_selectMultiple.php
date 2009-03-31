<div class="pk-media-select">
	<p>Select one or more media items by clicking on them. You can remove and reorder items using the controls on the right. Drag and drop items to reorder them within the list of selected items. When you're done, click "Save."</p>

	<ul id="pk-media-selection-list">
	<?php include_component("pkMedia", "multipleList") ?>
	</ul>

	<?php echo jq_sortable_element("#pk-media-selection-list", array("url" => "pkMedia/multipleOrder")) ?>

	<br class="c"/>

	<?php echo link_to("Save<span></span>", "pkMedia/selected", array("class"=>"pk-btn")) ?>
	
	<span class="or">or</span> <?php echo link_to("cancel", "pkMedia/selectCancel", array("class"=>"cancel")) ?>
</div>

