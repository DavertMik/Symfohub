<?php

class refreshDataTask extends sfBaseTask {

	protected function configure() {
		$this->namespace = 'symfohub';
		$this->name = 'repositories-refresh';
		$this->briefDescription = 'refresh repositories info from GitHub';
	}

	protected function execute($arguments = array(), $options = array()) {
		// initialize the database connection
		new sfDatabaseManager($this->configuration);

		$api = new phpGithubApi();
		$repos = Doctrine::getTable('Repository')->createQuery('r')
				->execute();

		$start = time();
		$tick = 0;
		foreach ($repos as $repo) {
			$this->log("Getting repo {$repo->owner}/{$repo->name}");

			try {
				$info = $api->getRepoApi()->show($repo->owner, $repo->name);

				$repo->description = $info['description'];
				$repo->forks = $info['forks'];
				$repo->watchers = $info['watchers'];
				$repo->fork = $info['fork'];
				$repo->homepage = $info['homepage'];
				$repo->has_wiki = $info['has_wiki'];
				$repo->has_issues = $info['has_issues'];
				$repo->has_downloads = $info['has_downloads'];
				$repo->created_at = $info['created_at'];
				$repo->updated_at = $info['pushed_at'];

				$commitInfo = $api->getCommitApi()->getBranchCommits($repo->owner, $repo->name, 'master');
				$fileInfo = null;
				foreach (array('README.markdown', 'README.md', 'README') as $filename) {
					try {
						$fileInfo = $api->getObjectApi()->showBlob($repo->owner, $repo->name, $commitInfo[0]['parents'][0]['id'], $filename);
					}
					catch (Exception $e) {
						// do nothing :(
					}
					if ($fileInfo) {
            $hash = md5($fileInfo['data']);
            if ($documentation = $repo->Documentation) {
              if ($documentation->text_hash != $hash) {
                $documentation->text = $fileInfo['data'];
                $documentation->text_hash = $hash;
                $documentation->save();
              }
            } else {
              $documentation = new Documentation();
              $documentation->text = $fileInfo['data'];
              $documentation->text_hash = $hash;
              $repo->Documentation = $documentation;
              $documentation->save();
            }
            break;
          }
				}
        if (!$repo->type) $repo->guessType();
				$repo->save();

				if (!Doctrine::getTable('Requirement')->createQuery()->
						where('repository_id', $repo->id)->
						andWhere('type', 'symfony')->
						count()) {
					$req = new Requirement();
					$req->type = 'symfony';
					if (preg_match('~Plugin$~', $repo->name)) {
						$req->value = '1.4';
						$repo->type = 'plugin';
						$req->save();
					}
					if (preg_match('~Bundle$~', $repo->name)) {
						$req->value = '2';
						$repo->type = 'bundle';
						$req->save();
					}
				}

				$this->log("done!");
			}
			catch (Exception $e) {
				$this->log("error!");
				$this->log("Message: ".$e->getMessage());
				$this->log($e->getTraceAsString());
				$t = 5;
				$this->log("Waiting $t seconds before continue");
				sleep($t);
			}


		}

	}
}
