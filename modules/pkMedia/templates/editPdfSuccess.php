<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<div id="pk-media-plugin">

<?php include_component('pkMedia', 'browser') ?>

<div class="pk-media-toolbar">
  <h3>
		<?php if ($item): ?> 
			Editing PDF: <?php echo $item->getTitle() ?>
    <?php else: ?> 
			Add PDF 
		<?php endif ?>
   </h3>
</div>

<div class="pk-media-library">				

  <?php if ($item): ?>
  	<?php $slug = $item->getSlug() ?>
  <?php else: ?>
  	<?php $slug = false ?>
  <?php endif ?>

  <?php // Post-form-validation error when we tried to get the thumbnail ?>
  <?php if (isset($serviceError)): ?>
  <h3>That is not a valid PDF.</h3>
  <?php endif ?>

  <form method="post" id="pk-media-edit-form" enctype="multipart/form-data" action="<?php echo url_for(pkUrl::addParams("pkMedia/editPdf", array("slug" => $slug)))?>">

    <div class="form-row file">
      <?php echo $form['file']->renderLabel() ?>
      <?php echo $form['file']->renderError() ?>
      <?php echo $form['file']->render() ?>
    </div>

    <div class="form-row title">
      <?php echo $form['title']->renderLabel() ?>
      <?php echo $form['title']->renderError() ?>
      <?php echo $form['title']->render() ?>
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
      <?php echo $form['tags']->renderRow(array("id" => "pk-media-pdf-tags")) ?>
    </div>

    <ul class="pk-controls pk-media-edit-footer">
      <li><input type="submit" value="Save" class="pk-submit" /></li>
      <?php if ($item): ?>
      <li><?php echo link_to("Delete", "pkMedia/delete?" . http_build_query(
          array("slug" => $slug)),
          array("confirm" => "Are you sure you want to delete this item?",
            "target" => "_top", "class"=>"pk-btn icon pk-delete")) ?></li>
      <?php endif ?>
			<li><?php echo link_to("Cancel", "pkMedia/resumeWithPage", array("class"=>"pk-cancel pk-btn icon event-default")) ?></li>
    </ul>
  </form>
</div>

<?php include_partial('pkMedia/itemFormScripts') ?>

</div>