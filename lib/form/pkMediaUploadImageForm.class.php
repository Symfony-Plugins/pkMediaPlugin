<?php

class pkMediaUploadImageForm extends sfForm
{
  public function configure()
  {
    $this->setWidget("file", new pkWidgetFormInputFilePersistent(
      array(
        // Not yet
        // "iframe" => true, "progress" => "Uploading...", 
        "image-preview" => array("width" => 50, "height" => 50, "resizeType" => "c"))));
    $this->setValidator("file", new pkValidatorFilePersistent(
      array("mime_types" => array("image/jpeg", "image/png", "image/gif"),
        "required" => false),
      array("mime_types" => "Only JPEG, PNG and GIF-format images are accepted.")));
      
    // Without this, the radio buttons on the edit form will not have a default
    $this->setWidget("view_is_secure", new sfWidgetFormInputHidden(array('default' => '0')));
    $this->setValidator("view_is_secure", new sfValidatorPass(array('required' => false)));
    $this->setDefault('view_is_secure', 0);
    // The same as the edit form by design
    $this->widgetSchema->setNameFormat('pk_media_item[%s]');
    $this->widgetSchema->setFormFormatterName('pkAdmin');
    
  }
}
