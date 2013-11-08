<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class themeHelper extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('auth_model'));
    }

    function getUserName($id) {
        $user = new auth_model();
        return $user->getUserName($id);
    }

    function getAvatar($id) {
        $user = new auth_model();
        return $user->getUserAvatar($id);
    }

}
