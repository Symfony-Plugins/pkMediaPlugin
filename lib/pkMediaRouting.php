<?php

class pkMediaRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();
    if (pkMediaTools::getOption("defaultrouting") && in_array('pkMedia', sfConfig::get('sf_enabled_modules')))
    {
      // media-items also maps to a physical folder, which is by design: it's our
      // caching strategy. /media does not. I tried making the first a subfolder
      // of the second but that led to battles with Apache. 
      $r->prependRoute('pk_media_image_show',
        new sfRoute('/media/view/:slug',
          array('module' => 'pkMedia', 'action' => 'show'),
          array('slug' => '^[\w\-]+$')));
      $r->prependRoute('pk_media_image_original',
        new sfRoute('/media-items/:slug.original.:format',
          array('module' => 'pkMedia', 'action' => 'original'),
          array('slug' => '^[\w\-]+$', 'format' => '^(jpg|png|gif)$')));
      $r->prependRoute('pk_media_image',
        new sfRoute('/media-items/:slug.:width.:height.:resizeType.:format',
          array('module' => 'pkMedia', 'action' => 'image'),
          array('slug' => '^[\w\-]+$', 'width' => '^\d+$', 'height' => '^\d+$',
            'resizeType' => '^\w$', 'format' => '^(jpg|png|gif)$')));
      // What we want:
      // /media   <-- everything
      // /media/image   <-- media of type image
      // /media/video   <-- media of type video
      // /tag/tagname <-- media with this tag
      // /media/image/tag/tagname <-- images with this tag 
      // /media/video/tag/tagname <-- video with this tag
      // /media?search=blah blah blah  <-- searches are full of
      //                                   dirty URL-unfriendly characters and
      //                                   are traditionally query strings.
      $r->prependRoute('pk_media_index',
        new sfRoute('/media',
          array('module' => 'pkMedia', 'action' => 'index')));
      $r->prependRoute('pk_media_index_type',
        new sfRoute('/media/:type',
          array('module' => 'pkMedia', 'action' => 'index'),
          array('type' => '(image|video)')));
      $r->prependRoute('pk_media_index_tag',
        new sfRoute('/media/tag/:tag',
          array('module' => 'pkMedia', 'action' => 'index')));
      $r->prependRoute('pk_media_index_type_tag',
        new sfRoute('/media/:type/tag/:tag',
          array('module' => 'pkMedia', 'action' => 'index'),
          array('type' => '(image|video)')));
      // APIs
      $r->prependRoute('pk_media_select',
        new sfRoute('/media/select',
          array('module' => 'pkMedia', 'action' => 'select')));
      $r->prependRoute('pk_media_info',
        new sfRoute('/media/info',
          array('module' => 'pkMedia', 'action' => 'info')));
    }
  }
}
