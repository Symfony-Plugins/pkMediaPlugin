<?php

/**
 * pkMediaPlugin configuration.
 * 
 * @package     pkMediaPlugin * @subpackage  config
 */
class pkMediaPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */  public function initialize()
  {
    if (sfConfig::get('app_pk_media_plugin_routes_register', true) && in_array('pkMedia', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('pkMediaRouting', 'listenToRoutingLoadConfigurationEvent'));
    }
  }
}


