<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @package     CodeIgniter Admin
 * @author        Danny Nunez
 * @copyright  Copyright (c) 2013 Danny Nunez
 */
// ------------------------------------------------------------------------
include APPPATH . 'third_party/phpass/Phpass.php';

use Phpass\Hash;
use Phpass\Hash\Adapter\Bcrypt;

class Authentication extends MY_Controller {

    function __construct() {

        parent::__construct();

//        $this->load->helper();
//        $this->load->library();
        $this->load->library(array('form_validation'));
        $this->load->model(array('auth_model'));
    }

    public function verifyLogin($data) {
        $crypt = new Hash();
        $model = new Auth_model();
        if ($this->form_validation->valid_email($data['email']) === true && $model->emailExists($data['email'])) {
            $account = $model->get_by('email', $data['email']);
            if ($crypt->checkPassword($data['password'], $account->password)) {
                return $account;
            } else {
                return false;
            }
        }
        return false;
    }

    public function logout($session) {

        $model = new Auth_model();
        // reset the following to null to prevent hacking attempts. These values are used when verifying a user is loged in. 
        $data = array(
            'last_ip' => null,
            'sessionID' => null,
            'last_login' => null
        );
        // update user record
        $result = $model->update($session['user_data'], $data);
        //return boolean
        return $result;
      
    }

    /**
     * @Description - Verify the current cookie session data is of a person who is logged. 
     * @todo - add in check to verify the ipaddress - Can do that since SVN is broken
     * @return boolean
     */
    public function is_logged_in() {

        $session = $this->session->all_userdata();
        $model = new Auth_model();
        if (isset($session['user_data'])) {
            $userData = $model->get($session['user_data']);
            if ($userData->last_login == $session['last_activity'] && $userData->sessionID == $session['session_id']) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function reset_password($email = '', $code = '') {
        
    }

    public function restrict() {
        
    }

    //--------------------------------------------------------------------
    // !UTILITY METHODS
    //--------------------------------------------------------------------

    public function user_id() {
        
    }

    public function role_id() {
        
    }

    public function has_permission() {
        
    }

    public function permission_exists($permission) {
        
    }

    private function load_permissions() {
        
    }

    private function load_role_permissions($role_id = NULL) {
        
    }

    public function role_name_by_id($role_id) {
        
    }

    protected function increase_login_attempts($login) {
        
    }

    protected function clear_login_attempts($login, $expires = 86400) {
        
    }

    protected function num_login_attempts($login = NULL) {
        
    }

}