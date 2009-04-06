<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media pk-media-iframe<?php end_slot() ?>
<form method="POST" id="pk-media-video-search-form" action="<?php echo url_for("pkMedia/videoSearch") ?>">
<p>
Searching YouTube is the easiest way to add video.
</p>
<div class="form-row q">
<label for="videosearch_q">Search</label><?php echo $form['q']->render() ?>
<?php echo link_to_function("Go<span></span>", "$('#pk-media-video-search-form').submit()", array("class" => "pk-btn")) ?> 
</div>
<br class="clear" />
</form>
<script>
var pkMediaVideoSearchResults = null;
</script>
<?php if ($results !== false): ?>
  <?php if (!count($results)): ?>
    <p>No matching videos were found. Try being less specific.</p>
  <?php else: ?> 
    <p id="pk-media-search-loading">Loading videos...</p>
    <script>
    $(window).load(function() { 
      $('#pk-media-search-loading').hide(); 
      $('.pk-media-search-select').show(); 
    });
    </script>
    <ul id="pk-media-video-search-results">
    </ul>
    <br class="clear" />
    <div id="pk-media-video-search-pagination" class="pk_pager_navigation">
    </div>
    <br class="clear" />
    <script>
    var pkMediaVideoSearchResults = <?php echo json_encode($results) ?>;
    var pkMediaVideoSearchPage = 1;
    </script>
  <?php endif ?>
<?php endif ?>
<script>
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
      pkMediaVideoSearchResize();
      window.parent.pkMediaVideoSelected($(this).data('videoInfo'));
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

function pkMediaVideoSearchResize()
{
  // Why does document.body work better here and document work better elsewhere?
  window.parent.pkMediaVideoSearchResizeIframe($(document.body).height());
}

$(function() {
  pkMediaVideoSearchResize();
});

pkMediaVideoSearchRenderResults();

</script>
