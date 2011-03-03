<?php
/**
 * Twitter user timeline query class
 *
 */
class TwitterStatusUserTimelineQuery extends TwitterStatusQuery 
{
  /**
   * Return the URL format for the query
   *
   * @return string
   */
  public function getUrlFormat()
  {
    return 'http://api.twitter.com/2/statuses/user_timeline.%format%';
  }
  
  /**
   * Get an array of allowed parameters for this query
   *
   * @return array
   */
  public function getAllowedParameters()
  {
    static $allowed_parameters = array(
      self::PARAM_USER_ID, 
      self::PARAM_SCREEN_NAME, 
      self::PARAM_SINCE_ID,
      self::PARAM_MAX_ID,
      self::PARAM_COUNT, 
      self::PARAM_PAGE,
      self::PARAM_TRIM_USER,
      self::PARAM_INCLUDE_RTS,
      self::PARAM_INCLUDE_ENTITIES,
    );
    return $allowed_parameters;
  }
}
