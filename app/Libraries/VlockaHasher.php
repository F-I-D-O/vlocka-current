<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libraries;

use Illuminate\Contracts\Hashing\Hasher;

/**
 * Description of VlockaHasher
 *
 * @author F.I.D.O.
 */
class VlockaHasher implements Hasher{
	public function check($value, $hashedValue, array $options = array()) {
//		var_dump(hex2bin(sha1($value)));
//		var_dump($hashedValue);
//		var_dump((hex2bin(sha1($value)) === $hashedValue));
//		die($value);
		
		return (hex2bin(sha1($value)) === $hashedValue);
	}

	public function make($value, array $options = array()) {
		return hex2bin(sha1($value));
	}

	public function needsRehash($hashedValue, array $options = array()) {
		
	}

//put your code here
}
