<?php 
require_once('model/Phone.php');
require_once("control/Controller.php");
require_once('model/PhoneStorageStub.php');
require_once('model/PhoneStorageMySQL.php');

require_once('lib/ObjectFileDB.php');

require_once("model/PhoneBuilder.php");
require_once("model/Account.php");

class PrivateView extends View {

	private $title;
	private $content;
	private $router;

	private $feedback;
	private $menu;

	private $user;
	private $x;

	/*******************************************************
    /                 Constructeur
    /*******************************************************/

	public function __construct(Router $router,$feedback,Account $user){
  		$this->title = null;
  		$this->content = null;
  		$this->router = $router;
  		$this->feedback = $feedback;
  			$this->menu = array(
			"Accueil" => $this->router->gethomePageURL(),
			"Galerie" => $this->router->getListeURL(),
			"Mes Téléphones" => $this->router->getUserPhoneListe(),
			"Nouveau Téléphone" => $this->router->getPhoneCreationURL(),
			"Rechercher" => $this->router->getSearchPageURL(),
			"Tri Par Prix" => $this->router->getTriPageURL(),
			"Se déconnecter"=> $this->router->getPageUserURL(),
			"A Propos" => $this->router->getAproposPageURL(),
		);
		$this->user = $user;
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
		$this->content .="<li>Prix : ".$phone->getPrix()."€";
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
    /                 Page Liste Téléphone
    /*******************************************************/

	public function makeListPage(array $phones){
		$this->title = "Galerie de Téléphones ";
		$this->content = "Cliquer sur un téléphone pour plus de détails."."<br>"."<br>";
		foreach ($phones as $id => $p) {
			$res = '<a href="?id='.$this->router->getPhoneURL($id).'">'.$p->getNom().'</a>'.'<br>';
			$this->content .=$res;
		}
	}

	/*******************************************************
    /                 Page Création Téléphone
    /*******************************************************/

    public function makePhoneCreationPage(PhoneBuilder $builder){
   
    	$this->title = "Ajouter Un Téléphone";
		$s = '<form action="'.$this->router->getPhoneSaveURL().'" method="POST">'."\n";
    	$s .= $this->getFormFields($builder);
		$s .= "<button>Créer</button>\n";
		$s .= "</form>\n";
    	$this->content = $s;
  	}


  	public function getFormFields(PhoneBuilder $builder){
  		//NOM
  		$nomRef = $builder->getNomRef();
		$ch = "";

		$ch .= '<p><label>Nom : <input type="text" name= "nom"  value="';
		//garder ce que l'utilisateur a entrer meme si faut 
		$ch.= self::htmlesc($builder->getData($nomRef));
		$ch .= "\" />";
		$err=$builder->getError($nomRef);
		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";

		//MARQUE
		$marqueRef = $builder->getMarqueRef();
		$ch .= '<p><label>Marque : <input type="text" name="marque" value="';
		$ch.= self::htmlesc($builder->getData($marqueRef));
		$ch .= "\" />";
		$err=$builder->getError($marqueRef);
		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//MODELE
		$modeleRef = $builder->getModeleRef();
		$ch .= '<p><label>Modèle : <input type="text" name="modele" value="';
		$ch.= self::htmlesc($builder->getData($modeleRef));
		$ch .= "\" />";
		$err=$builder->getError($modeleRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//CATEGORIE
		$categorieRef = $builder->getCategorieRef();
		$ch .= '<p><label>Catégorie : <input type="text" name="categorie" value="';
		$ch.= self::htmlesc($builder->getData($categorieRef));
		$ch .= "\" />";
		$err=$builder->getError($categorieRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//SE
		$systemeExploitationRef = $builder->getSystemeExploitationRef();
		$ch .= '<p><label>Système Exploitation : <input type="text" name="systemeExploitation" value="';
		$ch.= self::htmlesc($builder->getData($systemeExploitationRef));
		$ch .= "\" />";
		$err=$builder->getError($systemeExploitationRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//PAYS
		$paysDeFabricationRef = $builder->getPaysDeFabricationRef();
		$ch .= '<p><label>Pays de Fabrication : <input type="text" name="paysDeFabrication" value="';
		$ch.= self::htmlesc($builder->getData($paysDeFabricationRef));
		$ch .= "\" />";
		$err=$builder->getError($paysDeFabricationRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//ANNEE
		$anneeDeSortieRef = $builder->getAnneeDeSortieRef();
		$ch .= '<p><label>Année De Sortie : <input type="text" name="anneeDeSortie" value="';
		$ch.= self::htmlesc($builder->getData($anneeDeSortieRef));
		$ch .= "\" />";
		$err=$builder->getError($anneeDeSortieRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//PRIX
		$prixRef = $builder->getPrixRef();
		$ch .= '<p><label>Prix (en €) : <input type="text" name="prix" value="';
		$ch.= self::htmlesc($builder->getData($prixRef));
		$ch .= "\" />";
		$err=$builder->getError($prixRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//STOCKAGE
		$stockageRef = $builder->getStockageRef();
		$ch .= '<p><label>Stockage (en GO) : <input type="text" name="stockage" value="';
		$ch.= self::htmlesc($builder->getData($stockageRef));
		$ch .= "\" />";
		$err=$builder->getError($stockageRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//RAM
		$RAMRef = $builder->getRAMRef();
		$ch .= '<p><label>RAM (en GO): <input type="text" name="RAM" value="';
		$ch.= self::htmlesc($builder->getData($RAMRef));
		$ch .= "\" />";
		$err=$builder->getError($RAMRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//BATTERIE
		$dureeBatterieRef = $builder->getDureeBatterieRef();
		$ch .= '<p><label>Durée de la Batterie (en mAh) : <input type="text" name="dureeBatterie" value="';
		$ch.= self::htmlesc($builder->getData($dureeBatterieRef));
		$ch .= "\" />";
		$err=$builder->getError($dureeBatterieRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//ECRAN
		$tailleEcranRef = $builder->getTailleEcranRef();
		$ch .= '<p><label>Taille Écran (en pouces): <input type="text" name="tailleEcran" value="';
		$ch.= self::htmlesc($builder->getData($modeleRef));
		$ch .= "\" />";
		$err=$builder->getError($modeleRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


		//Couleurs
		$couleurRef = $builder->getCouleurRef();
		$ch .= '<p><label>Couleurs Disponibles (séparées par des virgules) : <input type="text" name="couleur" value="';
		$ch.= self::htmlesc($builder->getData($couleurRef));
		$ch .= "\" />";
		$err=$builder->getError($couleurRef);

		if ($err !== null)
			$ch .= ' <span class="error">'.$err.'</span>';
		$ch .="</label></p>\n";


    	return $ch;
    }

    public static function htmlesc($str) {
		return htmlspecialchars($str,
			/* on échappe guillemets _et_ apostrophes : */
			ENT_QUOTES
			/* les séquences UTF-8 invalides sont
			* remplacées par le caractère �
			* au lieu de renvoyer la chaîne vide…) */
			| ENT_SUBSTITUTE
			/* on utilise les entités HTML5 (en particulier &apos;) */
			| ENT_HTML5,
			'UTF-8');
	}

	/*******************************************************
    /                 Page Suppression Téléphone
    /*******************************************************/
	
	public function makePhoneDeletionPage($id){
		 
		$this->title = "Suppression du Téléphone";
		$this->content = "<p>Le téléphone va etre supprimer !!!</p>\n";
		$this->content .= '<form action="'.$this->router->getPhoneDeletionURL($id).'" method="POST">'."\n";
		$this->content .= "<button>Confirmer</button>\n";
		$this->content .= "</form>\n";
	}

	public function makeAnimalDeletedPage() {
		$this->title = "Suppression effectuée";
		$this->content = "Le Téléphone a été correctement supprimée.";
	}

	/*******************************************************
    /                 Page Modification Téléphone
    /*******************************************************/
	
	public function makePhoneModifPage($id, PhoneBuilder $builder) {
		$this->title = "Modifier Votre Téléphone";

		$this->content = '<form action="'.$this->router->getPhoneModifiedPageURL($id).'" method="POST">'."\n";
		$this->content .= self::getFormFields($builder);
		$this->content .= '<button>Modifier</button>'."\n";
		$this->content .= '</form>'."\n";
	}

	/*******************************************************
	/				Deconnexion
    /*******************************************************/

    public function makeDisconnectionPage(){
          $this->title = "Déconnexion";
          $this->content = "<p>Si Vous voulez vous Déconnecter Veuillez appuyer sur le bouton en bas !</p>";
          $this->content .= $this->makeDisconnectionForm();
    }

    public function makeDisconnectionForm(){
        return '<form method = "post" action = '.$this->router->getDeconnexionPageURL().'>'
                   .'<input type ="submit" value= Déconnexion </input> </form><br/>';
    }


    /*******************************************************
	/				DISPALY CREATION
    /*******************************************************/

    public function displayPhoneCreationSuccess($id){
		$feedback = "Le téléphone a bien été créée !";
		$this->router->POSTredirect($this->router->gethomePageURL().'?id='.$id,$feedback);
	}

	public function displayPhoneCreationFailure(){
		$feedback = "Erreurs dans le formulaire";
		$this->router->POSTredirect($this->router->getPhoneCreationURL(),$feedback);
	}

	/*******************************************************
	/				DISPALY SUPPRESSION
    /*******************************************************/

    public function displayPhoneDeletionSuccess(){
		$feedback = "Le téléphone a bien été supprimée !";
		$this->router->POSTredirect($this->router->POSTredirect($this->router->getListeURL(),$feedback));
	}

	/*******************************************************
	/				DISPALY MODIFICATION
    /*******************************************************/

    public function displayPhoneModificationSuccess($id){
		$feedback = "Le Téléphone a bien été modifié !";
		$this->router->POSTredirect($this->router->POSTredirect($this->router->gethomePageURL().'?id='.$id,$feedback));
	}

	public function displayPhoneModificationFailure($id,$pb){
		$feedback = "Erreurs dans le formulaire";
		$this->router->POSTredirect($this->router->getPhoneCreationURL(),$feedback);
	}


	/*******************************************************
	/				DISPALY ACCOUNT
    /*******************************************************/

    public function displayConnected($user) {
        $feedback = 'Bienvenue '.$user->getName() .' !';
        $this->router->POSTredirect($this->router->gethomePageURL(),$feedback);
    }

    public function displayDisconnectedPage(){
        $feedback = "Vous êtes deconnecté À Bientot!";
        $this->router->POSTredirect($this->router->gethomePageURL(),$feedback);
    }

    public function displayNotConnected(){
        $feedback = "Veuillez d'abord vous connecter!";
        $this->router->POSTredirect($this->router->getLoginUrl(),$feedback);
    }


    public function displayCantModify($id){
        $feedback = "Vous ne pouvez pas modifier un téléphone qui ne vous appartient pas";
        $this->router->POSTredirect('?id='.$id,$feedback);
    }

    public function displayCantDelete($id){
        $feedback = "Vous ne pouvez supprimer que vos propres Téléphones";
        $this->router->POSTredirect('?id='.$id.'&action=supprimer',$feedback);
    }





    public function makeSearchPage(){
    	$this->title = "Rechercher un Téléphone Par Marque";
    	$this->content = "Saisissez La marque de téléphone que vous recherchez et cliquer sur envoyer. <br>"; 
    	$this->content .= "Tout les téléphones de cette marque vous seront affichés. <br><br>";
    	$this->content .= "<font color=blue> Exemple de Marque de téléphones :</font> Samsung, iPhone, ...<br><br>";
    	$this->content .= '<form method="post">';
    	$this->content .= '<label>Search</label> ';
    	$this->content .= '<input type="text" name="search">';
    	$this->content .= '<input type="submit" name="submit">';
    }


    public function makeTriPrixPage(){
    	$this->title = "Tri des Téléphones selon le Prix";
    	$this->content = "Voici la Liste des téléphones triée par ordre décroissant de leurs Prix.";
    }

    

    



}

?>
