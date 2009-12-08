<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<div id="pk-media-plugin">

<?php include_component('pkMedia', 'browser') ?>

<div class="pk-media-toolbar">
  <h3>Add Video</h3>
</div>

<div class="pk-media-library">				

 	<ul class="pk-controls" id="pk-media-video-buttons">
		<li><?php echo link_to_function("Search YouTube", 
	  		"$('#pk-media-video-search-form').show(); 
		 		 $('#pk-media-video-buttons').hide(); 
		 		 $('#pk-media-video-search-heading').show();", 
		 		 array("class" => "pk-btn")) ?></li>
      
		<li><?php echo link_to_function("Add by YouTube URL", 
	      "$('#pk-media-video-add-by-url-form').show(); 
			   $('#pk-media-video-buttons').hide(); 
			 	 $('#pk-media-video-add-by-url-heading').show();", 
		 		 array("class" => "pk-btn")) ?></li>

		<?php if (pkMediaTools::getOption('embed_codes')): ?>
	  <li><?php echo link_to_function("Add by Embed Code", 
	      "$('#pk-media-video-add-by-embed-form').show(); 
			 	 $('#pk-media-video-buttons').hide(); 
			 	 $('#pk-media-video-add-by-embed-heading').show();", 
			 	 array("class" => "pk-btn")) ?>
		</li>
	  <?php endif ?>

	  <li><?php echo link_to("Cancel", "pkMedia/resumeWithPage", array("class" => "pk-cancel pk-btn icon event-default")) ?></li>
	</ul>

	<h4 id="pk-media-video-search-heading" class="pk-media-video-heading">Search YouTube</h4>     

    <?php echo jq_form_remote_tag(
			array(
        'url' => 'pkMedia/videoSearch',
        'update' => 'pk-media-video-search-form',
				'before' => '$("#pk-media-video-search-form .pk-search-field").append("<span class=\"pk-spinner\"></span>");'), 
      array(
        'id' => 'pk-media-video-search-form', 
				'class' => 'pk-media-search-form', )) ?>

    				
				<?php if (0) {
					# form tag has a height of 20px. this is messing up the height causing the footer to crash into the results.
					# Need to rework the input background or the markup to allow this stuff to work properly
				} ?>
    	<?php include_partial('pkMedia/videoSearch', array('form' => $videoSearchForm, 'results' => false)) ?>
    </form>

 		<h4 id="pk-media-video-add-by-url-heading" class="pk-media-video-heading">Add by URL</h4>   

    <form id="pk-media-video-add-by-url-form" class="pk-media-search-form" method="POST" action="<?php echo url_for("pkMedia/editVideo") ?>">

			<div class="form-row pk-search-field" style="position:relative">
        <label for="pk-media-video-url"></label>
        <input type="text" id="pk-media-video-url" class="pk-search-video pk-search-form" name="pk_media_item[service_url]" value="" />
			</div>

			<div class="form-row example">
        <p>Example: http://www.youtube.com/watch?v=EwTZ2xpQwpA</p>
        <input type="hidden" name="first_pass" value="1" /> 
			</div>

			<ul class="pk-controls pk-media-upload-form-footer" id="pk-media-video-add-by-url-form-submit">
        <li><input type="submit" value="Go" class="pk-submit" /></li>
        <li><?php echo link_to_function("Cancel", "$('#pk-media-video-add-by-url-form').hide(); $('#pk-media-video-add-by-url-heading').hide(); $('#pk-media-video-buttons').show();", array("class" => "pk-cancel pk-btn icon event-default")) ?></li>
      </ul>
		
     </form>
		
		<?php if (pkMediaTools::getOption('embed_codes')): ?>
			<h4 id="pk-media-video-add-by-embed-heading" class="pk-media-video-heading">Add by Embed Code</h4>
			
			<form id="pk-media-video-add-by-embed-form" class="pk-media-search-form" method="POST" action="<?php echo url_for("pkMedia/editVideo") ?>">

			<div class="form-row pk-search-field" style="position:relative">
        <label for="pk-media-video-embed"></label>
        <input type="text" id="pk-media-video-embed" class="pk-search-video pk-search-form" name="pk_media_item[embed]" value="" />
			</div>

			<div class="form-row example">
        <p>Example: <?php echo htmlspecialchars('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="437" height="291" ...</object>') ?></p>
        <input type="hidden" name="first_pass" value="1" /> 
			</div>
			

			<ul class="pk-controls pk-media-upload-form-footer" id="pk-media-video-add-by-embed-form-submit">
        <li><input type="submit" value="Go" class="pk-submit" /></li>
        <li>
					<?php echo link_to_function("Cancel", 
					"$('#pk-media-video-add-by-embed-form').hide(); 
					 $('#pk-media-video-add-by-embed-heading').hide(); 
					 $('#pk-media-video-buttons').show();", 
					 array("class" => "pk-cancel pk-btn icon event-default")) ?>
				</li>
      </ul>
			
     </form>
     <?php endif ?>

			<div id="pk-media-video-search-results-container">I want search results displayed here</div>
</div>

</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
			pkInputSelfLabel('#videoSearch_q', <?php echo json_encode(isset($search) ? $search : 'Search') ?>);
			pkInputSelfLabel('#pk-media-video-url', <?php echo json_encode(isset($search) ? $search : 'http://') ?>);
			pkInputSelfLabel('#pk-media-video-embed', <?php echo json_encode(isset($search) ? $search : '<object>...</object>') ?>);			
	});
	
</script>