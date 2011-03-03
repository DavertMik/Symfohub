<?php
/**
 * Base class for a Twitter status query 
 * Must be extended
 */
abstract class TwitterStatusQuery 
{
  // Twitter API output formats
  const FORMAT_XML = 'xml';
  const FORMAT_JSON = 'json';
  const FORMAT_RSS = 'rss';
  const FORMAT_ATOM = 'atom';

  // allowed output formats
  static public $allowed_formats = array(
    self::FORMAT_XML,
    self::FORMAT_JSON,
    self::FORMAT_RSS,
    self::FORMAT_ATOM,
  );
  
  // twitter API parameters
  const PARAM_USER_ID = 'user_id';
  const PARAM_SCREEN_NAME = 'screen_name';
  const PARAM_SINCE_ID = 'since_id';
  const PARAM_MAX_ID = 'max_id';
  const PARAM_COUNT = 'count';
  const PARAM_PAGE = 'page';
  const PARAM_TRIM_USER = 'trim_user';
  const PARAM_INCLUDE_RTS = 'include_rts';
  const PARAM_INCLUDE_ENTITIES = 'include_entities';
  
  /**
   * The extension class should return an array of parameters that are allowed for the query  
   *
   */
  abstract public function getAllowedParameters();
  
  /**
   * The extension class should return the API URL containing %version% and %format% 
   *
   */
  abstract public function getUrlFormat();

  /**
   * Construct the query
   *
   * @param integer $version
   * @param string $format
   * @param array $parameters
   */
  public function __construct($version = null, $format = null, array $parameters = array())
  {

    if ($format === null)
    {
      $format = self::FORMAT_JSON;
    }
    $this->setFormat($format);
    
    $this->setParameters($parameters);
  }
  
  /**
   * Set a query parameter
   *
   * @param string $name
   * @param string $value
   */
  public function setParameter($name, $value)
  {
//    if (!in_array($name, $this->getAllowedParameters()))
//    {
//      throw new InvalidArgumentException(sprintf('Invalid parameter name "%s"', $name));
//    }
    
    $this->_parameters[$name] = $value;
  }
  
  /**
   * Get the current value for a given parameter
   *
   * @param string $name
   * @param string $default
   * @return string
   */
  public function getParameter($name, $default = null)
  {
    return (isset($this->_parameters[$name]) ? $this->_parameters[$name] : $default);
  }
  
  /**
   * Set multiple query parameters at once by providing an associative array 
   *
   * @param array $parameters
   */
  public function setParameters(array $parameters)
  {
    foreach ($parameters as $name => $value)
    {
      $this->setParameter($name, $value);
    }
  }
  
  /**
   * Unset a parameter
   *
   * @param string $name
   */
  public function unsetParameter($name)
  {
    if (isset($this->_parameters[$name]))
    {
      unset($this->_parameters[$name]);
    }
  }
  
  /**
   * Get all current parameters
   *
   * @return array
   */
  public function getParameters()
  {
    return $this->_parameters;
  }
  
  /**
   * Set the output format for this query
   *
   * @param string $format
   */
  public function setFormat($format)
  {
    if (!in_array($format, self::$allowed_formats))
    {
      throw new InvalidArgumentException(sprintf('Invalid format "%s"', $format));
    }
    $this->_format = $format;
  }
  
  /**
   * Get the output format for this query
   *
   * @return string
   */
  public function getFormat()
  {
    return $this->_format;
  }
  
  /**
   * Build and return the URL for this query
   *
   * @return string
   */
  public function buildUrl()
  {
    $url = $this->getUrlFormat();
    $url = strtr($url, array(
      '%format%' => $this->getFormat(),
    ));
    $parameters = $this->getParameters();
    $query_string = http_build_query($parameters);
    if ($query_string)
    {
      $url .= '?' . $query_string;
    }
    return $url;
  }
  
  /**
   * Get the "user id" parameter
   *
   * @return integer
   */
  public function getUserId()
  {
    return $this->getParameter(self::PARAM_USER_ID);
  }

  /**
   * Set the "user id" parameter
   *
   * @param integer $v
   */
  public function setUserId($v)
  {
    $this->setParameter(self::PARAM_USER_ID, $v);
  }
  
  /**
   * Get the "screen name" parameter
   *
   * @return string
   */
  public function getScreenName()
  {
    return $this->getParameter(self::PARAM_SCREEN_NAME);
  }

  /**
   * Set the "screen name" parameter
   *
   * @param string $v
   */
  public function setScreenName($v)
  {
    $this->setParameter(self::PARAM_SCREEN_NAME, $v);
  }
  
  /**
   * Get the "count" parameter
   *
   * @return integer
   */
  public function getCount()
  {
    return $this->getParameter(self::PARAM_COUNT);
  }
  
  /**
   * Set the "count" parameter
   *
   * @param integer $v
   */
  public function setCount($v)
  {
    $this->setParameter(self::PARAM_COUNT, $v);
  }
  
  /**
   * Set the "include retweets" parameter
   *
   * @param integer $v
   */
  public function setIncludeRetweets($v)
  {
    $this->setParameter(self::PARAM_INCLUDE_RTS, ($v ? '1' : '0'));
  }
  
  /**
   * Get the "include retweets" parameter
   *
   * @return boolean
   */
  public function getIncludeRetweets()
  {
    return ($this->getParameter(self::PARAM_INCLUDE_RTS) ? true : false);
  }
  
  /**
   * Set the "include entities" parameter
   *
   * @param integer $v
   */
  public function setIncludeEntities($v)
  {
    $this->setParameter(self::PARAM_INCLUDE_ENTITIES, ($v ? '1':'0'));
  }
  
  /**
   * Get the "include entities" parameter
   *
   * @return boolean
   */
  public function getIncludeEntities()
  {
    return ($this->getParameter(self::PARAM_INCLUDE_ENTITIES) ? true : false);
  }
}
