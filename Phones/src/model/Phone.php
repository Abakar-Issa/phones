<?php 
class Phone {



	//ATTRIBUTS
	private $nom; 
	private $marque; 
	private $modele;  
	private $categorie; 
	private $systemeExploitation; 
	private $paysDeFabrication; 
	private $anneeDeSortie; 
	
	private $prix;
	private $stockage;
	private $RAM;
	private $dureeBatterie;
	private $tailleEcran;
	private $couleur;

	private $id_account;

	//CONSTRUCTEUR
	public function __construct($nom,$marque,$modele,$categorie,$systemeExploitation,$paysDeFabrication,$anneeDeSortie,$prix,$stockage,$RAM,$dureeBatterie,$tailleEcran,$couleur,$id_account){

		$this->nom = $nom;
		$this->marque = $marque;
		$this->modele = $modele;
		$this->categorie = $categorie;
		$this->systemeExploitation = $systemeExploitation;
		$this->paysDeFabrication = $paysDeFabrication;
		$this->anneeDeSortie = $anneeDeSortie;

		$this->prix = $prix;
		$this->stockage = $stockage;
		$this->RAM = $RAM;
		$this->dureeBatterie = $dureeBatterie;
		$this->tailleEcran = $tailleEcran;
		$this->couleur = $couleur;

		$this->id_account = $id_account;
	}


	//VÉRIFICATION
	public static function isSaisiValid($saisi) {
    	return mb_strlen($saisi, 'UTF-8') < 30 && $saisi !== "";
  	}

  	


	//GETTEURS
	public function getNom(){
		if (!self::isSaisiValid($this->nom))
      		throw new Exception("Invalid Telephone Name");
		return $this->nom;
	}

	public function getMarque(){
		if (!self::isSaisiValid($this->marque))
      		throw new Exception("Invalid Telephone Marque");
		return $this->marque;
	}
	public function getModele(){
		if (!self::isSaisiValid($this->modele))
      		throw new Exception("Invalid Telephone Model");
		return $this->modele;
	}
	public function getCategorie(){
		if (!self::isSaisiValid($this->categorie))
      		throw new Exception("Invalid Telephone Categorie");
		return $this->categorie;
	}
	public function getSystemeExploitation(){
		if (!self::isSaisiValid($this->systemeExploitation))
      		throw new Exception("Invalid Telephone Systeme Exploitation");
		return $this->systemeExploitation;
	}
	public function getPaysDeFabrication(){
		if (!self::isSaisiValid($this->paysDeFabrication))
      		throw new Exception("Invalid Telephone Pays De Fabrication ");
		return $this->paysDeFabrication;
	}
	public function getAnneeDeSortie(){
		return $this->anneeDeSortie;
	}


	public function getPrix(){
		if (!self::isSaisiValid($this->prix))
      		throw new Exception("Invalid Telephone Prix");
		return $this->prix;
	}
	public function getStockage(){
		if (!self::isSaisiValid($this->stockage))
      		throw new Exception("Invalid Telephone Stockage");
		return $this->stockage;
	}
	public function getRAM(){
		if (!self::isSaisiValid($this->RAM))
      		throw new Exception("Invalid Telephone RAM");
		return $this->RAM;
	}
	public function getDureeBatterie(){
		if (!self::isSaisiValid($this->dureeBatterie))
      		throw new Exception("Invalid Telephone Duree de Batterie");
		return $this->dureeBatterie;
	}
	public function getTailleEcran(){
		if (!self::isSaisiValid($this->tailleEcran))
      		throw new Exception("Invalid Telephone Taille Ecran");
		return $this->tailleEcran;
	}
	public function getCouleur(){
		if (!self::isSaisiValid($this->couleur))
      		throw new Exception("Invalid Telephone Couleur");
		return $this->couleur;
	}


	public function getIdAccount(){
      return $this->id_account;
    }


    //SETTEURS
    public function setNom($nom){
    	$this->nom = $nom;
    }
    public function setMarque($marque){
    	$this->marque = $marque;
    }
    public function setModele($modele){
    	$this->modele = $modele;
    }
    public function setCategorie($categorie){
    	$this->categorie = $categorie;
    }
    public function setSystemeExploitation($systemeExploitation){
    	$this->systemeExploitation = $systemeExploitation;
    }
    public function setPaysDeFabrication($paysDeFabrication){
    	$this->paysDeFabrication = $paysDeFabrication;
    }
    public function setAnneeDeSortie($anneeDeSortie){
    	$this->anneeDeSortie = $anneeDeSortie;
    }


    public function setPrix($prix){
    	$this->prix = $prix;
    }
    public function setStockage($stockage){
    	$this->stockage = $stockage;
    }
    public function setRAM($RAM){
    	$this->RAM = $RAM;
    }
    public function setDureeBatterie($dureeBatterie){
    	$this->dureeBatterie = $dureeBatterie;
    }
    public function setTailleEcran($tailleEcran){
    	$this->tailleEcran = $tailleEcran;
    }
    public function setCouleur($couleur){
    	$this->couleur = $couleur;
    }



    public function setIdAccount($id_account){
    	$this->id_account = $id_account;
    }

	
}
?>