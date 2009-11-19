<?php

class pkMediaBrowseForm extends sfForm
{
  public function configure()
  {
    $typeOptions = array(
      '' => 'All',
      'image' => 'Image',
      'video' => 'Video',
      'pdf' => 'PDF'
    );
    
    $allTags = TagTable::getAllTagNameWithCount(null, array('model' => 'pkMediaItem'));

    $tagOptions = array();
    foreach ($allTags as $tag => $count)
    {
      $tagOptions[$tag] = "$tag ($count)";
    }
    
    $tagOptions = array_merge(array('' => 'All'), $tagOptions);
    
    $this->setWidgets(array(
      'search' => new sfWidgetFormInput(array(), array('class'=>'pk-search-field',)),
      'type'   => new sfWidgetFormSelect(array('choices' => $typeOptions)),
      'tag'    => new sfWidgetFormSelect(array('choices' => $tagOptions))
    ));
    
    $this->setValidators(array(
      'search' => new sfValidatorPass(array('required' => false)),
      'type'   => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($typeOptions))),
      'tag'    => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($tagOptions)))
    ));
    
    // This is safe - it doesn't actually retrieve any extra
    // fields, it just declines to generate an error merely because
    // they exist
    $this->validatorSchema->setOptions('allow_extra_fields', true);
    $this->widgetSchema->setIdFormat('pk_media_browser_%s');
    $this->widgetSchema->setFormFormatterName('pkAdmin');

    // Yes, really: this makes it contextual without extra effort
    $this->widgetSchema->setNameFormat('%s');
  }
}
