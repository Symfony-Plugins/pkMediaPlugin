<?php use_helper('Form') ?>

<div id="pk-subnav" class="pk-media-subnav subnav">

  <h3>Find in Media</h3>

  <form method="POST" action="<?php echo url_for(pkUrl::addParams($current, array("search" => false))) ?>" class="pk-search-form media" id="pk-search-form-sidebar">
		<?php echo input_tag('search', isset($search) ? $search : '', array('id' => 'pk-media-search', 'class' => 'pk-search-field')) ?>
    <input width="29" type="image" height="20" title="Click to Search" alt="Search" src="/pkContextCMSPlugin/images/pk-special-blank.gif" value="Submit" class="pk-search-submit submit"/>
  </form>

	<div class="pk-media-filters">
  	<h3>Media Types</h3>
	  <ul class="pk-radio-select-container">
			<li class="pk-media-filter-option">
	    <?php if (isset($type)): ?>
	      <a id="pk-media-filter-option-0" class="option-0 first" href="<?php echo url_for(pkUrl::addParams($current, array('type' => false))) ?>">All</a>
	    <?php else: ?>
	      <span class="pk-radio-option-selected option-0 first">All</span>
	    <?php endif ?>
			</li>
			<li class="pk-media-filter-option">
	    <?php if (!(isset($type) && ($type === 'image'))): ?>
	      <a id="pk-media-filter-option-1" class="option-1" href="<?php echo url_for(pkUrl::addParams($current, array('type' => 'image'))) ?>">Image</a>
	    <?php else: ?>
	      <span class="pk-radio-option-selected option-1">Image</span>
	    <?php endif ?>
			</li>
			<li class="pk-media-filter-option">
	    <?php if (!(isset($type) && ($type === 'video'))): ?>
	      <a id="pk-media-filter-option-2" class="option-2 last" href="<?php echo url_for(pkUrl::addParams($current, array('type' => 'video'))) ?>">Video</a>
	    <?php else: ?>
	      <span class="pk-radio-option-selected option-2 last">Video</span>
	    <?php endif ?>
			</li>
	  </ul>

		<div class="pk-tag-sidebar">
    	<ul class="pk-tag-sidebar-selected-tags">
	      <?php if (isset($selectedTag)): ?>
	        <li class="selected">
	          <span class="pk-tag-sidebar-tag"><?php echo htmlspecialchars($selectedTag) ?></span> <a class="pk-btn icon close" href="<?php echo url_for(pkUrl::addParams($current, array("tag" => false))) ?>">remove</a>
	        </li>
	      <?php endif ?>
	    </ul>
    	
			<h4 class="pk-tag-sidebar-title popular">Popular Tags</h4>
    	<ul class="pk-tag-sidebar-list popular">
      	<?php foreach ($popularTags as $tag => $count): ?>
	        <li><a href="<?php echo url_for(pkUrl::addParams($current, array("tag" => $tag))) ?>"><span class="pk-tag-sidebar-tag"><?php echo htmlspecialchars($tag) ?></span> <span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span></a></li>
	      <?php endforeach ?>
    	</ul>

    	<h4 class="pk-tag-sidebar-title all-tags">All Tags</h4>
	    <ul class="pk-tag-sidebar-list all-tags">
	      <?php foreach ($allTags as $tag => $count): ?>
	        <li><a href="<?php echo url_for(pkUrl::addParams($current, array("tag" => $tag))) ?>"><span class="pk-tag-sidebar-tag"><?php echo htmlspecialchars($tag) ?></span> <span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span></a></li>
	      <?php endforeach ?>
	    </ul>
  	</div>

 	</div>
</div>
   
<script type="text/javascript" charset="utf-8">
	pkInputSelfLabel('#pk-media-search', 'Search');

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