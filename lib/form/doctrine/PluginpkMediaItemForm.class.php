<?php

/**
 * PluginpkMediaItem form.
 *
 * @package    form
 * @subpackage pkMediaItem
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginpkMediaItemForm extends BasepkMediaItemForm
{
  public function setup()
  {
    parent::setup();
    unset($this['shows_list']);
    unset($this['pk_media_item_list']);
    unset($this['pk_media_show_list']);
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['owner_id']);
    $this->setWidget('tags', new sfWidgetFormInput(array("default" => implode(", ", $this->getObject()->getTags()))));
    $this->setValidator('tags', new sfValidatorPass());
		$this->setWidget('view_is_secure', new sfWidgetFormSelect(array('choices' => array('1' => 'Login Required', '' => 'Public'))));
    $this->setWidget('description', new sfWidgetFormRichTextarea(array('editor' => 'fck', 'tool' => 'Media', )));
		$this->setValidator('view_is_secure', new sfValidatorChoice(array('required' => false, 'choices' => array('1', ''))));
  }
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->setDescription(
      pkHtml::simplify(
        $this->getValue('description'), "<p><br><b><i><strong><em><ul><li><ol><a>"));
    $object->setTags($this->getValue('tags'));
    $object->setOwnerId(
      sfContext::getInstance()->getUser()->getGuardUser()->getId());
    return $object;
  }
}
