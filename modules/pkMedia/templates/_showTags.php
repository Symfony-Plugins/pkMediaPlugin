<?php $links = array() ?>
<?php foreach ($tags as $tag): ?>
  <?php $links[] = link_to($tag, "pkMedia/index?" . http_build_query(array("tag" => $tag))) ?>
<?php endforeach ?>
<?php echo implode(", ", $links) ?>
