<?php
class doGitHubApi {

    private $access_token;

    public function authenticate($access_token) {
        $this->access_token = $access_token;
    }

    public function deAuthenticate() {
        $this->access_token = null;
    }

    protected function getData($apiPath) {
        $url = 'https://github.com/api/v2/json'.$apiPath;

        if (isset($this->access_token)) {
            $url .= '?access_token='.$this->access_token;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER,  0);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
    
    public function searchUsers($username) {
        return $this->getData('/user/search/'.$username);
    }

    public function searchUsersByEmail($email) {
        return $this->getData('/user/email/'.$email);
    }

    public function getUserInfo($username) {
        return $this->getData('/user/show/'.$username);
    }

    public function getSelfInfo() {
        return $this->getData('/user/show');
    }

    public function getUserFollowing($username) {
        return $this->getData('/user/show/'.$username.'/following');
    }

    public function getUserFollowers($username) {
        return $this->getData('/user/show/'.$username.'/followers');
    }

    public function getUserWatchedRepos($username) {
        return $this->getData('/repos/watched/'.$username);
    }

}