<?php
require_once("model/Phone.php");

class PhoneBuilder{
	private $data;
	private $error;

	const NOM_REF = 'nom';
	const MARQUE_REF = 'marque';
	const MODELE_REF = 'modele';
	const CATEGORIE_REF = 'categorie';
	const SE_REF = 'systemeExploitation';
	const PAYS_REF = 'paysDeFabrication';
	const ANNEE_REF = 'anneeDeSortie';
	const PRIX_REF = 'prix';
	const STOCKAGE_REF = 'stockage';
	const RAM_REF = 'RAM';
	const BATTERIE_REF = 'dureeBatterie';
	const ECRAN_REF = 'tailleEcran';
	const COULEUR_REF = 'couleur';


	//CONSTRUCTEUR
	public function __construct($data=null){
		if($data === null){
			$data = array(
				self::NOM_REF => "",
				self::MARQUE_REF => "",
				self::MODELE_REF => "",
				self::CATEGORIE_REF => "",
				self::SE_REF => "",
				self::PAYS_REF => "",
				self::ANNEE_REF => "",
				self::PRIX_REF => "",
				self::STOCKAGE_REF => "",
				self::RAM_REF => "",
				self::BATTERIE_REF => "",
				self::ECRAN_REF => "",
				self::COULEUR_REF => "",
				"id_account" => "",
			);
		}
		$this->data = $data;
		$this->error = array();
	}

	//GETTEURS
	public function getData($ref){
		return key_exists($ref, $this->data)? $this->data[$ref]: ''; 
	}
	public function getError($ref){
		return key_exists($ref, $this->error)? $this->error[$ref]: null;
	}

	public function getNomRef(){
		return self::NOM_REF;
	}
	public function getMarqueRef(){
		return self::MARQUE_REF;
	}
	public function getModeleRef(){
		return self::MODELE_REF;
	}
	public function getCategorieRef(){
		return self::CATEGORIE_REF;
	}
	public function getSystemeExploitationRef(){
		return self::SE_REF;
	}
	public function getPaysDeFabricationRef(){
		return self::PAYS_REF;
	}
	public function getAnneeDeSortieRef(){
		return self::ANNEE_REF;
	}



	public function getPrixRef(){
		return self::PRIX_REF;
	}
	public function getStockageRef(){
		return self::STOCKAGE_REF;
	}
	public function getRAMRef(){
		return self::RAM_REF;
	}
	public function getDureeBatterieRef(){
		return self::BATTERIE_REF;
	}
	public function getTailleEcranRef(){
		return self::ECRAN_REF;
	}
	public function getCouleurRef(){
		return self::COULEUR_REF;
	}


	public function getIdAccount(){
        return "id_account";
    }


    //createPhone
    public function createPhone(array $data,$login){ 
    	if (!key_exists(self::MARQUE_REF, $this->data) || !key_exists(self::MODELE_REF, $this->data) || !key_exists(self::CATEGORIE_REF, $this->data) || !key_exists(self::SE_REF, $this->data) || !key_exists(self::PAYS_REF, $this->data) || !key_exists(self::ANNEE_REF, $this->data) || !key_exists(self::PRIX_REF, $this->data) || !key_exists(self::STOCKAGE_REF, $this->data) ||   !key_exists(self::RAM_REF, $this->data) || !key_exists(self::BATTERIE_REF, $this->data) || !key_exists(self::ECRAN_REF, $this->data) || !key_exists(self::COULEUR_REF, $this->data) || !key_exists(self::NOM_REF, $this->data) ||  $login == null) 
    		throw new Exception("Missing fields for Phone creation");
    	return new Phone(htmlspecialchars($this->data[self::NOM_REF]),htmlspecialchars($this->data[self::MARQUE_REF]),htmlspecialchars($this->data[self::MODELE_REF]),htmlspecialchars($this->data[self::CATEGORIE_REF]),htmlspecialchars($this->data[self::SE_REF]),htmlspecialchars($this->data[self::PAYS_REF]),htmlspecialchars($this->data[self::ANNEE_REF]),htmlspecialchars($this->data[self::PRIX_REF]),htmlspecialchars($this->data[self::STOCKAGE_REF]),htmlspecialchars($this->data[self::RAM_REF]),htmlspecialchars($this->data[self::BATTERIE_REF]),htmlspecialchars($this->data[self::ECRAN_REF]),htmlspecialchars($this->data[self::COULEUR_REF]),$login);
    } 


