<?php
require_once('model/Phone.php');
require_once("control/Controller.php");
require_once('model/PhoneStorageStub.php');
require_once('lib/ObjectFileDB.php');

class View {
	private $title;
	private $content;
	private $router;

	private $feedback;
	private $menu;


	/*******************************************************
    /                 Constructeur
    /*******************************************************/

	public function __construct(Router $router,$feedback){
  		$this->title = null;
  		$this->content = null;
  		$this->router = $router;
  		$this->feedback = $feedback;
  		$this->menu = array(
			"Accueil" => $this->router->gethomePageURL(),
			"Galerie" => $this->router->getListeURL(),
			"Se Connecter" =>$this->router->getConnexionPageURL(),
			"A Propos" => $this->router->getAproposPageURL(),

		);
	}

	/*******************************************************
    /                 Render
    /*******************************************************/

    public function render(){
		$title = $this->title;
		$content = $this->content;
		include("squelette.php");

		if ($this->title === null || $this->content === null) {
			$this->makeUnexpectedErrorPage();
    	}
	}

	/*******************************************************
    /                 Page ACCEUIL
    /*******************************************************/

	public function makeHomePage() {
        $this->title = "Bienvenue sur Notre Site !";
        $this->content = "<br>";
        $this->content .= "<p>Ce site Porte sur Les Téléphones.</p>";

        $this->content .= "<p>Vous pouvez visualiser les téléphones déja crées par d'autres utilisateurs dans Galerie sans avoir accès aux pages individuelles de ces téléphones puisque vous n'etes désormais pas connecté. </p>";

        $this->content .= "<p>Si jamais vous vous demander si vous pouvez en créer vous aussi vos propres téléphones ... Oui, celà est possible, il vous suffit juste de vous inscrire si ce n'est pas déja fait et vous connecter.</p>";

        $this->content .= "<p>En tant qu'Utilisateur connecté vous aurez la possibilité de supprimer ou modifier vos propres téléphones. Et voir les détails sur les téléphones crées par d'autres utilisateurs.</p>";
        $this->content .= "<p>Et aussi vous aurez accès à une barre de recherche qui vous affichera tous les téléphones appartenant à une marque que auriez saisi au préalable en entrée. Ajouter à ça vous aurez la possibilité de visionner la liste des téléphones ordonnée dans un ordre décroissant de leurs prix .<p>";
        $this->content .= "Nous vous souhaitons un Agréable moment sur Notre site !";

    }
	/*******************************************************
    /                 Page TEST
    /*******************************************************/

    public function makeTestPage(){
		$this->title = "Test";
		$this->content = "Bla Bla Bla";
	}

    /*******************************************************
    /                 Page Téléphone
    /*******************************************************/

    public function makePhonePage($phone){ 
        $this->title = $phone->getNom();
        $this->content = "Le Téléphone ".$phone->getNom()." est un ".$phone->getCategorie()." ".$phone->getSystemeExploitation().".<br>";
        $this->content .= "Il est Fabriqué en ".$phone->getPaysDeFabrication()." en ".$phone->getAnneeDeSortie().".<br>"."<br>";
        $this->content .= "<font color='red'><u>Ses Caractéristiques</u> :</font>";
        $this->content .= "<ul>\n";
        $this->content .="<li>Marque : ".$phone->getMarque().".";
        $this->content .="<li>Prix :".$phone->getPrix()."€";
        $this->content .="<li> Stockage : ".$phone->getStockage()."GO";
        $this->content .="<li> RAM : ".$phone->getRAM()."GO";
        $this->content .="<li> Durée de la Batterie : ".$phone->getDureeBatterie()."mAh";
        $this->content .="<li> Taille de l'Ecran : ".$phone->getTailleEcran()." pouces";
        $this->content .="<li> Couleurs Diponibles : ".$phone->getCouleur();
        $this->content .= "</ul>\n";
        $this->content .= "<br>\n";



        $id = key_exists('id', $_GET)? $_GET['id']: null;
        $this->content .= "<ul>\n";
        $this->content .= '<li><a href="'.$this->router->getPhoneAskModifyURL($id).'">Modifier</a></li>'."\n";
        $this->content .= '<li><a href="'.$this->router->getPhoneAskDeletionURL($id).'">Supprimer</a></li>'."\n";
        $this->content .= "</ul>\n";
    }
	

