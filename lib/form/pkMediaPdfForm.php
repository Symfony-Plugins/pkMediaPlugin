<?php

class pkMediaPdfForm extends pkMediaItemForm
{
  public function configure()
  {
    unset($this['id']);
    unset($this['type']);
    unset($this['service_url']);
    unset($this['slug']);
    unset($this['width']);
    unset($this['height']);
    unset($this['format']);
    if ($this->getObject())
    {
      $id = $this->getObject()->getId();
    }
    else
    {
      $id = false;
    }
    $this->setWidget('file', 
      new pkWidgetFormInputFilePersistent(
        array(
          // "image-preview" => pkMediaTools::getOption('gallery_constraints')
          )));
    $this->setValidator('file', new pkValidatorFilePersistent(
      array("mime_types" => array("application/pdf", "application/x-pdf"),
        "required" => (!$this->getObject()->getId())),
      array("mime_types" => "PDF only.",
        "required" => "Select a PDF file")));
    // These have to be brief to work with Rick's styles
    $this->setValidator('title', 
      new sfValidatorString(
        array("min_length" => 3, "max_length" => 200, "required" => true),
        array("min_length" => "Title must be at least 3 characters.",
          "max_length" => "Title must be <200 characters.",
          "required" => "You must provide a title.")));

		$this->setWidget('view_is_secure', new sfWidgetFormChoice(
			array(
				'expanded' => true,
			  'choices' => array(
				0 => "Public",
				1 => "Hidden"
				),
				'default' => 0
				)));
	
  	$this->setValidator('view_is_secure', new sfValidatorBoolean());

    $this->widgetSchema->setLabel("view_is_secure", "Permissions");
    $this->widgetSchema->setNameFormat('pk_media_item[%s]');
    $this->widgetSchema->setFormFormatterName('pkAdmin');
    
  }
  
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->type = 'pdf';
    return $object;
  }
}