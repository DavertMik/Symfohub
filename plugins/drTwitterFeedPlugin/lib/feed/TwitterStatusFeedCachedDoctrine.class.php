<?php
/**
 * Extension of the TwitterStatusUserTimeLineFeed class
 * Caches tweets by saving them to the database using Doctrine
 *
 */
class TwitterStatusCachedFeedDoctrine extends TwitterStatusFeed 
{
  // the refresh time for tweets is 10 minutes by default
  protected $_refresh_time = 600;
  
  /**
   * Set the refresh time for tweets
   *
   * @param integer $seconds
   */
  public function setRefreshTime($seconds)
  {
    $this->_refresh_time = (int)$seconds;
  }
  
  /**
   * Fetch tweets from Twitter and save them to the database
   *
   * @return array
   */
  public function fetchTweets()
  {
    $table = Doctrine::getTable('TwitterTweet');
    /* @var $table TwitterTweetTable */
    
    $last_fetch_table = Doctrine::getTable('TwitterTweetLastFetch');
    /* @var $last_fetch_table TwitterTweetLastFetchTable */

    if ($last_fetch_table->getLastFetchTimeForQuery($this->getQuery()) + $this->_refresh_time < time())
    {
      $since_id = $table->getLatestFetchedIdForTwitterQuery($this->getQuery());
      if ($since_id)
      {
        $this->getQuery()->setParameter(TwitterStatusUserTimelineQuery::PARAM_SINCE_ID, $since_id);
      }
      
      $tweets = parent::fetchTweets();

      $last_fetch_table->updateLastFetchTimeForQuery($this->getQuery());
      
      return $tweets;
    }
  }
  
  /**
   * Load cached tweets from the database
   *
   */
  public function loadTweets()
  {
    $tweets = Doctrine::getTable('TwitterTweet')->getTweetsByTwitterQuery($this->getQuery());
    foreach ($tweets as $tweet)
    {
      $this->_tweets[$tweet->native_id] = $tweet;
    }
  }
  
  /**
   * Get the tweets
   *
   * @param integer $limit
   * @return array
   */
  public function getTweets($limit = null)
  {
    $this->loadTweets();
    if ($limit !== null)
    {
      $tweets = array_slice($this->_tweets, 0, $limit, true);
      return $tweets;
    }
    return $this->_tweets;
  }
}
