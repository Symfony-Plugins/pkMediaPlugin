<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInputFileEditable represents an upload HTML input tag with the possibility
 * to remove a previously uploaded file.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputFileEditable.class.php 11544 2008-09-14 17:40:07Z fabien $
 */
class sfWidgetFormInputFileEditable extends sfWidgetFormInputFile
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * file_src:     The current image web source path (required)
   *  * edit_mode:    A Boolean: true to enabled edit mode, false otherwise
   *  * is_image:     Whether the file is a displayable image
   *  * with_delete:  Whether to add a delete checkbox or not
   *  * delete_label: The delete label used by the template
   *  * template:     The HTML template to use to render this widget
   *                  The available placeholders are:
   *                    * input (the image upload widget)
   *                    * delete (the delete checkbox)
   *                    * delete_label (the delete label text)
   *                    * file (the file tag)
   *
   * In edit mode, this widget renders an additional widget named after the
   * file upload widget with a "_delete" suffix. So, when creating a form,
   * don't forget to add a validator for this additional field.
   *
   * tom@punkave.com: an additional hidden field widget with a "_sticky" 
   * suffix is added. You must also add a validator to pass this field and
   * use sfValidateFileSticky to validate the file field.
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormInputFile
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('type', 'file');
    $this->setOption('needs_multipart', true);

    $this->addRequiredOption('file_src');
    $this->addOption('is_image', false);
    $this->addOption('edit_mode', true);
    $this->addOption('with_delete', true);
    $this->addOption('delete_label', 'remove the current file');
    $this->addOption('template', '%file%<br />%input%<br />%delete% %delete_label%');
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $input = parent::render($name, $value, $attributes, $errors);

    if (!$this->getOption('edit_mode'))
    {
      return $input;
    }

    if ($this->getOption('with_delete'))
    {
      $deleteName = ']' == substr($name, -1) ? substr($name, 0, -1).'_delete]' : $name.'_delete';

      $delete = $this->renderTag('input', array_merge(array('type' => 'checkbox', 'name' => $deleteName), $attributes));
      $deleteLabel = $this->renderContentTag('label', $this->getOption('delete_label'), array_merge(array('for' => $this->generateId($deleteName))));
    }
    else
    {
      $delete = '';
      $deleteLabel = '';
    }
    $request = sfContext::getInstance()->getRequest();
    $stickyName = ']' == substr($name, -1) ? substr($name, 0, -1).'_sticky]' : $name.'_sticky';
    $stickyValue = trim($request->getParameter($stickyName));
    if (!preg_match("/^[0-9a-fA-F]+$/", $stickyValue))
    {
      $stickyValue =  
    $sticky = $this->renderTag('input', array('type' => 'hidden', 'name' => $stickyName, 'value' => $stickyValue));
    return strtr($this->getOption('template'), array('%input%' => $input, '%delete%' => $delete, '%delete_label%' => $deleteLabel, '%file%' => $this->getFileAsTag($attributes), '%sticky%' => $sticky));
  }

  static private function createGuid()
  {
    $guid = "";
    // This was 16 before, which produced a string twice as
    // long as desired. I could change the schema instead
    // to accommodate a validation code twice as big, but
    // that is completely unnecessary and would break 
    // the code of anyone upgrading from the 1.0 version.
    // Ridiculously unpasteable validation URLs are a 
    // pet peeve of mine anyway.
    for ($i = 0; ($i < 8); $i++) {
      $guid .= sprintf("%02x", mt_rand(0, 255));
    }
    return $guid;
  }

  protected function getFileAsTag($attributes)
  {
    if ($this->getOption('is_image'))
    {
      return false !== $this->getOption('file_src') ? $this->renderTag('img', array_merge(array('src' => $this->getOption('file_src'))), $attributes) : '';
    }
    else
    {
      return $this->getOption('file_src');
    }
  }
}
