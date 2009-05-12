<?php

class pkMediaVideoForm extends pkMediaItemForm
{
  public function configure()
  {
    unset($this['id'], $this['type'], $this['slug'], $this['width'], $this['height'], $this['format']);
    $object = $this->getObject();
//    if ($object->embed)
//    {
//      unset($this['service_url']);
//      $this->setValidator('embed',
//        new sfValidatorText(
//          array('required' => true, 'trim' => true),
//          array('required' => "Not a valid embed code")));
//    }
//    else
//    {
//      unset($this['embed']);
      $this->setValidator('service_url',
        new sfValidatorUrl(
          array('required' => true, 'trim' => true),
          array('required' => "Not a valid YouTube URL")));
//    }
  }
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->type = 'video';
    return $object;
  }
}
