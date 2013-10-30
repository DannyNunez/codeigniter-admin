<?php defined('BASEPATH') OR exit('No direct script access allowed');

class auth_model extends MY_Model
{
        protected $_table = 'users';

    function __construct()
    {
        parent::__construct();
    }
    
    
    function emailExists($email){
        if($this->count_by('email' , $email) > 0){
            return true;
        }else{
            return false;
        }
    }
    
}