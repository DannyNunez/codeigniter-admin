<?php defined('BASEPATH') OR exit('No direct script access allowed');

function years(){$years = array();
	for($i = 1900; $i <= date('Y'); $i++){
		$years[$i] = $i;
	}
	return $years;
}


function days(){
	$days = array();
	for($i = 1; $i <= 31; $i++){
		$days[$i] = $i;
	}
	return $days;
}

function months(){
	$months = array();
	for($i = 1; $i <= 12; $i++){
		$months[$i] = $i;
	}
	return $months;
}