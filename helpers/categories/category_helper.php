<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class category_helper extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

 
    public function defaultSettings()
    {
        $catgory = new stdClass();
        $catgory ->name = '';
        return $catgory ;
    }

    public function filter($catgory)
    {

        $data = array(
            'name' => $catgory['name'],
        );

        return $data;
        
    }

}