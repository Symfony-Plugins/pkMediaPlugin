<div id ="subnav" class="subnav shadow">
	<div class="content-container">
		<div class="content">
			<h3>Find in Media</h3>
			<form method="POST" action="<?php echo url_for("pkMedia/index") ?>" class="pk-search-form media" id="pk-search-form-sidebar">

				<div class="form-row">
				<span class="pk-search-field"><?php echo $form['search']->render() ?></span>
			  <span class="<?php echo(strlen($form->getValue('search')) ? 'pk-search-remove' : '') ?> pk-search-submit"><input width="29" type="image" height="20" title="Click to Search" alt="Search" src="/pkContextCMSPlugin/images/pk-special-blank.gif" value="Submit" class="pk-search-submit"/></span>
				</div>

				<br class="c"/>
			
			<div class="pk-media-filters">
        <h3>Media Types</h3>
        <?php echo $form['type']->render(array("id" => "pk-media-type")) ?>

				<div class="pk-tag-sidebar">
        <h3>Media Tags</h3>
				<?php echo $form['tag']->render(array("id" => "pk-media-tag", "style" => "display: none")) ?>
				</div>
				
			</div>
 			</form>
			
		</div>
	</div>
</div>

<script type="text/javascript">

pkRadioSelect('#pk-media-type', { 'autoSubmit': true });

pkSelectToList('#pk-media-tag', 
  { 
    tags: true,
    currentTemplate: '<ul class="pk-tag-sidebar-selected-tags"><li class="selected"><span class="pk-tag-sidebar-tag">_LABEL_</span> <a href="#" class="pk-btn icon close">remove</a></li></ul>',
    popularLabel: '<h4 class="pk-tag-sidebar-title popular">Popular Tags</h4>',
    popular: <?php echo pkMediaTools::getOption('popular_tags') ?>,
    alpha: true,
    // If this contains an 'a' tag it gets turned into a toggle 
		listPopularClass: 'pk-tag-sidebar-list popular',
		listAllClass: 'pk-tag-sidebar-list all-tags',
    allLabel: '<br class="c"/><h4 class="pk-tag-sidebar-title all-tags">All Tags</h4>',
    itemTemplate: "<span class='pk-tag-sidebar-tag'>_LABEL_</span> <span class='pk-tag-sidebar-tag-count'>_COUNT_</span>",
    allVisible: true,
    all: true
  });
</script>

<script type="text/javascript">
	$('.pk-tag-sidebar-title.all-tags').click(function(){
		$('.pk-tag-sidebar-list.all-tags').toggle();
		$(this).toggleClass('open');
	});
	
	$('.pk-tag-sidebar-title.all-tags').hover(function(){
		$(this).toggleClass('over');
	},
	function(){
		$(this).toggleClass('over');		
	});
</script>

<script type="text/javascript">
$('.subnav input.pk-search-field').attr('value', 'Search'); // This should be done at the lib/form/helper level, not here.
	
$('.subnav input.pk-search-field').focus(function(){
	if ($(this).attr('value') == 'Search') {
		$(this).attr('value' , '');
	}
});

$('.subnav input.pk-search-field').blur(function(){
	if ($(this).attr('value') == '') {
		$(this).attr('value' , 'Search');
	}
});
</script>
