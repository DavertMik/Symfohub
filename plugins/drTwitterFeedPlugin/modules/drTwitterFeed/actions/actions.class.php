<?php
class drTwitterFeedActions extends sfActions
{
  public function executeStatusUserTimeline(sfWebRequest $request)
  {
    $this->query_parameters = array();
    
    if ($request->hasParameter('screen_name'))
    {
      $this->query_parameters['screen_name'] = $request->getParameter('screen_name');
    }
    else if ($request->hasParameter('user_id'))
    {
      $this->query_parameters['user_id'] = $request->getParameter('user_id');
    }
    
    $this->parameters = array(
      'limit' => 5,
      'query_parameters' => $this->query_parameters,
    );
  }
}
