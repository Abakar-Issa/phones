<?php
require_once("model/Account.php");

class AccountBuilder{

	//ATTRIBUTS
	private $data;
	private $error;

	const NAME_REF = 'name';
	const LOGIN_REF = 'login';
	const MDP_REF = 'mdp';

	//CONSTRUCTEUR
	public function __construct($data=null){
		if($data === null){
			$data = array(
					self::NAME_REF => "",
                    self::LOGIN_REF => "",
                    self::MDP_REF  => "",
			);
		}
		$this->data = $data;
		$this->error = array(self::NAME_REF=>"",self::LOGIN_REF=>"",self::MDP_REF=>"");
	}

	//GETTEURS
	public function getData(){
		return $this->data;
	}
    public function getError(){
    	return $this->error;
    }
    public function getNomRef(){
      return self::NAME_REF;
    }
    public function getLoginRef(){
      return self::LOGIN_REF;
    }
    public function getMdpRef(){
      return self::MDP_REF;
    }

    //createUser
    public function createUser( array $data){
      $mdp = $data[self::MDP_REF];
      $mdp = password_hash($mdp, PASSWORD_BCRYPT);
      $user = new Account(htmlspecialchars($data[self::NAME_REF]),htmlspecialchars($data[self::LOGIN_REF]),$mdp,$data);
      return $user;
    }


    //isValid
    public function isValid(){
    	$valid = true;

    	if(key_exists(self::NAME_REF,$this->data) && key_exists(self::LOGIN_REF,$this->data) 
        && key_exists(self::MDP_REF,$this->data)) {

    		$this->error = array(
    							self::NAME_REF=>"",
    							self::LOGIN_REF=>"",
    							self::MDP_REF=>"",
    		);

    		if($this->data[self::NAME_REF]===""){
          		$this->error[self::NAME_REF]="<strong><font color='red'>champs non renseigné</font></strong>";
          		$valid=false;
        	}	

        	if($this->data[self::LOGIN_REF]===""){
          		$this->error[self::LOGIN_REF]="<strong><font color='red'>champs non renseigné</font></strong>";
          		$valid=false;
       		}

        	if($this->data[self::MDP_REF]===""){
          		$this->error[self::MDP_REF]="<strong><font color='red'>champs non renseigné</font></strong>";
          		$valid=false;
        	}
        }
        else {    	
    		$valid = false;
    	}
    	return $valid;
    }

}

?>