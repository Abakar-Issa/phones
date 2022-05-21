<?php
require_once("view/View.php");

require_once('model/Phone.php');
require_once('model/PhoneStorageStub.php');
require_once("model/PhoneBuilder.php");

require_once("model/AccountBuilder.php");
require_once("model/Account.php");





class Controller {

	private $view;
	private $phoneStor;
	private $accountStor;

	private $currentNewPhone;
	private $currentNewUser;

	/*******************************************************
    /                 Constructeur
    /*******************************************************/

	public function __construct(View $view,PhoneStorage $phoneStor,AccountStorageMySQL $accountStor ){
		$this->view = $view;
		$this->phoneStor = $phoneStor;
		$this->accountStor = $accountStor;
		$this->currentNewPhone = key_exists('currentNewPhone',$_SESSION) ? $_SESSION['currentNewPhone'] : new PhoneBuilder();
		$this->currentNewUser = key_exists('currentNewUser',$_SESSION) ? $_SESSION['currentNewUser'] : new AccountBuilder();
	}

	/*******************************************************
    /                 Destructeur
    /*******************************************************/

	public function __destruct () {
		$_SESSION['currentNewPhone'] = $this->currentNewPhone;
		$_SESSION['currentNewUser']   =$this->currentNewUser; 
	}

	/*******************************************************
    /                 showInformation
    /*******************************************************/

	public function showInformation($id){
		$phone = $this->phoneStor->read($id);
		if ($phone === null){
			/* Le telephone n'existe pas en BD */
			$this->view->makeUnknownPhonePage();
		}
		else {
			/* Le telephone existe, on prépare la page */
			$this->view->makePhonePage($phone);
		}		
	}

	/*******************************************************
    /                 showList
    /*******************************************************/

   	public function  showList(){
  		return $this->view->makeListPage($this->phoneStor->readAll());
	}

	/*******************************************************
    /                 saveNewPhone
    /*******************************************************/

    public function saveNewPhone(array $data){
		$this->currentNewPhone = new PhoneBuilder($data);
		if($this->currentNewPhone->isValid()){
			//construir le nouveau telephone
			$phone = $this->currentNewPhone->createPhone($data,$_SESSION['user']->getLogin());
			//ajouter le telephone à la base
			$id = $this->phoneStor->create($phone);

			$this->currentNewPhone = null;
			//creer la page de ce telephone (remplir le formulaire)
			$this->view->displayPhoneCreationSuccess($id);
		}

		else {
			$this->view->displayPhoneCreationFailure();
		}
	}

	/*******************************************************
    /                 newPhone
    /*******************************************************/

    public function newPhone() {
		if ($this->currentNewPhone === null){
			$this->currentNewPhone = new PhoneBuilder();
		}
		if(key_exists('user',$_SESSION)){
			$this->view->makePhoneCreationPage($this->currentNewPhone);
		}
		else {
			$this->view->displayNotConnected();
		}
	}


	/*******************************************************
    /                 askPhoneDeletion
    /*******************************************************/

    public function askPhoneDeletion($id){
		if(key_exists('user',$_SESSION)){
            $user=$_SESSION['user'];
            $phone = $this->phoneStor->read($id);
            if ($phone->getIdAccount() === $user->getLogin()){
            	$this->phoneStor->delete($id);
            	$this->view->displayPhoneDeletionSuccess();
            }
            else {
            	$this->view->displayCantDelete($id);
            }
        }
        else {
        	$this->view->displayNotConnected();
        }
    }

    /*******************************************************
    /                 deletePhone
    /*******************************************************/
    
    public function deletePhone($id){
		/* On récupère le telephone en BD */
		$phone = $this->phoneStor->read($id);
		if ($phone === null) {
			/* Le telephone n'existe pas en BD */
			$this->view->makeUnknownPhonePage();
		} else {
			/* Le telephone existe, on prépare la page */
			$this->view->makePhoneDeletionPage($id);
		}
	}

	/*******************************************************
    /                 modifyPhone
    /*******************************************************/
    
