<?php
/**
 * Author: davert
 * Date: 26.01.11
 *
 * Class doDisqusApi
 * Description:
 * 
 */
 
class doDisqusApi extends DisqusAPI {

  protected static $instance;

  static public function getCurrent()
  {
    if (self::$instance) return self::$instance;
    $key = sfConfig::get('app_disqus_secret_key');
    self::$instance = new DisqusAPI($key);
    return self::$instance;
  }

}
