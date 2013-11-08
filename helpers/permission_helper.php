<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class permission_helper extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * @description Provides default info for the form to allow using the same form for adding and editing.
     * @return \stdClass
     */
    
    public function defaultSettings(){
        
        $permission = new stdClass();  
        $permission->name = '';
        $permission->description = '';
        $permission->status = 1;
        return $permission;
        
    }
    
    public function filter($data){
        
        if($data === null){
            return false;
        }else{
            foreach($data as $key => $value){
                $data[$key] = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            }
            return $data;
        }

    }

}