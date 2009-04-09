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
            <?php if ($item): ?>
              Edit Video
            <?php else: ?>
              Add Video
            <?php endif ?>
          </h3>
        </div>
      </div>
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
          <?php echo $form['title']->renderLabel() ?>
          <?php if (!$sf_params->get('first_pass')): ?>
            <?php echo $form['title']->renderError() ?>
          <?php endif ?>
          <?php echo $form['title']->render() ?>
        </div>
        <div class="form-row service-url">
          <?php echo $form['service_url']->renderRow() ?>
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
        <div class="form-row about-tags">
        Tags should be separated by commas. Example: student life, chemistry, laboratory
        </div>
        <div class="form-row tags">
          <?php echo $form['tags']->renderRow(array("id" => "pk-media-video-tags")) ?>
        </div>
        <div class="pk-media-edit-footer">
          <input type="submit" value="Save" class="submit" />
          <span class="or">or</span>
          <?php echo link_to("cancel", "pkMedia/resumeWithPage", array("class"=>"cancel")) ?>
          <?php if ($item): ?>
            <?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
              array("slug" => $slug)),
              array("confirm" => "Are you sure you want to delete this item?",
                "target" => "_top", "class"=>"pk-btn delete")) ?>
          <?php endif ?>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include_partial('pkMedia/itemFormScripts') ?>
