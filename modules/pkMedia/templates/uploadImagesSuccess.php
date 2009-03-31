<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media pk-media-iframe<?php end_slot() ?>


<h3>Upload Images</h3>

<?php echo $form->renderGlobalErrors() ?>

<form method="POST" 
  action="<?php echo url_for("pkMedia/uploadImages") ?>" 
  enctype="multipart/form-data"
  id="pk-media-upload-form">
<?php // I use this in js code, don't kill it please, style it if you want ?>
<div id="pk-media-upload-form-subforms">
	<?php for ($i = 0; ($i < pkMediaTools::getOption('batch_max')); $i++): ?>
	  <?php // What we're passing here is actually a widget schema ?>
	  <?php // (they get nested when embedded forms are present), but ?>
	  <?php // it supports the same methods as a form for rendering purposes ?>
	  <?php include_partial('pkMedia/uploadImage',
	    array("form" => $form["item-$i"], "first" => ($i == 0))) ?>
	<?php endfor ?>
</div>
<a href="#" id="pk-media-add-photo" class="pk-btn add">Add Another Photo<span></span></a>
<div class="pk-media-upload-form-footer">
<?php echo link_to_function("Upload Photos<span></span>", "$('#pk-media-upload-form').submit()", array("class"=>"pk-btn")) ?>
<span class="or"> or </span>
<?php echo link_to_function("cancel", "window.parent.pkMediaUploadClose()", array("class"=>"pk-cancel")) ?>
</div>
</form>
<?php // Elements get moved here by jQuery when they are not in use. ?>
<?php // This form is never submitted so file upload elements that are ?>
<?php // in it are never uploaded. ?>
<form style="display: none" action="#" enctype="multipart/form-data" id="pk-media-upload-form-inactive">
</form>
<script>
$(function() {
  <?php // Why don't I just do this once? Because I have to re-bind handlers ?>
  <?php // to elements when I remove them and then re-add them elsewhere ?>
  <?php // in the document. ?>
  function pkMediaUploadSetRemoveHandler(element)
  {
    $(element).find('.pk-remove').click(
      function()
      {
        // Move the entire row to the inactive form
        var element = $($(this).parent()).remove();
        $('#pk-media-upload-form-inactive').append(element);
        $('#pk-media-add-photo').show();
        pkMediaUploadResize();
        return false;
      }
    );
  }
  // Move the first inactive element back to the active form
  $('#pk-media-add-photo').click(
    function()
    {
      var elements = $('#pk-media-upload-form-inactive .form-row');
      if (elements.length > 0)
      {
        $('#pk-media-upload-form-subforms').append($(elements[0]).remove());
        pkMediaUploadSetRemoveHandler(elements[0]);
      }
      // If that was the last one hide the add button for now
      if (elements.length == 1)
      {
        $('#pk-media-add-photo').hide();
      }
      pkMediaUploadResize();
    }
  );
  // Move all the initially inactive elements to the inactive form
  function pkMediaUploadInitialize()
  {
    $('#pk-media-upload-form-inactive').append(
      $('#pk-media-upload-form-subforms .form-row.initially-inactive').remove());
    pkMediaUploadSetRemoveHandler($('#pk-media-upload-form-subforms'));
    pkMediaUploadResize();
  }
  pkMediaUploadInitialize();
});

function pkMediaUploadResize()
{
  var height = $(document).height();
  pkMediaUploadGetIframe().height(height);
}

function pkMediaUploadGetIframe()
{
  return window.parent.$('#pk-media-upload-iframe');
}
</script>
