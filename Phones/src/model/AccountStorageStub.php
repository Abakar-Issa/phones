<?php
require_once('model/AccountStorage.php');

class AccountStorageStub implements AccountStorage {
	private $tab;
	private $db;

	public function __construct(){
		$this->tab = array(
						new Account("vanier","vanier","toto","utilisateur"),
						new Account("lecarpentier","lecarpentier","toto","utilisateur"),
						new Account("admin","admin","toto","admin")
		);
	}

	
	public function checkAuth($login) {
		for($i=0;$i<count($this->tab);$i++){
			if($this->tab[$i]->getLogin()==$login  ){
				return $this->tab[$i];
			}
		}
		return null;
	}


	public function createUser(Account $user){
		return $this->db->insert($user);
	}
}

?>