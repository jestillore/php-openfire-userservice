<?php

namespace Jestillore\PhpOpenfireUserservice;

class Response {

	private $success;
	private $message;

	public function __construct($success = true, $message = []) {
		$this->success = $success;
		$this->message = $message;
	}

	public function isSuccess() {
		return $this->success;
	}

	public function getMessage() {
		return $this->message;
	}

}
