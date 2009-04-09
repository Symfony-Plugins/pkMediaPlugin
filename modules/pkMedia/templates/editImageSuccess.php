<?php use_helper('jQuery') ?>
<?php slot('body_class') ?>pk-media<?php end_slot() ?>
<?php include_partial('pkMedia/editImage', 
  array('item' => $item, 'firstPass' => false, 'form' => $form)) ?>
