<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<?php include_component('pkMedia', 'breadcrumb') ?>

<?php include_component('pkMedia', 'browser') ?>

<div class="main">
	<div class="content-container">
		<div class="content">
			
      <div class="pk-admin-controls shadow caution">
        <div class="pk-admin-controls-padding caution-padding">
          <h3>Upload Images</h3>
        </div>
      </div>

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
        <?php echo link_to("cancel", "pkMedia/resumeWithPage", array("class"=>"pk-cancel")) ?>
        </div>
      </form>
      <?php // Elements get moved here by jQuery when they are not in use. ?>
      <?php // This form is never submitted so file upload elements that are ?>
      <?php // in it are never uploaded. ?>
      <form style="display: none" action="#" enctype="multipart/form-data" id="pk-media-upload-form-inactive">
      </form>
    </div>
  </div>
</div>
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
        var element = $(elements[0]).remove()[0];
        // Only really necessary the first time
        element.style.visibility = 'visible';
        $('#pk-media-upload-form-subforms').append(element);
        pkMediaUploadSetRemoveHandler(element);
      }
      // If that was the last one hide the add button for now
      if (elements.length == 1)
      {
        $('#pk-media-add-photo').hide();
      }
      return false;
    }
  );
  // Move all the initially inactive elements to the inactive form
  function pkMediaUploadInitialize()
  {
    $('#pk-media-upload-form-inactive').append(
      $('#pk-media-upload-form-subforms .form-row.initially-inactive').remove());
    pkMediaUploadSetRemoveHandler($('#pk-media-upload-form-subforms'));
  }
  pkMediaUploadInitialize();
});

</script>
