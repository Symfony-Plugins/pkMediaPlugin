<script src='/sfDoctrineActAsTaggablePlugin/js/pkTagahead.js'></script>
<script type='text/javascript'>
	pkTagahead(<?php echo json_encode(url_for("taggableComplete/complete")) ?>);
 	pkRadioSelect('#pk_media_item_view_is_secure', { }); //This is for single editing
</script>
