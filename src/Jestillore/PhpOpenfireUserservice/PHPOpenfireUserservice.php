<?php

namespace Jestillore\PhpOpenfireUserservice;

class PHPOpenfireUserservice {

	public static AUTH_BASIC = 1;
	public static AUTH_SHARED_KEY = 2;

	/*
		openfire details
	*/
	private $endpoint;
	private $authType;
	private $username;
	private $password;
	private $key;

	private $curl;

	public function __construct() {
		$this->curl = new \anlutro\cURL\cURL;
	}

	public function setEndpoint ($endpoint) {
		$this->endpoint = $endpoint;
		return $this;
	}

	public function setAuthType ($authType) {
		$this->authType = $authType;
		return $this;
	}

	public function setUsername ($username) {
		$this->username = $username;
		return $this;
	}

	public function setPassword ($password) {
		$this->password = $password;
		return $this;
	}

	public function setSharedKey ($key) {
		$this->key = $key;
		return $this;
	}

	// Authorization header value based on selected authentication type
	private function getAuthorization() {
		switch ($this->authType) {
			case self::AUTH_BASIC:
				return 'Basic ' . base64_encode("$this->username:$this->password");
			case self::AUTH_SHARED_KEY:
				return $this->key;
		}
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
