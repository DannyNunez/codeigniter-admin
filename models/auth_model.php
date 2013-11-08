<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class auth_model extends MY_Model {

    protected $_table = 'users';

    function __construct() {
        parent::__construct();
    }

    function emailExists($email) {
        if ($this->count_by('email', $email) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getSalt($email) {

        $this->db->select('salt');
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        return $query;
    }

    public function updateLogin($id, $session) {

        $data = array(
            'last_login' => $session['last_activity'],
            'sessionID' => $session['session_id'],
            'last_ip' => $session['ip_address']
        );

        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
    }

    public function updateProfile($id, $data) {

        $filteredData = array();
        foreach ($data as $key => $value) {
            $filteredData[$key] = strip_tags($value);
        }

        if ($this->update($id, $filteredData)) {
            return true;
        } else {
            return false;
        }
    }

    function getUserName($id) {
        
        $this->db->select('username');
        $this->db->where('id', $id);
        $user = $this->db->get($this->_table);
        
        return $user->username;
        
    }

    function getGravatar($id) {
        
        $this->db->select('gravatar');
        $this->db->where('id', $id);
        $avatar = $this->db->get($this->_table);
        
        return $avatar->gravatar;
    }

}