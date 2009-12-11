<?php

class pkMediaVideoSearchForm extends sfForm
{
  public function configure()
  {
    $this->setWidget('q', new sfWidgetFormInput(array(),array('class'=>'pk-search-video pk-search-form')));
    $this->setValidator('q', new sfValidatorString(array('required' => true)));
    $this->widgetSchema->setNameFormat('videoSearch[%s]');
    $this->widgetSchema->setFormFormatterName('pkAdmin');  
    $this->widgetSchema->setLabel('q', ' ');
  }
}
