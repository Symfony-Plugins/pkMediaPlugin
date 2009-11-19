<?php

class pkMediaVideoSearchForm extends sfForm
{
  public function configure()
  {
    $this->setWidget('q', new sfWidgetFormInput());
    $this->setValidator('q', new sfValidatorString(array('required' => true)));
    $this->widgetSchema->setNameFormat('videoSearch[%s]');
    $this->widgetSchema->setFormFormatterName('pkAdmin');  
    
  }
}
