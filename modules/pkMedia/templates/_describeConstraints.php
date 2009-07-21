<?php // Yes, this is template code, but we use regular PHP syntax because we are building a sentence and the introduction of ?>
<?php // newlines wrecks the punctuation. ?>
<?php 
$clauses = array();
if (pkMediaTools::getAttribute('aspect-width') && pkMediaTools::getAttribute('aspect-height'))
{
  $clauses[] = "a " . pkMediaTools::getAttribute('aspect-width') . 'x' . pkMediaTools::getAttribute('aspect-height') . " aspect ratio";
}
if (pkMediaTools::getAttribute('minimum-width'))
{
  $clauses[] = "a minimum width of " . pkMediaTools::getAttribute('minimum-width') . " pixels";
}
if (pkMediaTools::getAttribute('minimum-height'))
{
  $clauses[] = "a minimum height of " . pkMediaTools::getAttribute('minimum-height') . " pixels";
}
if (pkMediaTools::getAttribute('width'))
{
  $clauses[] = "a width of exactly " . pkMediaTools::getAttribute('width') . " pixels";
}
if (pkMediaTools::getAttribute('height'))
{
  $clauses[] = "a height of exactly " . pkMediaTools::getAttribute('height') . " pixels";
}
if (pkMediaTools::getAttribute('type'))
{
  $type = pkMediaTools::getAttribute('type') . "s";
} 
else
{
  $type = "items";
}
if (count($clauses))
{
  echo("<h3>Displaying only $type with ");
  if (count($clauses) > 1)
  {
    for ($i = 0; ($i < count($clauses) - 1); $i++)
    {
      if ($i > 0)
      {
        echo(", ");
      }
      echo($clauses[$i]);
    }
    echo(" and " . $clauses[count($clauses) - 1]);
  }
  else
  {
    echo($clauses[0]);
  }
  echo(".</h3>\n");
}
