<?php

class pkMediaSearchForm extends sfForm
{
  public function configure()
  {
    $this->setWidget('search', new sfWidgetFormInputText(array(), array('id' => 'pk-media-search', 'class' => 'pk-search-field')));
  }
}
