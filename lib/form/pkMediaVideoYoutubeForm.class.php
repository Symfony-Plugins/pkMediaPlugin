<?php

class pkMediaVideoYoutubeForm extends pkMediaVideoForm
{
  public function configure()
  {
    parent::configure();
    unset($this['embed']);
    $this->setValidator('service_url',
      new sfValidatorUrl(
        array('required' => true, 'trim' => true),
        array('required' => "Not a valid YouTube URL")));
  }
}
