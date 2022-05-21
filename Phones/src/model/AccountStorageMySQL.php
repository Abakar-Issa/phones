<?php
require_once("model/AccountStorage.php");

class AccountStorageMySQL implements AccountStorage {

	private $PDO;


	public function __construct($PDO){
		$this->PDO = $PDO;
	}

	public function checkAuth($login){
		try{ 
			$ID = 'SELECT * FROM account where login = "'.$login.'";';
			$etat = $this->PDO->prepare($ID); 
			$etat->execute();
			$etat->setFetchMode(PDO::FETCH_OBJ);
			$liste = $etat->fetch();

			if ($liste !== false){
				$user = new Account($liste->name,$liste->login,$liste->mdp);
				return ($user);
			}
			else {
				return null;
			}
		} 
		catch(Exception $e){
        	echo $e->getMessage();
    	}	
  	}

  	public function createUser(Account $user){
		try{ 
			$id = 1;
			$create = 'INSERT INTO account (name,login,mdp) VALUES(:nom,:login,:mdp)';
			$etat = $this->PDO->prepare($create); 

			$etat->bindValue(':nom',$user->getName());
        	$etat->bindValue(':login',$user->getLogin());
        	$etat->bindValue(':mdp',$user->getMdp());


        	$etat->execute();
        	$id = $this->PDO->lastInsertId();
        	$data = $etat->setFetchMode(PDO::FETCH_OBJ);
        	return $id;
    	}
    	catch (Exception $e){ }
	}






	



}
?>