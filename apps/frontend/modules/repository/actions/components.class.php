<?php

class repositoryComponents extends sfComponents
{
	public function executeList() {
	    $this->repositories = Doctrine::getTable('Repository')->createQuery()->
					    where('is_verified = ?',true)->
					    orderBy($this->order)->
					    limit(10)->
					    execute();

	}
}