    //isValid
    public function isValid() { 
    	$this->error = array();

    	if (!key_exists(self::NOM_REF, $this->data) || $this->data[self::NOM_REF] === "")
			$this->error[self::NOM_REF] = "<strong><font color='red'>Vous devez entrer le nom du téléphone</font></strong>";
		else if (mb_strlen($this->data[self::NOM_REF], 'UTF-8') >= 30)
			$this->error[self::NOM_REF] = "<strong><font color='red'>Le nom doit faire moins de 30 caractères</font></strong>";

    	if (!key_exists(self::MARQUE_REF, $this->data) || $this->data[self::MARQUE_REF] === "")
			$this->error[self::MARQUE_REF] = "<strong><font color='red'>Vous devez entrer la marque du téléphone</font></strong>";
		else if (mb_strlen($this->data[self::MARQUE_REF], 'UTF-8') >= 30)
			$this->error[self::MARQUE_REF] = "<strong><font color='red'>La marque doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::MODELE_REF, $this->data) || $this->data[self::MODELE_REF] === "")
			$this->error[self::MODELE_REF] = "<strong><font color='red'>Vous devez entrer le modèle du téléphone</font></strong>";
		else if (mb_strlen($this->data[self::MODELE_REF], 'UTF-8') >= 30)
			$this->error[self::MODELE_REF] = "<strong><font color='red'>Le modèle doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::CATEGORIE_REF, $this->data) || $this->data[self::CATEGORIE_REF] === "")
			$this->error[self::CATEGORIE_REF] = "<strong><font color='red'>Vous devez entrer la catégorie du Téléphone (Smartphone, TelephoneSimple ou TelephoneMultimedia)</font></strong>";
		else if (mb_strlen($this->data[self::CATEGORIE_REF], 'UTF-8') >= 30)
			$this->error[self::CATEGORIE_REF] = "<strong><font color='red'>La catégorie doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::SE_REF, $this->data) || $this->data[self::SE_REF] === "")
			$this->error[self::SE_REF] = "<strong><font color='red'>Vous devez entrer le systeme d'exploitation du Téléphone (Android ou iOS)</font></strong>";
		else if (mb_strlen($this->data[self::SE_REF], 'UTF-8') >= 30)
			$this->error[self::SE_REF] = "<strong><font color='red'>Le systeme doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::PAYS_REF, $this->data) || $this->data[self::PAYS_REF] === "")
			$this->error[self::PAYS_REF] = "<strong><font color='red'>Vous devez entrer le pays de Fabrication du Téléphone</font></strong>";
		else if (mb_strlen($this->data[self::PAYS_REF], 'UTF-8') >= 30)
			$this->error[self::PAYS_REF] = "<strong><font color='red'>Le pays de Fabrication doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::ANNEE_REF, $this->data) || $this->data[self::ANNEE_REF] === "")
			$this->error[self::ANNEE_REF] = "<strong><font color='red'>Vous devez entrer l'année de Sortie du Téléphone</font></strong>";
		else if (!preg_match("/^[0-9]*$/i", $this->data[self::ANNEE_REF]))			
			$this->error[self::ANNEE_REF] = "<strong><font color='red'>L'année doit etre un chiffre positif uniquement</font></strong>";


		if (!key_exists(self::PRIX_REF, $this->data) || $this->data[self::PRIX_REF] === "")
			$this->error[self::PRIX_REF] = "<strong><font color='red'>Vous devez entrer le prix du Téléphone</font></strong>";
		else if (mb_strlen($this->data[self::PRIX_REF], 'UTF-8') >= 30)
			$this->error[self::PRIX_REF] = "<strong><font color='red'>Le prix doit etre un nombre positif</font></strong>";

		if (!key_exists(self::STOCKAGE_REF, $this->data) || $this->data[self::STOCKAGE_REF] === "")
			$this->error[self::STOCKAGE_REF] = "<strong><font color='red'>Vous devez entrer la capacité de Stockage du téléphone</font></strong>";
		else if (!preg_match("/^[0-9]*$/i", $this->data[self::STOCKAGE_REF]))			
			$this->error[self::STOCKAGE_REF] = "<strong><font color='red'>La capacité de Stockage doit etre un chiffre positif uniquement</font></strong>";

		if (!key_exists(self::RAM_REF, $this->data) || $this->data[self::RAM_REF] === "")
			$this->error[self::RAM_REF] = "<strong><font color='red'>Vous devez entrer la RAM du téléphone</font></strong>";
		else if (!preg_match("/^[0-9]*$/i", $this->data[self::RAM_REF]))			
			$this->error[self::RAM_REF] = "<strong><font color='red'>La RAM doit etre un chiffre positif uniquement</font></strong>";

		if (!key_exists(self::BATTERIE_REF, $this->data) || $this->data[self::BATTERIE_REF] === "")
			$this->error[self::BATTERIE_REF] = "<strong><font color='red'>Vous devez entrer la durée de batterie du téléphone</font></strong>";
		else if (!preg_match("/^[0-9]*$/i", $this->data[self::BATTERIE_REF]))			
			$this->error[self::BATTERIE_REF] = "<strong><font color='red'>La durée de Batterie doit etre un chiffre positif uniquement (en mAh)</font></strong>";

		if (!key_exists(self::ECRAN_REF, $this->data) || $this->data[self::ECRAN_REF] === "")
			$this->error[self::ECRAN_REF] = "<strong><font color='red'>Vous devez entrer la taille de l'ecran</font></strong>";
		else if (mb_strlen($this->data[self::ECRAN_REF], 'UTF-8') >= 30)
			$this->error[self::ECRAN_REF] = "<strong><font color='red'>Le taille de l'ecran doit faire moins de 30 caractères</font></strong>";

		if (!key_exists(self::COULEUR_REF, $this->data) || $this->data[self::COULEUR_REF] === "")
			$this->error[self::COULEUR_REF] = "<strong><font color='red'>Vous devez entrer les couleurs disponibles du Téléphone séparées par des virgules</font></strong>";
		else if (mb_strlen($this->data[self::COULEUR_REF], 'UTF-8') >= 50)
			$this->error[self::COULEUR_REF] = "<strong><font color='red'>Les couleurs du téléphones doivent faire moins de 50 caractères</font></strong>";


		return count($this->error) === 0;
    }


