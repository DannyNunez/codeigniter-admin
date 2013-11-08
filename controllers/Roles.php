<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @package     Community Site
 * @author        Danny Nunez
 * @copyright  Copyright (c) 2013 - 2014 Danny Nunez
 * @since        Version 0.1
 * @filesource
 * 
 */
// ------------------------------------------------------------------------

/**
 * Settings Controller
 *
 * Manages the user functionality on the admin pages.
 *
 * @package    Community Site
 * @subpackage admin
 * @category   Controllers
 * @author     Danny Nunez
 *
 */
class Roles extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'Authentication'));
        $this->load->model(array('role_model'));

        if (!$this->authentication->is_logged_in()) {
            redirect('login');
        }
    }

    public function index_get() {

        $roleModel = new role_model();

        $data = array(
            'roles' => $roleModel->get_all(),
            'content' => 'admin/roles/roles',
        );

        if ($this->session->tempdata('message') != '') {
            $data['message'] = $this->session->tempdata('message');
        }

        $this->load->view($this->config->item('admin_theme_path'), $data);
    }

    public function edit_get() {

        $roleModel = new role_model();

        $data = array(
            'role' => $roleModel->get($this->uri->segment(3)),
            'content' => 'admin/roles/edit_role',
        );

        if ($this->session->tempdata('message') != '') {
            $data['message'] = $this->session->tempdata('message');
        }

        $this->load->view($this->config->item('admin_theme_path'), $data);
    }
    
}