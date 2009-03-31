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
    // The same as the edit form by design
    $this->widgetSchema->setNameFormat('pk_media_item[%s]');
  }
}