    //updatePhone
    /* Met à jour une instance de Phone avec les données fournies.*/
    public function updatePhone(Phone $p){

    	if (key_exists(self::NOM_REF, $this->data))
			$p->setMarque($this->data[self::NOM_REF]);

    	if (key_exists(self::MARQUE_REF, $this->data))
			$p->setMarque($this->data[self::MARQUE_REF]);

		if (key_exists(self::MODELE_REF, $this->data))
			$p->setModele($this->data[self::MODELE_REF]);

		if (key_exists(self::CATEGORIE_REF, $this->data))
			$p->setCategorie($this->data[self::CATEGORIE_REF]);

		if (key_exists(self::SE_REF, $this->data))
			$p->setSystemeExploitation($this->data[self::SE_REF]);

		if (key_exists(self::PAYS_REF, $this->data))
			$p->setPaysDeFabrication($this->data[self::PAYS_REF]);

		if (key_exists(self::ANNEE_REF, $this->data))
			$p->setAnneeDeSortie($this->data[self::ANNEE_REF]);



		if (key_exists(self::PRIX_REF, $this->data))
			$p->setPrix($this->data[self::PRIX_REF]);

		if (key_exists(self::STOCKAGE_REF, $this->data))
			$p->setStockage($this->data[self::STOCKAGE_REF]);

		if (key_exists(self::RAM_REF, $this->data))
			$p->setRAM($this->data[self::RAM_REF]);

		if (key_exists(self::BATTERIE_REF, $this->data))
			$p->setDureeBatterie($this->data[self::BATTERIE_REF]);

		if (key_exists(self::ECRAN_REF, $this->data))
			$p->setTailleEcran($this->data[self::ECRAN_REF]);

		if (key_exists(self::COULEUR_REF, $this->data))
			$p->setCouleur($this->data[self::COULEUR_REF]);
    }



}








?>