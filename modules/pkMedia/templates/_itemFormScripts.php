<script src='/sfDoctrineActAsTaggablePlugin/js/pkTagahead.js'></script>
<script type='text/javascript'>
	pkRadioSelect('#pk_media_item_view_is_secure', { });
	pkTagahead(<?php echo json_encode(url_for("taggableComplete/complete")) ?>);
</script>
