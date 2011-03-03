<?php

class myUser extends doGitHubSecurityUser {

  public function signIn($access_token, $remember = false, $con = null) {
    parent::signIn($access_token, $remember, $con);
    $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($this->user->email))) . "?s=40";
    $this->setAttribute('avatar', $grav_url);
    $this->setAttribute('username', $this->user->username);
    $this->setAttribute('id', $this->user->id);
    $this->setAttribute('is_admin', $this->user->is_admin);
  }

  public function isAdmin() {
    return ($this->isAuthenticated() && $this->getAttribute('is_admin', '', false));
  }

  public function getId() {
   return $this->getAttribute('id');
  }

}
