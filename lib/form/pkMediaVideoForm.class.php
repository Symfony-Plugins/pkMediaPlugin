<?php

class pkMediaVideoForm extends pkMediaItemForm
{
  public function configure()
  {
    unset($this['id'], $this['type'], $this['slug'], $this['width'], $this['height'], $this['format']);
    $this->setValidator('service_url',
      new sfValidatorUrl(
        array('required' => true, 'trim' => true),
        array('required' => "Not a valid YouTube URL")));
  }
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->type = 'video';
    return $object;
  }
}
