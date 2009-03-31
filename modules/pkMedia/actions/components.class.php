<?php

class pkMediaComponents extends sfComponents
{
  public function executeBrowser($request)
  {
    $this->form = new pkMediaBrowseForm();
    // This works because the most recent invocation of the
    // index action will have already set this; it's stored
    // as an attribute
    $this->form->bind(pkMediaTools::getSearchParameters());
  }
  public function executeBreadcrumb($request)
  {
    $this->type = pkMediaTools::getSearchParameter('type');
    $this->tag = pkMediaTools::getSearchParameter('tag');
    $this->search = pkMediaTools::getSearchParameter('search');
    $this->crumbs = array();
    // I tried calling I18N here but that requires enabling
    // I18N for every project which the I18N helper does not...
    // I'm not internationalizing this site, so I give up. 
    // If you're reading this, tell me how to localize these labels
    // without punishing noninternationalized sites. I really don't
    // want to push this much logic into a template. tom@punkave.com
    $this->crumbs[] = array(
      "label" => "Home",
      "link" => "@homepage",
      "first" => true);
    $this->crumbs[] = array(
      "label" => "Media",
      "link" => "pkMedia/index");
    if ($this->type)
    {
      $this->crumbs[] = array(
        "label" => $this->type,
        "link" => pkUrl::addParams("pkMedia/index", array("type" => $this->type)));
    }
    if ($this->tag)
    {
      $this->crumbs[] = array(
        "label" => htmlspecialchars($this->tag),
        "link" => pkUrl::addParams("pkMedia/index", array("type" => $this->type, "tag" => $this->tag))); 
    }
    if ($this->search)
    {
      $this->crumbs[] = array(
        "label" => htmlspecialchars($this->search),
        "link" => pkUrl::addParams("pkMedia/index", array("type" => $this->type, "tag" => $this->tag, "search" => $this->search)));
    }
    if (isset($this->item))
    {
      $this->crumbs[] = array(
        "label" => $this->item->getTitle(),
        "link" => pkUrl::addParams("pkMedia/show", array("slug" => $this->item->getSlug())));
    }
    $this->crumbs[count($this->crumbs) - 1]['last'] = true;
  }

  public function executeMultipleList($request)
  {
    if (!pkMediaTools::isMultiple())
    {
      throw new Exception("multiple list component, but multiple is off"); 
    }
    $selection = pkMediaTools::getSelection();
    if (!is_array($selection))
    {
      throw new Exception("selection is not an array");
    }
    // Work around the fact that whereIn doesn't evaluate to AND FALSE
    // when the array is empty (it just does nothing; which is an
    // interesting variation on MySQL giving you an ERROR when the 
    // list is empty, sigh)
    if (count($selection))
    {
      // Work around the unsorted results of whereIn. You can also
      // do that with a FIELD function
      $unsortedItems = Doctrine_Query::create()->
        from('pkMediaItem i')->
        whereIn('i.id', $selection)->
        execute();
      $itemsById = array();
      foreach ($unsortedItems as $item)
      {
        $itemsById[$item->getId()] = $item;
      }
      $this->items = array();
      foreach ($selection as $id)
      {
        if (isset($itemsById[$id]))
        {
          $this->items[] = $itemsById[$id];
        }
      }
    }
    else
    {
      $this->items = array();
    }
  }
}