    public function modifyPhone($id) {
		if(key_exists('user',$_SESSION)){
            $user=$_SESSION['user'];
            $phone = $this->phoneStor->read($id);
            if ($phone!==null){
            	if ($phone->getIdAccount() === $user->getLogin()){
            		$data = array(
            			PhoneBuilder::NOM_REF =>$phone->getNom(),
            			PhoneBuilder::MARQUE_REF=>$phone->getMarque(),
            			PhoneBuilder::MODELE_REF=>$phone->getModele(),
                        PhoneBuilder::CATEGORIE_REF=>$phone->getCategorie(),
						PhoneBuilder::SE_REF =>$phone->getSystemeExploitation(),
            			PhoneBuilder::PAYS_REF=>$phone->getPaysDeFabrication(),
            			PhoneBuilder::ANNEE_REF=>$phone->getAnneeDeSortie(),
                        PhoneBuilder::PRIX_REF=>$phone->getPrix(),
                        PhoneBuilder::STOCKAGE_REF =>$phone->getStockage(),
            			PhoneBuilder::RAM_REF=>$phone->getRAM(),
            			PhoneBuilder::BATTERIE_REF=>$phone->getDureeBatterie(),
                        PhoneBuilder::ECRAN_REF=>$phone->getTailleEcran(),
                        PhoneBuilder::COULEUR_REF=>$phone->getCouleur(),
                    );
            		$this->view->makePhoneModifPage($id, new PhoneBuilder($data));
            	}
            	else {
            		$this->view->displayCantModify($id);
            	}
            }
            else {
            	$this->view->makePhoneCreationPage($phoneBuilder);
            }
        }
        else {
           	$this->view->displayNotConnected();
        }
    }

    /*******************************************************
    /                 savePhoneModifications
    /*******************************************************/

    public function savePhoneModifications($id, array $data) {
		/* On récupère en BD le telephone à modifier */
		$phone = $this->phoneStor->read($id);
		if ($phone === null) {
           /* Le telephone n'existe pas en BD */
            $this->view->makeUnknownPhonePage();

        } else {
            $pb = new PhoneBuilder($data);
            /* Validation des données */
           	if ($pb->isValid()) {
               	/* Modification du telephone */
                $pb->updatePhone($phone);
                /* On essaie de mettre à jour en BD.*/
                $ok = $this->phoneStor->update($id, $phone);
                if (!$ok)
                    throw new Exception("Identifier has disappeared?!");
                /* Préparation de la page du telephone */
                $this->view->displayPhoneModificationSuccess($id);
            } else {
                $this->view->displayPhoneModificationFailure($id,$pb);
            }

        }

    }

    /*******************************************************
    /                     Connexion    
    /*******************************************************/

    public function connexionPage() {
        $this->view->makeLoginFormPage();
    }


    /*******************************************************
    /                     Deconnexion    
    /*******************************************************/

    public function disconnecte() {
        unset($_SESSION['user']);
        $this->view->displayDisconnectedPage();
    }

    /*******************************************************
    /                     Inscription    
    /*******************************************************/

    public function newUser(){
    	if ($this->currentNewUser === null){
			$this->currentNewUser = new AccountBuilder();
		}
		$this->view->makeSigInPage($this->currentNewUser);
    }

    /*******************************************************
    /              Sauvegarde du Compte    
    /*******************************************************/

    public function saveNewAccount(array $data){
    	$this->currentNewUser = new AccountBuilder($data);
    	if ($this->existUser($data) === true){
    		$this->view->displayUserLoginUsed();
    	}
    	else if ($this->currentNewUser->isValid()){
    		$user = $this->currentNewUser->createUser($data);
    		$id = $this->accountStor->createUser($user);
    		$this->currentNewUser = new AccountBuilder();
    		$this->view->displayUserCreationSuccess();
    	}
    	else {
    		$this->view->displayUserCreationFailure();
    	}

    }

    public function existUser($data){
    	return $this->accountStor->checkAuth($data[AccountBuilder::LOGIN_REF]) != null;
    }

    /*******************************************************
    /              Verification de Connexion  
    /*******************************************************/

    public function isConnected($data) {
       	$user = $this->accountStor->checkAuth($data[AccountBuilder::LOGIN_REF]);

    	if ($user === null){
    		$this->view->displayLoginIncorrect();
    	}
    	else {
    		if(password_verify($data[AccountBuilder::MDP_REF], $user->getMdp())) {
    			$_SESSION['user'] = $user;
    			$this->view->displayConnected($user);
    		}
    		else {
    			$this->view->displayLoginIncorrect();
    		}
    	}
    }

    /********************************************************************
    /     Liste des Animaux d'un utilisateur (presque comme showList)  
    /********************************************************************/
    public function showUserPhoneListe(){
        $x = key_exists('user',$_SESSION)?$_SESSION['user']->getLogin(): null;
        if($x){
        	$this->view->makeListPage($this->phoneStor->readUserPhone($x));
        }
        else{
            $this->view->displayNotConnected();
        }
    }


    /********************************************************************
    /                   Resultat de la Recherche 
    /********************************************************************/

    public function search(){
  
        if (isset($_POST["submit"])){
            $nomSaisi = $_POST["search"];
            $this->phoneStor->searchByMarque($nomSaisi);
        }
        $this->view->makeSearchPage();

    }

    /********************************************************************
    /                   Resultat du tri
    /********************************************************************/

    public function trier(){ 
        $this->phoneStor->triByPrix();
        $this->view->makeTriPrixPage();
        

    }

}