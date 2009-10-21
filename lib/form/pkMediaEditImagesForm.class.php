<?php

class pkMediaEditImagesForm extends sfForm
{
  private $active = array();
  
  public function __construct($active)
  {
    $this->active = array_flip($active);
    parent::__construct();
  }
  
  public function configure()
  {
    for ($i = 0; ($i < pkMediaTools::getOption('batch_max')); $i++)
    {
      if (isset($this->active[$i]))
      {
        $this->embedForm("item-$i", new pkMediaImageForm());
      }
    }
    
    $this->widgetSchema->setNameFormat('pk_media_items[%s]'); 
  }
}
