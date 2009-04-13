<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>
<?php include_component('pkMedia', 'breadcrumb', array()) ?>
<?php include_component('pkMedia', 'browser') ?>
<div class="main">
  <div class="content-container">
    <div class="content">

      <div class="pk-admin-controls shadow caution">
        <div class="pk-admin-controls-padding caution-padding">
          <h3>
            Add Video
          </h3>
          <div id="pk-media-video-buttons">
            <?php echo link_to_function("Search YouTube<span></span>", 
              "$('#pk-media-video-search-form').show(); $('#pk-media-video-buttons').hide(); $('#pk-media-video-search-heading').show();", array("class" => "pk-btn")) ?> 
            <?php echo link_to_function("Add by URL<span></span>", 
              "$('#pk-media-video-add-by-url-form').show(); $('#pk-media-video-buttons').hide(); $('#pk-media-video-add-by-url-heading').show();", array("class" => "pk-btn")) ?> 
						<span class="or">or</span>
            <?php echo link_to("Cancel<span></span>", 
              "pkMedia/resumeWithPage",
              array("class" => "pk-cancel")) ?>
          </div>
          <h4 id="pk-media-video-search-heading">Search YouTube</h3>          
          <h4 id="pk-media-video-add-by-url-heading">Add by URL</h3>          
	
			      <?php echo jq_form_remote_tag(array(
			          'url' => 'pkMedia/videoSearch',
			          'update' => 'pk-media-video-search-form'),
			        array(
			          'id' => 'pk-media-video-search-form', 'class' => 'pk-search-form', )) ?>
			      <?php include_partial('pkMedia/videoSearch', array('form' => $videoSearchForm, 'results' => false)) ?>
			      </form>

			      <form id="pk-media-video-add-by-url-form" method="POST" action="<?php echo url_for("pkMedia/editVideo") ?>">

							<div class="form-row example">
				        <p>Example: http://www.youtube.com/watch?v=EwTZ2xpQwpA</p>
				        <input type="hidden" name="first_pass" value="1" /> 
							</div>
							
							<div class="form-row" style="position:relative">
				        <label for="pk-media-video-url">Service URL</label>
				        <input type="text" id="pk-media-video-url" name="pk_media_item[service_url]" value="" />
				
								<div id="pk-media-video-add-by-url-form-submit">
					        <input type="submit" value="Go" class="submit" />
									<span class="or">or</span>
					        <?php echo link_to_function("Cancel<span></span>", "$('#pk-media-video-add-by-url-form').hide(); $('#pk-media-video-add-by-url-heading').hide(); $('#pk-media-video-buttons').show();", array("class" => "pk-cancel")) ?>
								</div>
				
							</div>
							
			      </form>
        </div>
      </div>


			<div id="pk-media-video-search-results-container">I want search results displayed here</div>

    </div>  
  </div>
</div>

