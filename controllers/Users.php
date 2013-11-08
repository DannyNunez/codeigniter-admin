<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 *
 * @package     Community Site
 * @author        Danny Nunez
 * @copyright  Copyright (c) 2013 - 2014 Danny Nunez
 * @since        Version 0.1
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Users Controller
 *
 * Manages the user functionality on the admin pages.
 *
 * @package    Community Site
 * @subpackage admin
 * @category   Controllers
 * @author     Danny Nunez
 *
 */
include APPPATH . 'third_party/phpass/Phpass.php';
include APPPATH . 'third_party/recaptchalib.php';

use Phpass\Hash;
use Phpass\Hash\Adapter\Bcrypt;

class Users extends MY_Controller {

    private $publickey = "6LeVJukSAAAAALueCB_4FjU4zmcBYyN0ejPN8IDz";
    private $privatekey = "6LeVJukSAAAAAHPQzkYDrohwL73YAvbEBgHOQK4g";

    function __construct() {

        parent::__construct();

//        $this->load->helper();
        $this->load->model(array('auth_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'Authentication', 'Gravatar'));
    }

    public function login_get() {

//--------------------------------------------------------------------
// Check if user login is allowed 
//--------------------------------------------------------------------

        if (!$this->config->item('user_login')) {
            redirect('/');
        }

//-----------------------------------------------------------------------------------------------------------------
//  Add error message if being redirected by database error see $this->login_post
//-----------------------------------------------------------------------------------------------------------------

        if ($this->uri->segment(2) === 'error') {
            $data = array('error_message' => $this->config->item('user_login_error_message'));
        }

        $data['path'] = 'register/login';
        $data['content'] = 'admin/user/login';
        $this->load->view($this->config->item('theme_path_home'), $data);
    }

    public function login_post() {

        //--------------------------------------------------------------------
        // Check if user registration is allowed 
        //--------------------------------------------------------------------

        if (!$this->config->item('user_login')) {
            redirect('/');
        }

        //--------------------------------------------------------------------
        //  Redirect if post is empty
        //--------------------------------------------------------------------

        if ($this->input->post(NULL, TRUE) === false) {
            redirect('/');
        }

        //--------------------------------------------------------------------
        //  Check User Name and Password
        //-------------------------------------------------------------------- 

        $results = $this->authentication->verifyLogin($this->input->post(NULL, TRUE));


        if ($results === false) {
            redirect('login/error');
        } else {

            $session_data = array(
                'user_data' => $results->id,
                'last_activity' => time()
            );
            
            //--------------------------------------------------------------------
            //  set session data 
            //--------------------------------------------------------------------

            $this->session->set_userdata($session_data);

            //------------------------------------------------------------------------------
            //  Check Permissions - Redirect to appropriate location
            //------------------------------------------------------------------------------
            // update the user database record 
            $this->auth_model->updateLogin($results->id, $this->session->all_userdata());

            //------------------------------------------------------------------------------
            //  Check Permissions - Redirect to appropriate location
            //------------------------------------------------------------------------------
            //$groups = $this->authentication->usergroups(); 
            // redirect to the user profile page
            redirect('profile');
        }
    }

    public function logout_get() {

        // update user record to eliminate session data
        $this->authentication->logout($this->session->all_userdata());
        // deleate cookie and record in session table
        $this->session->sess_regenerate(true);
        // provide a message to acknowlegde the use logged out     
        $this->session->set_tempdata($this->config->item('logout_message'), '', 30);
        // send to the homepage
        redirect('/');
    }

    public function forgot_password() {
        
    }

    public function register_get() {

        //--------------------------------------------------------------------
        // Check if user registration is allowed 
        //--------------------------------------------------------------------

        if (!$this->config->item('registration_status')) {
            redirect('/');
        }

        //-----------------------------------------------------------------------------------------------------------------
        //  Add error message if being redirected by database error see $this->register_post
        //-----------------------------------------------------------------------------------------------------------------

        if ($this->uri->segment(2) === 'error') {
            $data = array('error_message' => $this->config->item('user_reg_error_message'));
        }

        $data['path'] = 'register';
        $data['captcha'] = recaptcha_get_html($this->publickey);
        $data['content'] = 'admin/user/register_user_front';

        $this->load->view($this->config->item('theme_path_home'), $data);
    }

    public function register_post() {

//--------------------------------------------------------------------
// Check if user registration is allowed 
//--------------------------------------------------------------------

        if (!$this->config->item('registration_status')) {
            redirect('/');
        }

//--------------------------------------------------------------------
// Form Validation Rules 
//--------------------------------------------------------------------

        $this->form_validation->set_rules('firstName', 'firstName', 'callback_firstName_check');
        $this->form_validation->set_rules('lastName', 'lastName', 'callback_lastName_check');
        $this->form_validation->set_rules('email', 'email', 'callback_email_check');
        $this->form_validation->set_rules('password', 'password', 'callback_password_check');
        $this->form_validation->set_rules('passConf', 'passConf', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'callback_birthday_check');
        //$this->form_validation->set_rules('recaptcha_response_field', 'recaptcha_response_field', 'callback_recaptcha_response_field_check');
        
        //--------------------------------------------------------------------
        //  If the the validation returns true and the user data and the email account does not exist add new user. 
        //--------------------------------------------------------------------

        if ($this->form_validation->run() !== FALSE && !$this->auth_model->emailExists($this->input->post('email'))) {
            // generate salt - Not if we will use this
            $crypt = new Hash;
            $bcrypt = new Bcrypt;
            $userSalt = $bcrypt->genSalt();
            // Get Gravatar image link
            $gravatar = new Gravatar();
            $gravatar->setDefaultImage('mm')->setAvatarSize(150);
            $gravatar->setMaxRating('pg');
            $avatar = $gravatar->buildGravatarURL($this->input->post('email'));

//            echo "</pre>";
//            var_dump($avatar);
//            echo "</pre>";
//            exit();

            $data = array(
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('firstName') . ' ' . $this->input->post('lastName'),
                'password' => $crypt->hashPassword($this->input->post('password')),
                'salt' => $userSalt,
                'activation_code' => $userSalt,
                'birthday' => date('Y-m-d', strtotime($this->input->post('birthday'))),
                'last_ip' => $_SERVER['REMOTE_ADDR'],
                'created_on' => date('Y-m-d'),
                'gravatar' => $avatar
            );
        }

//--------------------------------------------------------------------------------------
//  Insert New User
//--------------------------------------------------------------------------------------

        $result = $this->auth_model->insert($data);

        echo "<pre>";
        print_r($data);
        echo "<pre>";
        exit();

//--------------------------------------------------------------------------------------
//  Send Email with User Info and Link to activate the account
//--------------------------------------------------------------------------------------

        if ($result === false) {
            redirect('register/error');
        } else {

//--------------------------------------------------------------------------------------
//  Send Email with User Info and Link to activate the account
//--------------------------------------------------------------------------------------
//  Write E-Mail Code 
//--------------------------------------------------------------------------------------
//  Redirect to urser profile page
//--------------------------------------------------------------------------------------

            $path = 'user/profile/' . $result;
            redirect($path);
        }
    }

//-------------------------END register_post()-------------------------------------------//

    private function save_user($id = 0, $meta_fields = array()) {
        
    }

    public function activate($user_id = NULL) {
        
    }

    public function resend_activation() {
        
    }

//--------------------------------------------------------------------
// Form Validation Callbacks
//--------------------------------------------------------------------

    function firstName_check($firstName) {

        if ($firstName == '') {
            $this->form_validation->set_message('firstName_check', 'Your first name is required.');
            return FALSE;
        }

        if ($this->form_validation->alpha($firstName)) {
            return true;
        } else {
            $this->form_validation->set_message('firstName_check', 'Your first name may only contain alphabetical characters.');
            return FALSE;
        }
    }

    function lastName_check($lastName) {

        if ($lastName == '') {
            $this->form_validation->set_message('lastName_check', 'Your last name is required.');
            return FALSE;
        }

        if ($this->form_validation->alpha($lastName)) {
            return true;
        } else {
            $this->form_validation->set_message('lastName_check', 'Your last name may only contain alphabetical characters.');
            return FALSE;
        }
    }

    function birthday_check() {

        if ($this->input->post('birthday') == '') {
            $this->form_validation->set_message('birthday_check', 'Your birthdate is required.');
            return FALSE;
        }

        $date = new DateTime($this->input->post('birthday'));
        $now = new DateTime();
        $age = $now->diff($date);

        if ($age->y >= 18) {
            return true;
        } else {
            $this->form_validation->set_message('birthday_check', 'You must be 18 years of age to use this service.');
            return FALSE;
        }
    }

    function password_check() {

// verify the password is not empty

        if ($this->input->post('password') == '') {
            $this->form_validation->set_message('password_check', 'The password field is required.');
            return FALSE;
        }

// Verify the password match the password confirmation field       
        if ($this->input->post('password') === $this->input->post('passConf') && $this->valid_pass($this->input->post('password')) === true) {
            return true;
        } else {
            $this->form_validation->set_message('password_check', 'Your password did not meet the minimum requirements or did not match the password confirmation field.');
            return FALSE;
        }
    }

    /**
     * 
     * @param string $candidate
     * @return boolean 
     */
    function valid_pass($candidate) {

        $r1 = '/[A-Z]/';  //Uppercase
        $r2 = '/[a-z]/';  //lowercase
        $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
        $r4 = '/[0-9]/';  //numbers

        if (preg_match_all($r1, $candidate, $o) < 2)
            return FALSE;

        if (preg_match_all($r2, $candidate, $o) < 2)
            return FALSE;

        if (preg_match_all($r3, $candidate, $o) < 2)
            return FALSE;

        if (preg_match_all($r4, $candidate, $o) < 2)
            return FALSE;

        if (strlen($candidate) < 8)
            return FALSE;

        return TRUE;
    }

    function recaptcha_response_field_check($captcha) {

        $resp = recaptcha_check_answer($this->privatekey, $_SERVER["REMOTE_ADDR"], $this->input->post('recaptcha_challenge_field'), $captcha);

        if (!$resp->is_valid) {
// What happens when the CAPTCHA was entered incorrectly
            $this->form_validation->set_message('recaptcha_response_field_check', 'The Captcha entered was incorrect.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function email_check($email) {

// verify the password is not empty

        if ($this->input->post('email') == '') {
            $this->form_validation->set_message('email_check', 'The email field is required.');
            return FALSE;
        }

//&& $this->Auth_model->emailExists($email) != true
        if ($this->form_validation->valid_email($email)) {
            return true;
        } else {
            $this->form_validation->set_message('email_check', 'The email address entered was invalid or already exists.');
            return FALSE;
        }
    }

//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";
//            exit();   
}
