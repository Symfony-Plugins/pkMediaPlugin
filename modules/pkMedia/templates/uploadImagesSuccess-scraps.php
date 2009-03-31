<?php use_helper('jQuery') ?>
<form method="POST" 
  action="<?php echo url_for("pk/uploadImages") ?>" 
  enctype="application/octet-stream"
  id="pk-files-form">
<?php for ($i = 0; ($i < 6); $i++): ?>
<input type="file" name="pk-file-<?php echo $i?>" />

<input type="hidden" name="file-count" id="pk-file-count" value="0" />
<ul id="pk-files">
</ul>
<a href="#" id="pk-add-file">Add Another</a>
<script>
var pkFileCount = 0;
var pkFileActiveCount = 0;
function pkAddFile()
{
  var id = 'pk-file-' + pkFileCount;
  var item = $("<li><input type='file' /><a href='#'>Remove</a></li>");
  $(item).attr('id', id);
  var input = $(item).find('input');
  input.attr('name', id);
  var a = $(item).find('a');
  a.click(
    function() 
    {
      $('#' + id).remove();     
      pkFileActiveCount--;
      $('#pk-add-file').show();
      return false;
    }
  );
  $('#pk-files').append(item);
  pkFileCount++;
  pkFileActiveCount++;
  if (pkFileActiveCount == 6)
  {
    $('#pk-add-file').hide();
  }
  $('#pk-file-count').val(pkFileCount);
}
$('#pk-add-file').click(function() { pkAddFile(); return false; });
pkAddFile();
</script>
<?php echo link_to_function("Upload Photos", "$('#pk-files-form').submit()") ?>
<?php echo link_to_function("Cancel", "$('#pk-files-form').hide()") ?>
</form>
