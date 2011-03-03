<?php

/**
 * BaseTwitterTweetLastFetch
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $keyword
 * @property string $screen_name
 * @property string $user_id
 * @property datetime $fetched_at
 * 
 * @method string                getKeyword()     Returns the current record's "keyword" value
 * @method string                getScreenName()  Returns the current record's "screen_name" value
 * @method string                getUserId()      Returns the current record's "user_id" value
 * @method datetime              getFetchedAt()   Returns the current record's "fetched_at" value
 * @method TwitterTweetLastFetch setKeyword()     Sets the current record's "keyword" value
 * @method TwitterTweetLastFetch setScreenName()  Sets the current record's "screen_name" value
 * @method TwitterTweetLastFetch setUserId()      Sets the current record's "user_id" value
 * @method TwitterTweetLastFetch setFetchedAt()   Sets the current record's "fetched_at" value
 * 
 * @package    symfohub
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTwitterTweetLastFetch extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('twitter_tweet_last_fetches');
        $this->hasColumn('keyword', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('screen_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('user_id', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('fetched_at', 'datetime', null, array(
             'type' => 'datetime',
             ));


        $this->index('keyword', array(
             'fields' => 
             array(
              0 => 'keyword',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}