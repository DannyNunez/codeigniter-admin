<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Permissions Controller
 * 
 * @package     Community Site
 * @subpackage admin
 * @author        Danny Nunez
 * @copyright  Copyright (c) 2013 - 2014 Danny Nunez
 * @since        Version 0.1
 * @filesource
 * 
 */
class Permissions extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper(array('form', 'url', 'permission_helper'));
        $this->load->library(array('form_validation', 'Authentication'));
        $this->load->model(array('permission_model', 'status_model'));

        if (!$this->authentication->is_logged_in()) {
            redirect('login');
        }
    }

    public function index_get() {

        $permissions = new permission_model();

        $data = array(
            'permissions' => $permissions->get_all(),
            'content' => 'admin/permissions/permissions',
        );

        if ($this->session->tempdata('message') != '') {
            $data['message'] = $this->session->tempdata('message');
             $this->session->unset_tempdata('message');
        }

        $this->load->view($this->config->item('admin_theme_path'), $data);
    }

    public function add_get() {

        $status = new status_model();
        $permission = new permission_helper();

        $data = array(
            'path' => 'settings/permissions/add',
            'statusOptions' => $status->get_all(),
            'permission' => $permission->defaultSettings(),
            'content' => 'admin/permissions/form',
        );

        // See if a message is set in the cookie - used for adding message to a page
        if ($this->session->tempdata('message') != '') {
            $data['message'] = $this->session->tempdata('message');
            $this->session->unset_tempdata('message');
        }

        $this->load->view($this->config->item('admin_theme_path'), $data);
    }

    public function add_post() {

        $permission = new permission_helper();

        $data = $permission->filter($this->input->post(NULL, TRUE));

        if (is_array($data)) {
            $permissions = new permission_model();
            $permissions->insert($data);
            // provide a message to acknowlegde the permission was not added successfully
            $this->session->set_tempdata($this->config->item('add_permission_successful'), '', 15);
            // send to the profile page
            redirect('settings/permissions');
        } else {
            // provide a message to acknowlegde the permission was not added successfully
            $this->session->set_tempdata($this->config->item('add_permission_error'), '', 15);
            // send to the profile page
            redirect('settings/permissions/add');
        }
    }

}
