<?php
require_once("model/PhoneStorage.php");
require_once("view/View.php");
require_once("view/PrivateView.php");

require_once("control/Controller.php");
require_once("model/AccountStorageStub.php");

class Router {

	public function main($db,$db2){
		session_start();

		$feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
		$_SESSION['feedback'] = '';

		$id = key_exists('id', $_GET)? $_GET['id']: null;
		$action = key_exists('action', $_GET)? $_GET['action']: null;
		$user=key_exists('user',$_SESSION) ? $_SESSION['user'] : NULL;

		$v = ($user == null) ? new View($this,$feedback) : new PrivateView($this,$feedback,$user);
		$ctl = new Controller($v,$db,$db2);

		$v->makeNotPossibleToShowPage();

		if ($action === null) {
			$action = ($id === null)? "accueil": "voir";
		}

		//UTILISATEUR CONNECTÉ
		if($user != null){
			try{
				switch ($action){
					case "voir":
						if ($id === null){
							$v->makeUnknownActionPage();
						}
						else {
							$ctl->showInformation($id);
						}
					break;

					case "liste": 
            			$ctl->showList();            	
            		break;

            		case "nouveau":
            			$ctl->newPhone();
            		break;

            		case "sauverNouveau":
            			$id = $ctl->SaveNewPhone($_POST);
            		break;

            		case "supprimer":
						if ($id === null){
							$v->makeUnknownActionPage();
						}
						else{
							$ctl->deletePhone($id);
						}
            		break;

            		case "confirmerSuppression":
            			if($id === null){
            				$v->makeUnknownActionPage();
            			}
            			else {
            				$ctl->askPhoneDeletion($id);
            			}
            		break;

            		case "modifier":
						if ($id === null) {
							$v->makeUnknownActionPage();
						} else {
							$ctl->modifyPhone($id);
						}
					break;

					case "sauverModifs":
						if ($id === null) {
							$v->makeUnknownActionPage();
						} else {
							$ctl->savePhoneModifications($id, $_POST);
						}
					break;

					case 'deconnexion':
                        $ctl->disconnecte();
                    break;

                    case 'pageUser':
                        $v->makeDisconnectionPage();
                    break;

                    case 'userListe':
                        $ctl->showUserPhoneListe();
                    break;

                    case 'search':
                    	//$v->makeSearchPage();
                    	$ctl->search();
                	break;

                	case 'tri':
                		//$v->makeTriPrixPage();
                		$ctl->trier();
                	break;


				}
			}
			catch (Exception $e){
				$v->makeUnexpectedErrorPage($e);
			}
		}
		//UTILISATEUR NON CONNECTÉ
		else {
			try{
				switch($action){
					case "connexion":
						$ctl->connexionPage();
					break;

					case 'nouveauCompte';
                		$ctl->newUser();
            		break;

            		case 'sauverAccount';
                		$ctl->saveNewAccount($_POST);
            		break;

            		case 'login':
                		$ctl->connexionPage();
            		break;

            		case 'connecte':
                		$ctl->isConnected($_POST);
            		break;
				}
			}
			catch (Exception $e){
				$v->makeUnexpectedErrorPage($e);
			}
		}
		//ACCES COMMUN
		try {
			switch($action){
				case "accueil":
					$v->makeHomePage();
				break;

				case "liste": 
            		$ctl->showList();            	
            	break;

            	case 'aPropos':
                	$v->makeAproposPage();
           		break;

           		
			}
		}
		catch (Exception $e){
			$v->makeUnexpectedErrorPage($e);
		}

		$v->render();
	}

	/*******************************************************
    /                 URL Telephones
    /*******************************************************/

	//acceuil
	public function gethomePageURL() {
		return "telephones.php";
	}
	//liste des Téléphones
	public function getListeURL(){
		return "telephones.php?action=liste";
	}
	//a propos
	public function getAproposPageURL(){
		return "?action=aPropos";
	}
	//Page d'un ANIMAL
	public function getPhoneURL($id){
		return "$id";
	}

	/*******************************************************
    /   URL CREATION SUPPRESSION MODIFICATION de Téléphone 
    /*******************************************************/

	//CREATION 
	public function getPhoneCreationURL(){
		return "telephones.php?action=nouveau";
	}

	//SAUVEGARDE 
	public function getPhoneSaveURL(){
		return "telephones.php?action=sauverNouveau";
	}

	//SUPPRESSION 
	/* page demandant à l'internaute de confirmer son souhait de supprimer le téléphone */
	public function getPhoneAskDeletionURL($id){
		return "telephones.php?id=$id&amp;action=supprimer";
	}
	/*page supprimant effectivement le telephone*/
	public function getPhoneDeletionURL($id){
		return "telephones.php?id=$id&amp;action=confirmerSuppression";
	}

	//MODIFICATION 
	//page du formulaire pour modifier le telephone
	public function getPhoneAskModifyURL($id){
		return "telephones.php?id=$id&amp;action=modifier";
	}

	public function getPhoneModifiedPageURL($id){
		return "telephones.php?id=$id&amp;action=sauverModifs";
	}

	/*******************************************************
    /   			REDIRECTION 
    /*******************************************************/

	public function POSTredirect($url, $feedback){
		$_SESSION['feedback'] = $feedback;
		header("Location: " . $url, true, 303);
		die;
	}

	/*******************************************************
    /   			URL Account
    /*******************************************************/

    //connexion
    public function getConnexionPageURL(){
		return "telephones.php?action=connexion";
	}
	//deconnexion
	public function getDeconnexionPageURL(){
		return "telephones.php?action=deconnexion";
	}
	//inscription
    public function getSigInUrl(){
    	return "?action=nouveauCompte";
    }
    //sauverAccount
    public function getSaveNewUserUrl(){
    	return "?action=sauverAccount";
    }
	//login
	public function getLoginUrl() {
        return "?action=login";
    }
    //connecte
    public function getConnectedUrl(){
        return "?action=connecte";
    }
    //pageUser
    public function getPageUserURL(){
        return "?action=pageUser";
    }
    //userListe
    public function getUserPhoneListe(){
        return "?action=userListe";
    }



    //PAGE Recherche :
    public function getSearchPageURL(){
    	return "?action=search";
    }

    public function getTriPageURL(){
    	return "?action=tri";
    }

    

}