	/*******************************************************
    /                 Page Téléphone Inconnu
    /*******************************************************/

    public function makeUnknownPhonePage(){
		$this->title = "Erreur";
		$this->content = "Animal Inconnu";
	}

	/*******************************************************
    /                 Page Debug
    /*******************************************************/

	public function makeDebugPage($variable) {
		$this->title = 'Debug';
		$this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
	}

	/*******************************************************
    /                 Page Action Inconnu
    /*******************************************************/

	public function makeUnknownActionPage() {
		$this->title = "Erreur";
		$this->content = "La page demandée n'existe pas.";
	}

	/*******************************************************
    /                 Page ERROR
    /*******************************************************/

	public function makeUnexpectedErrorPage(Exception $e=null){
        $this->title = "Erreur";
        $this->content = "Une erreur inattendue s'est produite.";
    }

     /*******************************************************
    /                 Page A Propos
    /*******************************************************/

    public function makeAproposPage(){
        $this->title = "A propos du Site ";
        $this->content = "<p>Ce site est réalisé par : </p>
                            <ul>
                                <li>Issa Abakar Issa  ---> 21714681</li>
                                <li>Sy Cheikh         ---> 21910804</li>
                                <li>Cherat Fatma      ---> 21913509</li>
                                <li>Mbaye Ramatoulaye ---> 21913539</li>
                            </ul>

                            <h2>Les Points Réalisés : </h2>
                            Ce site nous présente des téléphones , leur marque, modèle, et autres caracteristiques. Il a été réalisé en groupe et présente les fonctionnalités suivantes :<br/>
                                <ul>
                                <li><strong><font color='blue'>Un simple internaute</font></strong> peut naviguer sur le site et voir la gallerie de téléphones présents sans avoir accès aux  détails. Pour le faire il faudra qu'il s'incrive et qu'il se connecte.</li>
                                <li><strong><font color='blue'>L'utilisateur connecté</font></strong> a la possibilité de créer ses propres téléphones, de les supprimer ou les modifier. Par contre concernant les téléphones des autres utilisateurs il ne peut que les visualiser (ne peut ni les modifier ni les supprimer). </li>
                                </ul>
                                <br>
                            Sur le point visuel, on peut constater deux interfaces différentes : 
                                <ul>
                                <li><strong><font color='blue'> Un simple internaute</font></strong> voit apparaitre sur le menu du site 4 boutons (Acceuil, Galerie, Se Connecter, A propos).
                                <li><strong><font color='blue'>Un utilisateur connecté</font></strong> a sur son menu 8 boutons (Acceuil, Galerie, Mes Téléphones, Nouveau Téléphone, Rechercher, Tri Par Prix, Se Déconnecter, A propos) .
                                </ul>

                            <h2>Nos choix en matière de design, modélisation et code</h2>
                            <p> Notre code s'est basé sur les principes de l'Architecture MVCR vu lors des CM/TP.</p>
                            <p> Pour Aspect Design, Nous avons fait un peu de CSS pour donner une forme plus jolie à nos pages. (On a ajouter un menu pour rendre nos pages accessibles plus facilement).

                            <h2>Les Compléments Réalisés :</h2>
                            <p> Nous avons décidé de faire de notre site un Site responsive. Pour permettre aux utilisateurs de naviguer sur celui-ci depuis leur téléphones de façon plus pratique (Un site qui varie selon la taille de l'écran) .</p>
                            <p> Nous avons aussi Créer une barre de recherche qui se trouve dans le bouton rechercher. Ou l'utilisateur pourra afficher tous les téléphones appartenant à une certaine marque qu'il saisi en entrée dans la barre de recherche.</p>
                            <p> Et enfin nous avons décidé de créer une autre page qui affichera les téléphones par ordre décroissant de leur prix. Car on a considéré qu'il est efficace pour l'utilisateur d'avoir la liste des téléphones ordonnée (du plus cher au moins cher) sous ses yeux.</p>




                            ";

                                  
    }
    /*******************************************************
    /                 Page ACCES Interdit
    /*******************************************************/

    public function makeNotPossibleToShowPage(){
        $this->title = "Oups Sorry :(";
        $this->content = "Vous n'avez pas accès à ce contenu car vous n'etes pas connecté !<br>";
        $this->content .= "Connectez-vous si vous voulez avoir accès !";

    }



	/*******************************************************
    /                 Page Liste Téléphone
    /*******************************************************/

	public function makeListPage(array $phones){
		$this->title = "Galerie de Téléphones ";
		$this->content = "Cliquer sur un téléphone pour plus de détails."."<br>";
		foreach ($phones as $id => $p) {
			$res = '<a href="?id='.$this->router->getPhoneURL($id).'">'.$p->getNom().'</a>'.'<br>';
			$this->content .=$res;
		}
	}

	

	
	/*******************************************************
    /                 Page Connexion
    /*******************************************************/

    public function makeLoginFormPage(){
		$this->title = "Page de connexion";
		$this->content = $this->makeAutentificationForm();
	}

	public function makeAutentificationForm() {
		return '<form method="post" action ="'.$this->router->getConnectedUrl().'">'
                    .'<label><span class = "label" >Login: </span><input type = "text" name = "login"/></label><br/><br/> '
                    .'<label><span class ="label" >Password: </span><input type = "password" name = "mdp"/></label><br/> <br/>'
                    .'<input type ="submit" value= Connexion /> </form><br/>'
                    .'<a class ="ins" href ="'.$this->router->getSigInUrl().'"> Pas de compte? Inscrivez vous</a>';
    }

    /*******************************************************
    /                 Page Inscription
    /*******************************************************/

  	public function makeSigInPage(AccountBuilder $accountBuilder){
        $this->title = "Inscription";
        $this->content = $this->getSigInForm($accountBuilder);
    }


    public function getSigInForm(AccountBuilder $accountBuilder){
        $data = $accountBuilder->getData();
        $error=$accountBuilder->getError();

        return '<form method="post" action ='.$this->router->getSaveNewUserUrl().'>'
                .'<label><span class = label>Nom: </span><input type = "text" name = "name" value="'.$data["name"].'"></label><span class ="error">'.$error["name"].'</span><br/><br/>'
                 .'<label><span class = label>Login : </span><input type = "text" name = "login" value="'.$data["login"].'"></label><span class ="error">'.$error["login"].'</span><br/><br/>'
                .'<label><span class = label>Password : </span><input type = "password" name = "mdp"><span class ="error">'.$error["mdp"].'</span><br/><br/>'
                .'<input type ="submit" value= Valider /> </form>';
        }

    /*******************************************************
    /                 DISPLAY
    /*******************************************************/

	public function displayUserCreationSuccess(){
        $feedback = "Votre compte a été crée! Connectez vous!";
        $this->router->POSTredirect($this->router->getLoginUrl(),$feedback);
    }

    public function displayUserCreationFailure(){
        $feedback = "Erreur renseignez bien les Champs";
        $this->router->POSTredirect($this->router->getSigInUrl(),$feedback);
    }

    public function displayUserLoginUsed(){
        $feedback = "Erreur le login utilisé existe déja !";
        $this->router->POSTredirect($this->router->getSigInUrl(),$feedback);
    }

    public function displayConnected($user) {
        $feedback = 'Bienvenue '.$user->getName() .' !';
        $this->router->POSTredirect($this->router->gethomePageURL(),$feedback);
    }

    public function displayLoginIncorrect(){
        $feedback = "Login ou mot de passe incorrecte";
        $this->router->POSTredirect($this->router->getLoginUrl(),$feedback);
    }	


    public function displayDisconnectedPage(){
        $feedback = "Vous êtes deconnecté À Bientot!";
        $this->router->POSTredirect($this->router->gethomePageURL(),$feedback);
    }

    public function displayNotConnected(){
        $feedback = "Veuillez d'abord vous connecter!";
        $this->routeur->POSTredirect($this->routeur->getLoginUrl(),$feedback);
    }
}


?>