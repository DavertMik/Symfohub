<?php

class twitterComponents extends sfComponents
{
	public function executeList() {
    if (!isset($this->name)) $this->name = '#symfohub';
    $query = new TwitterSearchQuery();
    $query->setParameter('q', $this->name);

    $this->feed = new TwitterStatusCachedFeedDoctrine($query);
    $this->feed->setRefreshTime(3600);
    $this->feed->fetchTweets();
    $this->tweets = $this->feed->getTweets(5);
	}

}