<?php

class doGitHubPluginConfiguration extends sfPluginConfiguration {

  /**
   * @see sfPluginConfiguration
   */
  public function initialize() {
      if($this->configuration instanceof sfApplicationConfiguration) {
          require_once($this->configuration->getConfigCache()->checkConfig('config/symfohub.yml'));
      }
  }
}
