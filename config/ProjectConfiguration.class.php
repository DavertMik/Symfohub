<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();
require_once dirname(__FILE__).'/../vendor/autoload.php';


class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup() {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('doGitHubPlugin');
    $this->enablePlugins('sfDoctrineActAsTaggablePlugin');
    $this->enablePlugins('sfDoctrineActAsRattablePlugin');
    $this->enablePlugins('sfGeshiPlugin');
    $this->enablePlugins('drTwitterFeedPlugin');
    $this->enablePlugins('doDiqusPlugin');
  }
}
