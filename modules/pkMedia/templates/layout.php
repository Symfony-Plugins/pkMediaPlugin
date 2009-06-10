<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php // Non-CMS pages, such as search results and the media plugin, ?>
<?php // can safely include the same navigational elements and can ?>
<?php // also include global slots. ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<?php use_helper('pkContextCMS') ?>
	<?php $page = pkContextCMSTools::getCurrentPage() ?>

<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
	<link rel="shortcut icon" href="/favicon.ico" />
		
</head>

<body class="<?php if (has_slot('body_class')): ?><?php include_slot('body_class') ?><?php endif ?>">

	<div id="pk-wrapper">
		<?php // Demo requires an obvious way to test login ?>
		<div id="login">
	  	<?php include_partial("pkContextCMS/login") ?>
		</div>

    <div id="header">
      <?php pk_context_cms_slot("logo", 'pkContextCMSImage', array("global" => true, "width" => 125, "height" => 200, "resizeType" => "s", "link" => "/")) ?>
  		<?php pk_context_cms_slot('header', 'pkContextCMSRichText', array("global" => true)) ?>
    </div>

		<?php include_component('pkContextCMS', 'tabs') # Top Level Navigation ?>

		<?php echo $sf_data->getRaw('sf_content') ?>

	  <?php pk_context_cms_slot('footer', 'pkContextCMSRichText', array("global" => true)) ?>

	</div>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#pk-area-logo .pkContextCMSImage a').prepend('<div id="pk-area-logo-overlay" class="slot-overlay"></div>')
			$('.slot-overlay').fadeTo(0,.6);
			$('#pk-area-logo .pkContextCMSImage a').hover(function(){
				$(this).children('.slot-overlay').css('display','block');
			},function(){
				$(this).children('.slot-overlay').css('display','none');				
			});
		});
		
	</script>

</body>
</html>
