<?php

class pkMediaVideoForm extends pkMediaItemForm
{
  public function configure()
  {
    unset($this['id'], $this['type'], $this['slug'], $this['width'], $this['height'], $this['format']);
    $this->setValidator('service_url',
      new sfValidatorUrl(
        array('required' => true, 'trim' => true),
        array('required' => "You must provide the URL of this video on the video hosting service (YouTube). Hint: try the YouTube search feature.")));
  }
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->type = 'video';
    return $object;
  }
}
