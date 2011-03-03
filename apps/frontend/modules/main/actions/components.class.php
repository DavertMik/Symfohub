<?php

class mainComponents extends sfComponents
{
	public function executeComments() {
    try {
      $this->comments = @doDisqusApi::getCurrent()->posts->list(array('limit' => '10'));
      if (!is_array($this->comments)) throw new Exeption('API not avaible');
      foreach ($this->comments as $comment) {
          $comment->threadInfo = doDisqusApi::getCurrent()->threads->details(array('thread' => $comment->thread));
          $comment->title = strtok($comment->threadInfo->title,' ');
      }
    } catch (Exception $e) {
      return sfView::NONE;
    }
	}
}