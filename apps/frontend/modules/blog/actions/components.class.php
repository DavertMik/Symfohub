<?php

class blogComponents extends sfComponents
{
	public function executeLast_post() {
	    $this->post = Doctrine::getTable('Post')->createQuery()->
					    where('is_recommendation = ?',true)->
					    orderBy('created_at DESC')->
					    fetchOne();
      if (!$this->post) return sfView::NONE;

	}
}