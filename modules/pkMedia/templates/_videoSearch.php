<?php use_helper('jQuery') ?>
<div class="form-row q" style="width:100%">
	<?php echo $form['q']->render() ?>
</div>

<ul class="pk-controls">
  <li><input type="submit" value="Go" class="pk-submit" /></li>
	<li>
		<?php echo link_to_function("Cancel", 
			"$('#pk-media-video-search-form').hide(); 
			 $('#pk-media-video-search-results-container').hide(); 
			 $('#pk-media-video-search-heading').hide(); 
			 $('#pk-media-video-buttons').show();", 
			array("class" => "pk-cancel pk-btn icon event-default")) ?>
	</li>
</ul>

</form>

<script type="text/javascript">
var pkMediaVideoSearchResults = null;
</script>

<?php if ($results !== false): ?>
  <?php if (!count($results)): ?>
    <p>No matching videos were found. Try being less specific.</p>
  <?php else: ?>

    <ul id="pk-media-video-search-results"></ul>
    <br class="clear" />

    <div id="pk-media-video-search-pagination" class="pk_pager_navigation"></div>
    <br class="clear" />

		<script type="text/javascript">
		  var pkMediaVideoSearchResults = <?php echo json_encode($results) ?>;
		  var pkMediaVideoSearchPage = 1;
		</script>

  <?php endif ?>
<?php endif ?>

<script type="text/javascript">
function pkMediaVideoSearchRenderResults()
{
  if (!pkMediaVideoSearchResults)
  {
    return;
  }
  var perPage = <?php echo pkMediaTools::getOption('video_search_per_page') ?>;
  var start = (pkMediaVideoSearchPage - 1) * perPage;
  var template = <?php echo json_encode(pkYoutube::embed('_ID_', pkMediaTools::getOption('video_search_preview_width'), pkMediaTools::getOption('video_search_preview_height'))) ?>;
  var i;
  var limit = start + perPage;
  var total = pkMediaVideoSearchResults.length;
  var pages = Math.ceil(total / perPage);
  if (limit > total)
  {
    limit = total;
  }
  $('#pk-media-video-search-results').html('');
  for (i = start; (i < limit); i++)
  {
		li_class = "normal";

		if (i%3 == 2)
		{
			li_class = "right-side";
		}
    var result = pkMediaVideoSearchResults[i];
    var id = result.id;
    var embed = template.replace(/_ID_/g, id);
    var li = $("<li class='"+li_class+" video-"+i+"'><a href='#' class='pk-media-search-select pk-btn'>Select<span></span></a><br class='clear c'/>" + embed + "</li>");
    var a = li.find('a:first');
    a.data('videoInfo', result);
    a.click(function() {
      $('#pk-media-video-search-results').hide();
      $('#pk-media-video-search-pagination').hide();
      pkMediaVideoSelected($(this).data('videoInfo'));
    });
    $('#pk-media-video-search-results').append(li);
  }
  if (pages > 1)
  {
    $('#pk-media-video-search-pagination').html('');
    if (pages == 0)
    {
      pages = 1;
    }
    for (i = 1; (i <= pages); i++)
    {
      var item;
      if (i === pkMediaVideoSearchPage)
      {
        item = $('<span class="pk_page_navigation_number pk_pager_navigation_disabled">' + i + '</span>');
      }
      else
      {
        item = $('<span class="pk_page_navigation_number"><a href="#">' + i + '</a></span>');
      }  
      item.data('page', i);
      item.click(function() { 
        pkMediaVideoSearchPage = $(this).data('page');
        pkMediaVideoSearchRenderResults(); 
      });
      $('#pk-media-video-search-pagination').append(item);
    }
  }
}

pkMediaVideoSearchRenderResults();

function pkMediaVideoSelected(videoInfo)
{
  document.location = <?php echo json_encode(url_for("pkMedia/editVideo")) ?> + "?first_pass=1&pk_media_item[title]=" + escape(videoInfo['title']) + "&pk_media_item[service_url]=http://www.youtube.com/watch?v=" + escape(videoInfo['id']);
}

pkUI();

$(document).ready(function(){
	$('#videoSearch_q').css({
		'float':'left',
		'width':'auto',
	})
});
</script>
