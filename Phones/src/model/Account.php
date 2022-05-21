<?php

class Account {

	private $name;
	private $login;
	private $mdp;

	public function __construct($name,$login,$mdp){
		$this->name = $name;
		$this->login = $login;
		$this->mdp = $mdp;
	}

	//GETTEURS
	public function getName(){
		return $this->name;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getMdp(){
		return $this->mdp;
	}

	//Verification
	public static function isSaisiValid($saisi) {
  		return mb_strlen($saisi, 'UTF-8') < 30 && $saisi !== "";
  	}

  	//SETTEURS
	public function setNom($nom){
		if (!self::isSaisiValid($name))
  			throw new Exception("Invalid user name");
  		$this->name= $name;
  	}

  	public function setLogin($login){
  		if (!self::isSaisiValid($login))
  			throw new Exception("Invalid user login");
  		$this->login = $login;
  	}

  	public function setMdp($mdp){
  		if (!self::isSaisiValid($mdp))
  			throw new Exception("Invalid user mdp");
  		$this->mdp = $mdp;
  	}

  }










?>