<?php

namespace Jestillore\PhpOpenfireUserservice;

class PHPOpenfireUserservice {

	private $_curl;

	public function __construct() {
		$this->_curl = new \anlutro\cURL\cURL;
	}

	private function request ($method, $url, $data = []) {

	}

	public function getAllUsers () {
		/**
		* TODO
		*/
	}

	public function getUser ($username) {
		/**
		* TODO
		*/
	}

	public function createUser ($user) {
		/**
		* TODO
		*/
	}

	public function deleteUser ($username) {
		/**
		* TODO
		*/
	}

	public function updateUser ($username, $user) {
		/**
		* TODO
		*/
	}

	public function lockUser ($username) {
		/**
		* TODO
		*/
	}

	public function unlockUser ($username) {
		/**
		* TODO
		*/
	}

	public function getUserGroups ($username) {
		/**
		* TODO
		*/
	}

	public function addUserToGroups ($username, $groups) {
		/**
		* TODO
		*/
	}

	public function removeUserFromGroups ($username, $groups) {
		/**
		* TODO
		*/
	}

	public function getUsersByProperty ($key, $value) {
		/**
		* TODO
		*/
	}

	public function getRoster ($username) {
		/**
		* TODO
		*/
	}

	public function addRosterEntry ($username, $roster) {
		/**
		* TODO
		*/
	}

	public function deleteRosterEntry ($username, $jid) {
		/**
		* TODO
		*/
	}

	public function updateRosterEntry ($username, $jid, $roster) {
		/**
		* TODO
		*/
	}

	public function test() {
		return $this->_curl->get('http://www.google.com');
	}

}
