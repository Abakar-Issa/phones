<?php

//discord id : 836868307612860436


class PhoneStorageMySQL implements PhoneStorage {
	private $PDO;

	//Constructeur
	public function __construct($PDO){
		$this->PDO = $PDO;
	}

	//read
	public function read($id){
		$ID = 'SELECT * FROM phone where id =:id';
		$etat = $this->PDO->prepare($ID); //Prépare une requête à l'exécution et retourne un objet
		$data = array(":id"=> $id);
		$etat->execute($data);//Exécute une requête préparée

		$liste = $etat->fetch();//Récupère la ligne suivante d'un jeu de résultats PDO
		$phone = new Phone($liste['nom'],$liste['marque'],$liste['modele'],$liste['categorie'],$liste['systemeExploitation'],$liste['paysDeFabrication'],$liste['anneeDeSortie'],$liste['prix'],$liste['stockage'],$liste['RAM'],$liste['dureeBatterie'],$liste['tailleEcran'],$liste['couleur'],$liste['id_account']);

		return $phone;
	}

	//readAll
	public function readAll(){
		$ID = 'SELECT * FROM phone';
		$etat = $this->PDO->prepare($ID);
		$etat->execute();

		$liste = $etat->fetchAll();

		$tab = array();
		foreach ($liste as $key => $value) {
			$tab[$value['id']] = new Phone($value['nom'],$value['marque'],$value['modele'],$value['categorie'],$value['systemeExploitation'],$value['paysDeFabrication'],$value['anneeDeSortie'],$value['prix'],$value['stockage'],$value['RAM'],$value['dureeBatterie'],$value['tailleEcran'],$value['couleur'],$value['id_account']);

		}
		return $tab;
	}

	//create
	public function create(Phone $p){
	  	$create = 'INSERT INTO phone (nom,marque,modele,categorie,systemeExploitation,paysDeFabrication,anneeDeSortie,prix,stockage,RAM,dureeBatterie,tailleEcran,couleur,id_account) VALUES (:nom,:marque,:modele,:categorie,:systemeExploitation,:paysDeFabrication,:anneeDeSortie,:prix,:stockage,:RAM,:dureeBatterie,:tailleEcran,:couleur,:id_account)';

	  	$etat = $this->PDO->prepare($create);

	  	$etat->bindValue(':nom',$p->getNom());
	  	$etat->bindValue(':marque',$p->getMarque());
	  	$etat->bindValue(':modele',$p->getModele());
	  	$etat->bindValue(':categorie',$p->getCategorie());
	  	$etat->bindValue(':systemeExploitation',$p->getSystemeExploitation());
	  	$etat->bindValue(':paysDeFabrication',$p->getPaysDeFabrication());
	  	$etat->bindValue(':anneeDeSortie',$p->getAnneeDeSortie());
	  	$etat->bindValue(':prix',$p->getPrix());
	  	$etat->bindValue(':stockage',$p->getStockage());
	  	$etat->bindValue(':RAM',$p->getRAM());
	  	$etat->bindValue(':dureeBatterie',$p->getDureeBatterie());
	  	$etat->bindValue(':tailleEcran',$p->getTailleEcran());
	  	$etat->bindValue(':couleur',$p->getCouleur());
	  	$etat->bindValue(':id_account',$p->getIdAccount());

	  	$etat->execute();

	  	return $this->PDO->lastInsertId();
	}

	//delete
	public function delete($id){
	    $deleteId = 'DELETE FROM phone WHERE id =:id';
		$etat= $this->PDO->prepare($deleteId);

		$etat->bindValue(':id',$id,PDO::PARAM_INT);

		$etat->execute();

		return true;
	}

	//update
	public function update($id, Phone $p){
		$update = 'UPDATE phone SET id=:id, nom =:nom, marque=:marque, modele=:modele, categorie=:categorie, systemeExploitation=:systemeExploitation, paysDeFabrication=:paysDeFabrication, anneeDeSortie=:anneeDeSortie, prix=:prix, stockage=:stockage, RAM=:RAM, dureeBatterie=:dureeBatterie, tailleEcran=:tailleEcran, couleur=:couleur WHERE id ='.$id.';';
		$etat= $this->PDO->prepare($update);

		$etat->bindValue(':id',$id);
		$etat->bindValue(':nom',$p->getNom());
	  	$etat->bindValue(':marque',$p->getMarque());
	  	$etat->bindValue(':modele',$p->getModele());
	  	$etat->bindValue(':categorie',$p->getCategorie());
	  	$etat->bindValue(':systemeExploitation',$p->getSystemeExploitation());
	  	$etat->bindValue(':paysDeFabrication',$p->getPaysDeFabrication());
	  	$etat->bindValue(':anneeDeSortie',$p->getAnneeDeSortie());
	  	$etat->bindValue(':prix',$p->getPrix());
	  	$etat->bindValue(':stockage',$p->getStockage());
	  	$etat->bindValue(':RAM',$p->getRAM());
	  	$etat->bindValue(':dureeBatterie',$p->getDureeBatterie());
	  	$etat->bindValue(':tailleEcran',$p->getTailleEcran());
	  	$etat->bindValue(':couleur',$p->getCouleur());
		

	  	$etat->execute();

	  	$etat->setFetchMode(PDO::FETCH_OBJ);

	  	return true;
    }

    //readUserPhone
    public function readUserPhone($mail){
		$ID = 'SELECT * FROM phone where id_account = :id_account';
		$etat = $this->PDO->prepare($ID);
		$etat->bindValue(':id_account', $mail);
		$etat->execute();
		$liste = $etat->fetchAll();
		$tab =array();
		foreach ($liste as $key => $value){
			$tab[$value['id']] = new Phone($value['nom'],$value['marque'],$value['modele'],$value['categorie'],$value['systemeExploitation'],$value['paysDeFabrication'],$value['anneeDeSortie'],$value['prix'],$value['stockage'],$value['RAM'],$value['dureeBatterie'],$value['tailleEcran'],$value['couleur'],$value['id_account']);
		}
		return $tab;
	}


	//Barre De Recherche
	public function searchByMarque($marqueSaisi){

		$ID = "SELECT * FROM phone WHERE marque = '$marqueSaisi'";
		$etat = $this->PDO->prepare($ID);
		$etat->setFetchMode(PDO::FETCH_OBJ);
		$etat->execute();
		
		echo "<font color=RED>Resultat de Votre Recherche ! </font>";
		while ($p = $etat->fetch()){
			echo '<div><a href=telephones.php?id='.$p->id.'>'.$p->nom.' | '.'</a>'.'</div>';
		}
	}



	//Tri par Prix
	public function triByPrix(){
		$ID = "SELECT * FROM phone ORDER BY prix DESC";
		$etat = $this->PDO->prepare($ID);
		$etat->setFetchMode(PDO::FETCH_OBJ);
		$etat->execute();

		$resultat = $etat->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultat as $key => $value) {
			
			echo '<p class="ici">'.$resultat[$key]['nom'].'<font color=blue> ==> </font>'.$resultat[$key]['prix'].'€'.'</p>';



			?>
			<style>
				p.ici{
					top: 555px;
					left: 20px;
					position: relative;
				}
			</style>


			<?php
		}

	}
        
   













	


}

?>
