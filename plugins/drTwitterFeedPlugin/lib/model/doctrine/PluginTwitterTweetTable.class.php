<?php

/**
 * PluginTwitterTweetTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginTwitterTweetTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object PluginTwitterTweetTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginTwitterTweet');
  }
  
  /**
   * Get the id of the last fetched tweet for a given TwitterStatusQuery
   *
   * @param TwitterStatusQuery $query
   * @return integer
   */
  public function getLatestFetchedIdForTwitterQuery(TwitterStatusQuery $query)
  {
    $q = $this->getBaseQueryForTwitterQuery($query);
    $q->select($q->getRootAlias().'.native_id');
    $q->orderBy($q->getRootAlias().'.created_at DESC');
    $id = $q->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
    return $id;
  }
  
  /**
   * Get the base Doctrine query for cached tweets for a given TwitterStatusQuery
   *
   * @param TwitterStatusQuery $query
   * @return Doctrine_Query
   */
  public function getBaseQueryForTwitterQuery(TwitterStatusQuery $query)
  {
    $q = $this->createQuery('t');
    
    if ($user_id = $query->getUserId())
    {
      $q->addWhere($q->getRootAlias().'.user_id = ?', $user_id);
    }
    
    if ($screen_name = $query->getScreenName())
    {
      $q->addWhere($q->getRootAlias().'.screen_name = ?', $screen_name);
    }

    if ($keyword = $query->getParameter('q'))
    {
      $q->addWhere($q->getRootAlias().'.keyword = ?', $keyword);
    }
    
    if ($limit = $query->getCount())
    {
      $q->limit($limit);
    }
    
    return $q;
  }
  
  /**
   * Retrieve cached tweets for a given TwitterStatusQuery
   *
   * @param TwitterStatusQuery $query
   * @return Doctrine_Collection
   */
  public function getTweetsByTwitterQuery(TwitterStatusQuery $query)
  {
    $q = $this->getBaseQueryForTwitterQuery($query);
    $q->orderBy($q->getRootAlias().'.created_at DESC');
    return $q->execute();
  }
  
  /**
   * Store a tweet, wrapped in a TwitterTweetWrapper
   *
   * @param TwitterTweetWrapper $tweet_wrapper
   * @return TwitterTweet
   */
  public function store($tweet_wrapper)
  {
        throw new Exception();
    $tweet = $this->find($tweet_wrapper->getId());
    if (!$tweet)
    {
      $tweet = new TwitterTweet();
      $tweet->user_id = $tweet_wrapper->getUserId();
      $tweet->native_id = $tweet_wrapper->getId();
      $tweet->screen_name = $tweet_wrapper->getScreenName();
      $tweet->raw_xml = $tweet_wrapper->getRawXml();
      $tweet->parsed_text = $tweet_wrapper->getParsedText();
      $tweet->created_at = $tweet_wrapper->getDateTime()->format('Y-m-d H:i:s');
      $tweet->save();
    }
    return $tweet;
  }
}
