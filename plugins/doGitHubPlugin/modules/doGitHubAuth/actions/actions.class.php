<?php

/**
 * info actions.
 *
 * @package    begrouped
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class doGitHubAuthActions extends sfActions {

  public function executeLogin(sfWebRequest $request) {
    $this->getUser()->setAttribute('doGithub_redirect_path', $request->getReferer());
    $url = 'https://github.com/login/oauth/authorize'
          .'?client_id='.sfConfig::get('doGitHubPlugin_client_id')
          .'&redirect_uri='.sfConfig::get('doGitHubPlugin_redirect_url');
    $this->redirect($url);
  }

  public function executeAuthorized(sfWebRequest $request) {
    $code = $request->getParameter('code');

    $url = 'https://github.com/login/oauth/access_token';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'client_id' => sfConfig::get('doGitHubPlugin_client_id'),
        'redirect_uri' => sfConfig::get('doGitHubPlugin_redirect_url'),
        'client_secret' => sfConfig::get('doGitHubPlugin_client_secret'),
        'code' => $code,
    ));
    $response = curl_exec($ch);
    curl_close($ch);

//    echo $response; die();

    if (preg_match('/access_token=([0-9a-f]+)(&|$)/u', $response, $matches)) {
        $token = $matches[1];
        $this->getUser()->signIn($token);
        $this->redirect($this->getUser()->getAttribute('doGithub_redirect_path', '@homepage'));
    }
    $this->forward('main','authError');
//    return $this->renderText($response);
//    $this->getUser()->setFlash('error','Error logging in');
//    $this->redirect($this->getUser()->getAttribute('doGithub_redirect_path', '@homepage'));

    
  }

  public function executeLogout(sfWebRequest $request) {
    $this->getUser()->signOut();
    $this->redirect($this->getUser()->getAttribute('doGithub_redirect_path', '@homepage'));
  }
}
