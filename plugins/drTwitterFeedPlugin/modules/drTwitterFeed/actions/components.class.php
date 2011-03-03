<?php
class drTwitterFeedComponents extends sfComponents
{
  public function executeStatusUserTimeline()
  {
    $query = new TwitterStatusUserTimelineQuery();
    $query->setParameters($this->getVar('query_parameters'));
    
    $this->feed = new TwitterStatusCachedFeedDoctrine($query);
    $this->feed->fetchTweets();
    $this->tweets = $this->feed->getTweets($this->getVar('limit'));
  }
}
