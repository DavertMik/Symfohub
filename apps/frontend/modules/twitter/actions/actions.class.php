<?php

/**
 * twitter actions.
 *
 * @package    symfohub
 * @subpackage twitter
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class twitterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->twitter_tweets = $this->getRoute()->getObjects();
  }

}
