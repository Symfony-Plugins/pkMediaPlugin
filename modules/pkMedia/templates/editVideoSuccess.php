<?php // If $item is set we are editing an existing item in an iframe. ?> 
<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>
<?php if (!$item): ?>
	<?php slot('body_class') ?>pk-media<?php end_slot() ?>
  <?php include_component('pkMedia', 'breadcrumb', array()) ?>
  <?php include_component('pkMedia', 'browser') ?>
<div class="main">
  <div class="content-container">
    <div class="content">

        <div class="pk-admin-controls shadow caution">
          <div class="pk-admin-controls-padding caution-padding">
            <h3>Add Video</h3>
  					<iframe id="pk-media-edit-video-iframe" width="700" height="100" border="0" frameborder="0" src="<?php echo url_for('pkMedia/videoSearch') ?>"></iframe>
          </div>
        </div>

<?php endif ?>


<?php if ($item): ?>
<?php $slug = $item->getSlug() ?>
<?php else: ?>
<?php $slug = false ?>
<?php endif ?>
<?php // Post-form-validation error when we tried to get the thumbnail ?>
<?php if (isset($serviceError)): ?>
<h3>That is not a valid YouTube video URL.</h3>
<?php endif ?>
<form method="POST" id="pk-media-edit-form" enctype="multipart/form-data" 
  action="<?php echo url_for(pkUrl::addParams("pkMedia/editVideo",
    array("slug" => $slug)))?>">
  <div class="form-row title">
  	<?php echo $form['title']->renderRow(array("id" => "pk-media-video-title")) ?>
  </div>
  <div class="form-row service-url">
  	<?php echo $form['service_url']->renderRow(array("id" => "pk-media-video-url")) ?>
  </div>
	<div class="form-row description">
		<?php echo $form['description']->renderLabel() ?>
		<?php echo $form['description']->renderError() ?>
		<?php echo $form['description']->render() ?>
	</div>
  <div class="form-row credit">
  	<?php echo $form['credit']->renderRow() ?>
  </div>
  <div class="form-row permissions">
  	<?php echo $form['view_is_secure']->renderRow() ?>
  </div>
  <div class="form-row tags">
  	<?php echo $form['tags']->renderRow(array("id" => "pk-media-video-tags")) ?>
 	</div>
<div class="pk-media-edit-footer">
  <input type="submit" value="Save" class="submit" />
  <span class="or">or</span>
  <?php if ($item): ?>
  <?php $id = $item->getId() ?>
  <?php echo link_to_function("cancel", "window.parent.$('#pk-media-item-content-$id').show(); window.parent.$('#pk-media-iframe-container-$id').html('')", array("class"=>"cancel")) ?>
  <?php else: ?>
  <?php echo link_to("cancel", "pkMedia/resume", array("class"=>"cancel")) ?>
  <?php endif ?>
  <?php if ($item): ?>
    <?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
      array("slug" => $slug)),
      array("confirm" => "Are you sure you want to delete this item?",
        "target" => "_top", "class"=>"pk-btn delete")) ?>
  <?php endif ?>
</div>
</form>
<?php if (!$item): ?>
    </div>
  </div>
</div>
<?php endif ?>

<script type="text/javascript">

pkRadioSelect('#pk_media_item_view_is_secure', { });

function pkMediaVideoSearchResizeIframe(height)
{
  $('#pk-media-edit-video-iframe')[0].height = height;
  if (window.parent)
  {
    // Resize grandpa too
    var id = <?php echo isset($id) ? $id : 'false' ?>;
    if (id)
    {
      id = 'pk-media-edit-iframe-' + id;
    }
    else
    {
      id = 'pk-media-upload-iframe';
    }
    if (window.parent)
    {
      window.parent.$('#' + id).height($(document).height());
    }
  }
}
function pkMediaVideoSelected(result)
{
  $('#pk-media-video-title').val(result.title);
  $('#pk-media-video-tags').val(result.tags);
  $('#pk-media-video-url').val("http://www.youtube.com/watch?v=" + result.id);
}
</script>
	