<?php

class pkMediaTools
{
  // These are used internally. If you want to select something
  // with the media module please see the README, do not use these 
  // methods directly

  static public function setSelecting($after, $multiple, $selection, 
    $type = false)
  {
    self::setAttribute("selecting", true);
    self::setAttribute("after", $after);
    self::setAttribute("multiple", $multiple);
    self::setAttribute("selection", $selection);
    self::setAttribute("type", $type);
  }
  static public function clearSelecting()
  {
    self::removeAttributes(
      array("after", "selecting", "multiple", "selection", "type"));
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
  static private function getAttribute($attribute, $default = null)
  {
    return self::getUser()->getAttribute($attribute, $default, "pkMedia");
  }
  static private function setAttribute($attribute, $value = null)
  {
    self::getUser()->setAttribute($attribute, $value, "pkMedia");
  }
  static private function removeAttributes($attributes)
  {
    $user = self::getUser();
    foreach ($attributes as $attribute)
    {
      $user->setAttribute($attribute, null, 'pkMedia');
    }
  }
  // This is a good convention for plugin options IMHO
  static private $options = array(
    "batch_max" => 6,
    "per_page" => 20,
    "popular_tags" => 10,
    "video_search_per_page" => 6,
    "video_search_preview_width" => 240,
    "video_search_preview_height" => 180,
    "upload_credential" => false,
    "admin_credential" => "media_admin",
    'gallery_width' => 340,
    'gallery_height' => false,
    'defaultrouting' => true,
    'apipublic' => false,
    'gallery_resizeType' => 's',
    'selected_width' => 100,
    'selected_height' => 75,
    'selected_resizeType' => 'c',
    'show_width' => 720,
    'show_height' => 720,
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
