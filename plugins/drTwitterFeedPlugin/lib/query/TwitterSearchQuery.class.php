<?php
/**
 * Author: davert
 * Date: 28.11.10
 *
 * Class TwitterSearchQuery
 * Description:
 * 
 */
 
class TwitterSearchQuery extends TwitterStatusQuery {

  /**
   * Return the URL format for the query
   *
   * @return string
   */
  public function getUrlFormat()
  {
    return 'http://search.twitter.com/search.%format%';
  }

  /**
   * Get an array of allowed parameters for this query
   *
   * @return array
   */
  public function getAllowedParameters()
  {
    static $allowed_parameters = array(
      self::PARAM_SINCE_ID,
      self::PARAM_PAGE,
      'callback','lang','locale','max_id','q','rpp','since','geocode','show_user','until','result_type'
    );
    return $allowed_parameters;
  }  

}
