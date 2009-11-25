<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginpkMediaItemTable extends Doctrine_Table
{
  public function getLuceneIndex()
  {
    return pkZendSearch::getLuceneIndex($this);
  }
   
  public function getLuceneIndexFile()
  {
    return pkZendSearch::getLuceneIndexFile($this);
  }

  public function searchLucene($luceneQuery)
  {
    return pkZendSearch::searchLucene($this, $luceneQuery);
  }
  
  public function rebuildLuceneIndex()
  {
    return pkZendSearch::rebuildLuceneIndex($this);
  }
  
  public function optimizeLuceneIndex()
  {
    return pkZendSearch::optimizeLuceneIndex($this);
  }
  
  public function addSearchQuery(Doctrine_Query $q = null, $luceneQuery)
  {
    return pkZendSearch::addSearchQuery($this, $q, $luceneQuery);
  }
  
  static public function slugify($s)
  {
    $s = Doctrine_Inflector::urlize($s);
    $s = str_replace("/", "-", $s);
    return $s;
  }

  static public function getDirectory()
  {
    return pkFiles::getUploadFolder('media_items');
  }

  // Returns items for all ids in $ids. If an item does not exist,
  // that item is not returned; this is not considered an error.
  // You can easily compare count($result) to count($ids). 
  static public function retrieveByIds($ids)
  {
    if (!count($ids))
    {
      // WHERE freaks out over empty lists. We don't.
      return array();
    }
    if (count($ids) == 1)
    {
      if (!$ids[0])
      {
        // preg_split and its ilk return a one-element array
        // with an empty string in it when passed an empty string.
        // Tolerate this.
        return array();
      }
    }
    $q = Doctrine_Query::create()->
      select('m.*')->
      from('pkMediaItem m')->
      whereIn("m.id", $ids);
    pkDoctrine::orderByList($q, $ids);
    return $q->execute();
  }
  static public $mimeTypes = array(
    "gif" => "image/gif",
    "png" => "image/png",
    "jpg" => "image/jpeg",
    "pdf" => "application/pdf"
  );
  
  // Returns a query matching media items satisfying the specified parameters, all of which
  // are optional:
  //
  // tag
  // search
  // type (video or image)
  // user (a username, to determine access rights)
  // aspect-width and aspect-height (returns only images with the specified aspect ratio)
  // minimum-width
  // minimum-height
  // width
  // height 
  // ids
  //
  // Parameters are passed safely via wildcards so it should be OK to pass unsanitized
  // external API inputs to this method.
  //
  // 'ids' is an array of item IDs. If it is present, only items with one of those IDs are
  // potentially returned.
  //
  // If 'search' is present, results are returned in descending order by match quality.
  // Otherwise, if 'ids' is present, results are returned in that order. Otherwise,
  // results are returned newest first.
  
  static public function getBrowseQuery($params)
  {
    $query = Doctrine_Query::create();
    // We can't use an alias because that is incompatible with getObjectTaggedWithQuery
    $query->from('pkMediaItem');
    if (isset($params['ids']))
    {
      $query->select('pkMediaItem.*');
      pkDoctrine::orderByList($query, $params['ids']);
      $query->andWhereIn("pkMediaItem.id", $params['ids']);
    }
    if (isset($params['tag']))
    {
      $query = TagTable::getObjectTaggedWithQuery(
        'pkMediaItem', $params['tag'], $query);
    }
    if (isset($params['type']))
    {
      $query->andWhere("pkMediaItem.type = ?", array($params['type']));
    }
    if (isset($params['search']))
    {
      $query = Doctrine::getTable('pkMediaItem')->addSearchQuery($query, $params['search']);
    }
    elseif (isset($params['ids']))
    {
      // orderBy added by pkDoctrine::orderByIds
    }
    else
    {
      // Reverse chrono order if we're not ordering them by search relevance
      $query->orderBy('pkMediaItem.id desc');
    }
    // This will be more interesting later
    if (!isset($params['user']))
    {
      $query->andWhere('pkMediaItem.view_is_secure = false');
    }
    if (isset($params['aspect-width']) && isset($params['aspect-height']))
    {
      $query->andWhere('(pkMediaItem.width * ? / ?) = pkMediaItem.height', array($params['aspect-height'] + 0, $params['aspect-width'] + 0));
    }
    if (isset($params['minimum-width']))
    {
      $query->andWhere('pkMediaItem.width >= ?', array($params['minimum-width'] + 0));
    }
    if (isset($params['minimum-height']))
    {
      $query->andWhere('pkMediaItem.height >= ?', array($params['minimum-height'] + 0));
    }
    if (isset($params['width']))
    {
      $query->andWhere('pkMediaItem.width = ?', array($params['width'] + 0));
    }
    if (isset($params['height']))
    {
      $query->andWhere('pkMediaItem.height = ?', array($params['height'] + 0));
    }
    return $query;
  }
  
  static public function getAllTagNameForUserWithCount()
  {
    // Retrieves only tags relating to media items this user is allowed to see
    $q = NULL;
    if (!sfContext::getInstance()->getUser()->isAuthenticated())
    {
      $q = Doctrine_Query::create()->from('Tagging tg, tg.Tag t, pkMediaItem m');
      // If you're not logged in, you shouldn't see tags relating to secured stuff
      // Always IS FALSE, never = FALSE
      $q->andWhere('m.id = tg.taggable_id AND ((m.view_is_secure IS NULL) OR (m.view_is_secure IS  FALSE))');
    }
    return TagTable::getAllTagNameWithCount($q, 
      array("model" => "pkMediaItem"));
  }
}
