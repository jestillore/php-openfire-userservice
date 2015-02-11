<?php

namespace Jestillore\PhpOpenfireUserservice;

use SimpleXMLElement;

class PHPOpenfireUserservice {

	const AUTH_BASIC = 1;
	const AUTH_SHARED_KEY = 2;

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
		switch ($method) {
			case 'post':
			case 'put':
				$c = $this->curl->newRawRequest($method, 
					$this->endpoint . $url , $this->arrayToXML($data));
				$c->setHeader('Content-Type', 'application/xml');
				break;
			case 'get':
			case 'delete':
				$c = $this->curl->newRequest($method, $this->endpoint . $url);
				break;
		}
		$c->setHeader('Authorization', $this->getAuthorization());
		return $c->send();
	}

	public function getAllUsers () {
		$users = $this->xmlToArray($this->request('get', '/users'));
		return $users['user'];
	}

	public function getUser ($username) {
		$json = $this->xmlToArray($this->request('get', '/users/' . $username));
		return $json;
	}

	public function createUser ($user) {
		$xml = $this->request('post', '/users', ['user' => $user]);
		$res = $xml->body;
		if(is_bool($res))
			return new Response(true);
		return new Response(false, $this->xmlToArray($res));
	}

	public function deleteUser ($username) {
		$xml = $this->request('delete', '/users/' . $username);
		$res = $xml->body;
		if(is_bool($res))
			return new Response(true);
		return new Response(false, $this->xmlToArray($res));
	}

	public function updateUser ($username, $user) {
		$xml = $this->request('put', '/users/' . $username, ['user' => $user]);
		$res = $xml->body;
		if(is_bool($res))
			return new Response(true);
		return new Response(false, $this->xmlToArray($res));
	}

	public function lockUser ($username) {
		$xml = $this->request('post', '/users/lockouts/' . $username, ['user' => []]);
		$res = $xml->body;
		if(is_bool($res))
			return new Response(true);
		return new Response(false, $this->xmlToArray($res));
	}

	public function unlockUser ($username) {
		$xml = $this->request('delete', '/users/lockouts/' . $username);
		$res = $xml->body;
		if(is_bool($res))
			return new Response(true);
		return new Response(false, $this->xmlToArray($res));
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

	private static function arrayToXML($data) {
		//get root element
		$root = '';
		foreach($data as $key => $value) {
			$root = $key;
			break;
		}

		$xml = new SimpleXMLElement('<?xml version="1.0"?><' . $root . '></' . $root . '>');

		$data = $data[$root];

		function array_to_xml($d, &$x) {
		    foreach($d as $key => $value) {
		        if(is_array($value)) {
		            if(!is_numeric($key)){
		                $subnode = $x->addChild("$key");
		                array_to_xml($value, $subnode);
		            }
		            else{
		                $subnode = $x->addChild("item$key");
		                array_to_xml($value, $subnode);
		            }
		        }
		        else {
		            $x->addChild("$key",htmlspecialchars("$value"));
		        }
		    }
		}

		array_to_xml($data, $xml);

		return $xml->asXML();
	}

	private static function xmlToArray($xml) {
		$xml = simplexml_load_string($xml);
		$json = json_encode($xml);
		$array = json_decode($json, TRUE);
		return $array;
	}

}
