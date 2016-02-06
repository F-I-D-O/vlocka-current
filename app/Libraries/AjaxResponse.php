<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libraries;

/**
 * Description of Response
 *
 * @author F.I.D.O.
 */
class AjaxResponse {

	public $success;
	public $succesMessage;
	public $errorMessages;
	public $data;
	
	public function __construct($successMessage) {
		$this->success = TRUE;
		$this->succesMessage = $successMessage;
	}
	
	public function addError($error){
		if(!$this->errorMessages){
			$this->errorMessages = [$error];
			$this->success = FALSE;
			$this->succesMessage = NULL;
		}
		else{
			$this->errorMessages[] = $error;
		}
	}

}
