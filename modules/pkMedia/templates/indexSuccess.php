<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>

<div id="pk-media-plugin">

<?php include_component('pkMedia', 'browser') ?>

<?php if (pkMediaTools::isSelecting() || pkMediaTools::userHasUploadPrivilege()): ?>
<div class="pk-media-toolbar">
	<?php if (pkMediaTools::isSelecting()): ?>

    <?php if (isset($label)): ?>
      <h3><?php echo htmlspecialchars($label) ?> or <?php echo link_to("cancel", "pkMedia/selectCancel", array("class"=>"pk-cancel event-default")) ?></h3>
    <?php endif ?>

    <?php include_partial('pkMedia/describeConstraints') ?>

	  <?php if (pkMediaTools::isMultiple()): ?>
	    <?php include_partial('pkMedia/selectMultiple', array('limitSizes' => $limitSizes)) ?>
	  <?php else: ?>
	    <?php include_partial('pkMedia/selectSingle', array('limitSizes' => $limitSizes)) ?>
	  <?php endif ?>

	<?php endif ?>

  <?php if (pkMediaTools::userHasUploadPrivilege()): ?>

   <ul class="pk-controls pk-media-controls">
     <?php $selecting = pkMediaTools::isSelecting() ?>
     <?php $type = pkMediaTools::getAttribute('type') ?>

     <?php if (!($selecting && $type && ($type !== 'image'))): ?>
     <li><a href="<?php echo url_for("pkMedia/uploadImages") ?>" class="pk-btn icon pk-add">Add Images</a></li>
     <?php endif ?>

     <?php if (!($selecting && $type && ($type !== 'video'))): ?>
     <li><a href="<?php echo url_for("pkMedia/newVideo") ?>" class="pk-btn icon pk-add">Add Video</a></li>
     <?php endif ?>

     <?php if (!($selecting && $type && ($type !== 'pdf'))): ?>
     <li><a href="<?php echo url_for("pkMedia/editPdf") ?>" class="pk-btn icon pk-add">Add PDF</a></li>
     <?php endif ?>

   </ul>

  <?php endif ?>
</div>

<?php endif ?>

<div class="pk-media-library">
 <?php for ($n = 0; ($n < count($results)); $n += 2): ?>
   <div class="pk-media-row">
   	<?php for ($i = $n; ($i < min(count($results), $n + 2)); $i++): ?>
     <?php $mediaItem = $results[$i] ?>
      <ul id="pk-media-item-<?php echo $mediaItem->getId() ?>" class="pk-media-item <?php echo ($i % 2) ? "odd" : "even" ?>">
        <?php include_partial('pkMedia/mediaItem', array('mediaItem' => $mediaItem)) ?>
      </ul>
   	<?php endfor ?>
   </div>
 <?php endfor ?>
</div>

<div class="pk-media-footer">
 <?php include_partial('pkPager/pager', array('pager' => $pager, 'pagerUrl' => $pagerUrl)) ?>
</div>
</div>