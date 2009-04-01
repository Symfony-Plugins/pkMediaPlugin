<?php

class pkMediaImageForm extends pkMediaItemForm
{
  public function configure()
  {
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
          // Not yet
          // "iframe" => true,
          // "progress" => "Uploading...",
          "image-preview" => array("width" => pkMediaTools::getOption("gallery_width"), 'height' => pkMediaTools::getOption("gallery_height"), "resizeType" => "c"))));
    $this->setValidator('file', new pkValidatorFilePersistent(
      array("mime_types" => array("image/jpeg", "image/png", "image/gif"), 
        "required" => (!$this->getObject()->getId())),
      array("mime_types" => "JPEG, PNG and GIF only.",
        "required" => "Select a JPEG, PNG or GIF file")));
    $this->setValidator('title', 
      new sfValidatorString(
        array("min_length" => 3, "max_length" => 200, "required" => true),
        array("min_length" => "The title must be at least three characters long.",
          "max_length" => "The title must be 200 characters or less.",
          "required" => "You must provide a title for your image.")));
    $this->widgetSchema->setLabel("view_is_secure", "Login required");
    $this->widgetSchema->setNameFormat('pk_media_item[%s]');
  }
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->type = 'image';
    return $object;
  }
}
