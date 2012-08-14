<?php

class doGitHubSecurityUser extends sfBasicSecurityUser {

  /**
   * @var \Github\Client
   */
  protected $client = null;

  protected $user = null;

  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()) {
    parent::initialize($dispatcher, $storage, $options);

    $this->client = new \Github\Client();

    if ($this->isAuthenticated()) {
      $this->client->authenticate(
        null,
        $this->getAttribute('access_token', null, 'doGitHubUser'),
          \Github\Client::AUTH_HTTP_TOKEN
      );
    }
    else {
      // remove user if timeout
      $this->getAttributeHolder()->removeNamespace('doGitHubUser');
    }
  }


  /**
   * Signs in the user on the application.
   *
   * @param string $access_token
   * @param boolean $remember Whether or not to remember the user
   * @param Doctrine_Connection $con A Doctrine_Connection object
   */
  public function signIn($access_token, $remember = false, $con = null) {

    $this->client->authenticate(null, $access_token, \Github\Client::AUTH_HTTP_TOKEN);
    $info = $this->client->api('current_user')->show();
    $login = $info['login'];
    if (!($user = Doctrine::getTable('doGitHubUser')->findOneByUsername($login))) {
        $user = new doGitHubUser();
        $user->username = $login;
        $user->save();
    }

    // signin
    $this->setAuthenticated(true);

    $this->user = $user;

    $this->setAttribute('id',           $user->id,     'doGitHubUser');
    $this->setAttribute('access_token', $access_token, 'doGitHubUser');

    // remember?
    if ($remember) {

      // remove old keys
      Doctrine::getTable('doGitHubRemember')->createQuery()
        ->delete()
        ->where('user_id = ?', $user->id)
        ->execute();

      // generate new keys
      $key = $this->generateRandomKey();

      // save key
      $rk = new doGitHubRemember();
      $rk->remember_key = $this->generateRandomKey();
      $rk->user_id = $this->user->id;
      $rk->access_token = $access_token;
      $rk->save($con);

      // make key as a cookie
      $remember_cookie = sfConfig::get('app_do_github_plugin_remember_cookie_name', 'sfRemember');
      sfContext::getInstance()->getResponse()->setCookie(
          $remember_cookie,
          $key,
          time() + sfConfig::get('app_do_github_plugin_remember_key_expiration_age', 15 * 24 * 3600)
      );
    }
  }

  /**
   * Signs out the user.
   *
   */
  public function signOut() {
    $this->getAttributeHolder()->removeNamespace('doGitHubUser');
    $this->user = null;
    $this->client = new \Github\Client();
    $this->setAuthenticated(false);
    $remember_cookie = sfConfig::get('app_do_github_plugin_remember_cookie_name', 'sfRemember');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', -1);
  }

  public function getGitHubUser() {
    if (!$this->user && ($id = $this->getAttribute('id', null, 'doGitHubUser'))) {
      $this->user = Doctrine::getTable('doGitHubUser')->find($id);

      if (!$this->user) {
        // the user does not exist anymore in the database
        $this->signOut();
        throw new sfException('The user does not exist anymore in the database.');
      }
    }

    return $this->user;
  }

  /**
   * Returns the doGitHubUser object's username.
   *
   * @return string
   */
  public function getUsername() {
    if (!$this->isAuthenticated()) return false;
    return $this->getGitHubUser()->username;
  }

  /**
   * Returns GitHub API object
   *
   * @return \Github\Client
   */
  public function getGithubClient() {
      return $this->client;
  }

}
