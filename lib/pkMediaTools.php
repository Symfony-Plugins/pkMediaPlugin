<?php

class pkMediaTools
{
  // These are used internally. If you want to select something
  // with the media module please see the README, do not use these 
  // methods directly

  static public function setSelecting($after, $multiple, $selection, 
    $options = array())
  {
    self::clearSelecting();
    self::setAttribute("selecting", true);
    self::setAttribute("after", $after);
    self::setAttribute("multiple", $multiple);
    self::setAttribute("selection", $selection);
    foreach ($options as $key => $val)
    {
      self::setAttribute($key, $val);
    }
  }
  static public function clearSelecting()
  {
    self::removeAttributes(
      array("after", "selecting", "multiple", "selection", 
        "type", "aspect-width", "aspect-height",
        "minimum-width", "minimum-height",
        "width", "height", "label"));
  }
  static public function isSelecting()
  {
    return self::getAttribute("selecting");
  }
  static public function isMultiple()
  {
    return self::getAttribute("multiple");
  }
  static public function getSelection()
  {
    return self::getAttribute("selection", array());
  }
  static public function setSelection($array)
  {
    self::setAttribute("selection", $array);
  }
  static public function getAfter()
  {
    return self::getAttribute("after");
  }
  static public function isSelected($item)
  {
    if (is_object($item))
    {
      $id = $item->id;
    }
    else
    {
      $id = $item;
    }
    $selection = self::getSelection();
    return (array_search($id, $selection) != false);
  }
  static public function setSearchParameters($array)
  {
    self::setAttribute("search-parameters", $array); 
  }

  static public function getSearchParameters($default = false)
  {
    if ($default === false)
    {
      $default = array();
    }
    return self::getAttribute("search-parameters", $default);
  }

  static public function getSearchParameter($p, $default = false)
  {
    $parameters = self::getSearchParameters();
    if (isset($parameters[$p]))
    {
      return $parameters[$p];
    }
    return $default;
  }

  static public function getType()
  {
    return self::getAttribute('type');
  }

  static public function userHasUploadPrivilege()
  {
    $user = sfContext::getInstance()->getUser();
    if (!$user->isAuthenticated())
    {
      return false;
    }
    $uploadCredential = self::getOption('upload_credential');
    if ($uploadCredential)
    {
      return $user->hasCredential($uploadCredential);
    }
    else
    {
      return true;
    }
  }

  static private function getUser()
  {
    return sfContext::getInstance()->getUser();
  }
  // Symfony 1.2 has no namespaces for attributes for some reason
  static public function getAttribute($attribute, $default = null)
  {
    $attribute = "pkMedia-$attribute";
    return self::getUser()->getAttribute($attribute, $default);
  }
  static public function setAttribute($attribute, $value = null)
  {
    $attribute = "pkMedia-$attribute";
    self::getUser()->setAttribute($attribute, $value);
  }
  static public function removeAttributes($attributes)
  {
    $user = self::getUser();
    foreach ($attributes as $attribute)
    {
      $user->setAttribute("pkMedia-$attribute", null);
    }
  }
  // This is a good convention for plugin options IMHO
  static private $options = array(
    "batch_max" => 6,
    "per_page" => 20,
    "popular_tags" => 10,
    "video_search_per_page" => 9,
    "video_search_preview_width" => 220,
    "video_search_preview_height" => 170,
    "upload_credential" => false,
    "admin_credential" => "media_admin",
    "gallery_constraints" => array(
        "width" => 340,
        "height" => false,
        "resizeType" => "s"),
    "selected_constraints" => array(
        "width" => 100,
        "height" => 75,
        "resizeType" => "c"),
    "show_constraints" => array(
        "width" => 720,
        "height" => false,
        "resizeType" => "s"),
    'routes_register' => true,
    'apipublic' => false,
    'embed_codes' => false,
    'apikeys' => array()
  );
  static public function getOption($name)
  {
    if (isset(self::$options[$name]))
    {
      $name = preg_replace("/[^\w]/", "", $name);
      $key = "app_pkMedia_$name";
      return sfConfig::get($key, self::$options[$name]);
    }
    else
    {
      throw new Exception("Unknown option in pkMediaPlugin: $name");
    }
  }
  
}
