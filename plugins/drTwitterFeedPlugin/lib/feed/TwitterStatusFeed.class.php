<?php
/**
 * Base class for a TwitterStatusFeed
 * Fetches tweets for a given query
 *
 */
class TwitterStatusFeed extends ArrayIterator {
  protected $_query = null;
  protected $_tweets = array();

  public function __construct(TwitterStatusQuery $query) {
    $this->setQuery($query);

    parent::__construct($this->_tweets);
  }

  /**
   *
   * @return TwitterStatusQuery
   */
  public function getQuery() {
    return $this->_query;
  }

  public function setQuery(TwitterStatusQuery $query) {
    $this->_query = $query;
  }

  public function fetchTweets() {
    $query = $this->getQuery();

    $ch = curl_init($query->buildUrl());
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($result);
    $tweets = $result->results;

    $tweetlist = array();
    foreach ($tweets as $tweet) {
        $t = new TwitterTweet();
        $t->avatar = $tweet->profile_image_url;
        $t->keyword = $query->getParameter('q');
        $t->screen_name = $tweet->from_user;
        $t->user_id = $tweet->from_user_id_str;
        $t->native_id = $tweet->id_str;
        $t->created_at = $tweet->created_at;
        $t->parsed_text = $tweet->text;
        $t->replace();
        $tweetlist[] = $t;
    }

    return $tweetlist;
  }

  public function getTweets() {
    return $this->_tweets;
  }
}
