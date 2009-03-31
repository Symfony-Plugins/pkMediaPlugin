<?php

// Conveniences for Symfony code that uses the API.

class pkMediaAPI
{
  static public function getSelectedItem(
    sfRequest $request, $key, $type = false)
  {
    return self::getSelectedItems($request, $key, true, $type);
  }
  static public function getSelectedItems(
    sfRequest $request, $key, $singular = false, $type = false)
  {
    if ($singular)
    {
      if (!$request->hasParameter('pkMediaId'))
      {
        return false;
      }
      $id = $request->getParameter('pkMediaId');
      if (!preg_match("/^\d+$/", $id))
      {
        return false;
      }
      $ids = $id; 
    }
    else
    {
      if (!$request->hasParameter('pkMediaIds'))
      {
        // User cancelled the operation in the media plugin
        return false;
      }
      $ids = $request->getParameter('pkMediaIds');
      if (!preg_match("/^(\d+\,?)*$/", $ids))
      {
        // Bad input, possibly a hack attempt
        return false;
      }
    }

    // apikey gives us permission to inspect media as a particular user
    $options = array(
      'apikey' => sfConfig::get($key . '_apikey'),
      'pkMediaIds' => $ids);
    $user = sfContext::getInstance()->getUser();
    if ($user->isAuthenticated())
    {
      $options['user'] = $user->getGuardUser()->getUsername();
    }

    $url = sfConfig::get($key . '_site') .
        '/media/info?' . http_build_query($options);
    $content = file_get_contents($url);
    $response = json_decode($content);
    if (!is_object($response))
    {
      return false;
    }
    if ($response->status !== 'ok')
    {
      return false;
    }
    if (!is_array($response->result))
    {
      return false;
    }
    if ($type !== false)
    {
      $nresult = array();
      foreach ($response->result as $item)
      {
        if ($item->type === $type)
        {
          $nresult[] = $item;
        }
      }
      $response->result = $nresult;
    }
    if ($singular)
    {
      if (!count($response->result))
      {
        return false;
      }
      return $response->result[0];
    }
    return $response->result;
  }
}
