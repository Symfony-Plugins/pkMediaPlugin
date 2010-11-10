<?php // For backwards compatibility reasons it is best to implement these as before and after partials ?>
<?php // rather than a wrapper partial. If we use a wrapper that passes on each variable individually to an inner partial, ?>
<?php // it will break as new variables are added. If we had used a single $params array as the only variable ?>
<?php // in the first place, we could have avoided this, but we didn't, so let's be backwards compatible with all ?>
<?php // of the existing overrides of _browser in our sites and those of others. ?>

<?php include_partial('pkMedia/browserBefore') ?>

<?php use_helper('Url') ?>

<div id="pk-subnav" class="pk-media-subnav subnav">

  <h3>Find in Media</h3>

  <form method="post" action="<?php echo url_for(pkUrl::addParams($current, array("search" => false))) ?>" class="pk-search-form media" id="pk-search-form-sidebar">
    <?php echo isset($search) ? link_to('Clear Search', pkUrl::addParams($current, array('search' => '')), array('id' => 'pk-media-search-remove', 'title' => 'Clear Search', )) : '' ?>
    <?php echo $searchForm['search']->render() ?>
    <input width="29" type="image" height="20" title="Click to Search" alt="Search" src="/pkContextCMSPlugin/images/pk-special-blank.gif" value="Submit" class="pk-search-submit submit" id="pk-media-search-submit" />
  </form>

	<div class="pk-media-filters">
  	<h3>Media Types</h3>
	  <ul class="pk-media-filter-options">
			<?php $type = isset($type) ? $type : '' ?>
			<li class="pk-media-filter-option">
				<?php echo link_to('Image', pkUrl::addParams($current, array('type' => ($type == 'image') ? '' : 'image')), array('class' => ($type=='image') ? 'selected' : '', )) ?>
			</li>
			<li class="pk-media-filter-option">
				<?php echo link_to('Video', pkUrl::addParams($current, array('type' => ($type == 'video') ? '' : 'video')), array('class' => ($type=='video') ? 'selected' : '', )) ?>				
			</li>
			<li class="pk-media-filter-option">
				<?php echo link_to('PDF', pkUrl::addParams($current, array('type' => ($type == 'pdf') ? '' : 'pdf')), array('class' => ($type=='pdf') ? 'selected' : '', )) ?>
			</li>
	  </ul>

		<div class="pk-tag-sidebar">

		 <?php if (isset($selectedTag)): ?>
				<h4 class="pk-tag-sidebar-title selected-tag">Selected Tag</h4>  
	    	<ul class="pk-tag-sidebar-selected-tags">
	        <li class="selected">
						<?php echo link_to(htmlspecialchars($selectedTag), pkUrl::addParams($current, array("tag" => false)), array('class' => 'selected',)) ?>
	        </li>
	    	</ul>
      <?php endif ?>
    	
			<h3 class="pk-tag-sidebar-title popular">Popular Tags</h3>
    	<ul class="pk-tag-sidebar-list popular">
      	<?php foreach ($popularTags as $tag => $count): ?>
	        <li><a href="<?php echo url_for(pkUrl::addParams($current, array("tag" => $tag))) ?>"><span class="pk-tag-sidebar-tag"><?php echo htmlspecialchars($tag) ?></span> <span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span></a></li>
	      <?php endforeach ?>
    	</ul>

    	<h3 class="pk-tag-sidebar-title all-tags">All Tags</h3>
	    <ul class="pk-tag-sidebar-list all-tags">
	      <?php foreach ($allTags as $tag => $count): ?>
	        <li><a href="<?php echo url_for(pkUrl::addParams($current, array("tag" => $tag))) ?>"><span class="pk-tag-sidebar-tag"><?php echo htmlspecialchars($tag) ?></span> <span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span></a></li>
	      <?php endforeach ?>
	    </ul>
  	</div>

 	</div>
</div>
   
<script type="text/javascript" charset="utf-8">

	pkInputSelfLabel('#pk-media-search', <?php echo json_encode(isset($search) ? $search : 'Search') ?>);

  <?php if (isset($search)): ?>
    $('#pk-media-search-remove').show();
    $('#pk-media-search-submit').hide();
    var search = <?php echo json_encode($search) ?>;
    $('#pk-media-search').bind("keyup blur", function(e) 
    {
      if ($(this).val() === search)
      {
        $('#pk-media-search-remove').show();
        $('#pk-media-search-submit').hide();
      }
      else
      {
        $('#pk-media-search-remove').hide();
        $('#pk-media-search-submit').show();
      }
    });

    $('#pk-media-search').bind('pkInputSelfLabelClear', function(e) {
      $('#pk-media-search-remove').show();
      $('#pk-media-search-submit').hide();
    });
  <?php endif ?>
  
	var allTags = $('.pk-tag-sidebar-title.all-tags');

	allTags.hover(function(){
		allTags.addClass('over');
	},function(){
		allTags.removeClass('over');		
	});
	
	allTags.click(function(){
		allTags.toggleClass('open');
		allTags.next().toggle();
	})
	
</script>

<?php include_partial('pkMedia/browserAfter') ?>
