<?php


class User {
	private $db;

	public __construct(Database $db) {
	$this->db = $db;
	}

	public function register($data) {
		//unimplemented
		//
		//
	}

	public function login($username, $password) {
		//unimplemented
	}

	public function findUserByEmail($email) {
		//unimplemented
	}
}

