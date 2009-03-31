<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>
<?php include_partial('pkMedia/editImage', 
  array('item' => $item, 'firstPass' => false, 'form' => $form)) ?>
<script>
<?php // document must be ready ?>
$(function()
{
  <?php // Why does $(document) work best here while $(document.body) works best elsewhere? ?>
  <?php // TODO: find out. $(document).height() returns 0 here. ?>
  window.parent.pkResizeIframe(<?php echo $item->getId() ?>, $(document).height());
});
</script>
