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
 * Profile Controller
 *
 * Manages the user functionality on the admin pages.
 *
 * @package    Community Site
 * @subpackage admin
 * @category   Controllers
 * @author     Danny Nunez
 *
 */
class Profile extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model(array('auth_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'Authentication','Gravatar'));

        if (!$this->authentication->is_logged_in()) {
            redirect('login');
        }
    }

    function profile_get() {

        $profile = $this->auth_model->get($this->session->has_userdata('user_data'));

        $data = array(
            'path' => 'profile',
            'profile' => $profile,
            'content' => 'admin/user/profile'
        );

        if ($this->session->tempdata('message') != '') {
            $data['message'] = $this->session->tempdata('message');
            $this->session->unset_tempdata('message');
        }

        $this->load->view($this->config->item('admin_theme_path'), $data);
        
    }

    function profile_post() {

        $results = $this->auth_model->updateProfile($this->session->userdata('user_data'), $this->input->post(NULL, TRUE));

        if ($results) {
            // provide a message to acknowlegde their profile was updated
            $this->session->set_flashdata($this->config->item('profile_update_successfull'), '', 30);
            // send to the profile page
            redirect('profile');
        } else {
            // provide a message to acknowlegde their profile was not updated successfully
            $this->session->set_tempdata($this->config->item('profile_update_unsuccessfull'), '', 30);
            // send to the profile page
            redirect('profile');
        }
    }

}
