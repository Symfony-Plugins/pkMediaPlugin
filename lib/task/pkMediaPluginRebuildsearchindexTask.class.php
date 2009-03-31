<?php

class pkMediaPluginRebuildsearchindexTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'pkMediaPlugin';
    $this->name             = 'rebuild-search-index';
    $this->briefDescription = 'rebuild Lucene search indexes';
    $this->detailedDescription = <<<EOF
The [pkMediaPlugin:rebuild-search-index|INFO] task does things.
Call it with:

  [php symfony pkMediaPlugin:rebuild-search-index|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    // Add these calls for other table classes as needed
    Doctrine::getTable('pkMediaItem')->rebuildLuceneIndex();
  }
}
