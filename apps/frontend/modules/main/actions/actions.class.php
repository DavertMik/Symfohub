<?php

/**
 * main actions.
 *
 * @package    symfohub
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {

  }
  
  public function executeAuthError() {
      
  }
  
  public function executeError404() {
      
  }
  

//  public function executeauthorize(sfwebrequest $request) {
//    $this->getuser()->setauthenticated(true);
//    $this->getuser()->setattribute('id',1);
//    $this->getuser()->setattribute('is_admin', true);
//    $this->getuser()->setattribute('username','davertmik');
//    $this->redirect($this->getuser()->getattribute('dogithub_redirect_path', '@home'));
//  }
}
