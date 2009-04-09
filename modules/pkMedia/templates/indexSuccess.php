	<?php slot('body_class') ?>pk-media<?php end_slot() ?>

<?php use_helper('jQuery') ?>
<?php include_component('pkMedia', 'breadcrumb') ?>

<?php include_component('pkMedia', 'browser') ?>


<div class="main">
	<div class="content-container">
		<div class="content">
			
			<?php if (pkMediaTools::isSelecting() || pkMediaTools::userHasUploadPrivilege()): ?>
				<div class="pk-admin-controls shadow caution">
					<div class="pk-admin-controls-padding caution-padding">
						<?php if (pkMediaTools::isSelecting()): ?>
						  <?php if (pkMediaTools::isMultiple()): ?>
						    <?php include_partial('pkMedia/selectMultiple') ?>
						  <?php else: ?>
						    <?php include_partial('pkMedia/selectSingle') ?>
						  <?php endif ?>
						<?php endif ?>
	          <?php if (pkMediaTools::userHasUploadPrivilege()): ?>
	            <a href="<?php echo url_for("pkMedia/uploadImages") ?>" class="pk-btn add">Add Images<span></span></a>
	            <a href="<?php echo url_for("pkMedia/newVideo") ?>" class="pk-btn add">Add Video<span></span></a>
	          <?php endif ?>
					</div>
				</div>

			<?php endif ?>
			
			<div class="pk-media-container">
        <?php for ($n = 0; ($n < count($results)); $n += 2): ?>
          <div class="pk-media-row">
          	<?php for ($i = $n; ($i < min(count($results), $n + 2)); $i++): ?>
            <?php $mediaItem = $results[$i] ?>
	            <div id="pk-media-item-<?php echo $mediaItem->getId() ?>" class="pk-media-item <?php echo ($i % 2) ? "odd" : "even" ?>">
	              <?php include_partial('pkMedia/mediaItem', array('mediaItem' => $mediaItem)) ?>
	            </div>
          	<?php endfor ?>
          </div>
        <?php endfor ?>
			</div>

			<div class="pk-media-footer">
        <?php include_partial('pkPager/pager', array('pager' => $pager, 'pagerUrl' => $pagerUrl)) ?>
			</div>
		
		</div>
	</div>
</div>
