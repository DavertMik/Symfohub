<?php

class addRepositoryTask extends sfBaseTask {

    protected function configure() {
        $this->addArgument('username', sfCommandArgument::REQUIRED, "GitHub user name");
        $this->addArgument('repository', sfCommandArgument::REQUIRED, "GitHub repository name");

        $this->namespace        = 'symfohub';
        $this->name             = 'repositories-add';
        $this->briefDescription = 'add repository from GitHub';
    }

    protected function execute($arguments = array(), $options = array()) {
        // initialize the database connection
        new sfDatabaseManager($this->configuration);

        $repo = RepositoryTable::getInstance()->findOrCreateByNameAndOwnerName($arguments['repository'], $arguments['username']);
    }
}
