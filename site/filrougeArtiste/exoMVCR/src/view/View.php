<?php

/**
 * Définition de la classe View
 * 
 * @author OROU-GUIDOU Amirath Fara
 * 
 * @numeroEtudiant 22012235
 * 
 * @institute Université de Caen Normandie
 * 
 */
require_once("src/Router.php");
require_once("src/model/Artist.php");
require_once("src/model/ArtistBuilder.php");


class View{

    // Attributs de la classe
    protected $router;
    protected $title;
    protected $content;
    protected $feedback;
    


    public function __construct(Router $router, $feedback) {
		$this->router = $router;
        $this->feedback = $feedback;
		$this->title = null;
		$this->content = null;
	}

	
    /**
     * Défintion de la méthode render()
     * qui affiche une page HTML avec le contenu de ces attributs
     */

    public function render(){
        if ($this->title === null || $this->content === null) {
			$this->makeUnexpectedErrorPage();
        }
        $title = $this->title;
        $content = $this->content;
        $menu = array(
            "Accueil" => $this->router->getHomeURL(),
            'Liste des Artistes' => $this->router->getArtistListURL(),
            "Nouveau/velle Artiste" => $this->router->getArtistCreationURL(),
            "A propos" => $this->router->getAboutURL(),
        );
        include("Squelette.php");
        
    }


	/******************************************************************************/
	/* Méthodes de génération des pages                                           */
	/******************************************************************************/
    public function makeHomePage() {
		$this->title = "Bienvenue dans le monde des artistes" . "<br><br>";
        $this->content = "<strong>Un artiste </strong> est un individu faisant (une) œuvre, cultivant ou maîtrisant un art, un savoir, une technique, 
                            et dont on remarque entre autres la créativité, la poésie, l'originalité de sa production, de ses actes, de ses gestes.<br>
                            Ses œuvres sont source d'émotions, de sentiments, de réflexion, de spiritualité ou de transcendance.<br><br>
                            Les caractéristiques conférées à un artiste, et la notion en elle-même, sont particulièrement variables dans l'histoire et 
                            n'ont pas de définitions universelles (de même que pour l'art, un « faux concept » anhistorique). Ces définitions ont comme origine une expérience, 
                            une appréciation personnelle, un regard et sont la conséquence d'un intérêt collectif propre à une culture. De plus, la notion d'artiste – ou son absence – et 
                            l'imaginaire qui l'accompagne, est liée à l'idée de sujet et d'altérité chez un groupe humain, à une époque déterminée.<br><br>
                            Certains usages traditionnels distinguent l'artiste de l'artisan en se fondant sur la condition d'auteur, ou d'interprète, du premier. Soit un producteur de créations de 
                            l’esprit en opposition aux travailleurs manuels, aux exécutants anonymes, à ce qui est utile ou fonctionnel.<br>
                            J'appelle artiste celui qui crée des formes... et artisan celui qui les reproduit, quel que soit l'agrément ou l'imposture de son artisanat dira ainsi Malraux.<br>
                            Les artistes sont présents dans diverses activités: <br>
                            <ul>
                                <li>Acteur</li>
                                <li>Chanteur</li>
                                <li>Comédien</li>
                                <li>Compositeur</li>
                                <li>Danseur</li>
                                <li>Peintre</li>
                                <li>Photographe</li>
                                <li>Scénariste</li>
                                <li>Scénographe</li>
                                <li>Écrivain</li>
                                <li>etc...</li>
                            </ul>";
	}

    /**
     * Définition d'une méthode makeArtistPage() à View, 
     * qui génère l'affichage d'une page sur l'Artist passé en argument
     * 
     * @param id l'identifiant de l'Artist
     * @param a l'Artist elle même
     */ 

    public function makeArtistPage($id, Artist $a){
        $artist = self::htmlesc($a->getArtist()); 
        $nomDeNaissance = self::htmlesc($a->getNomDeNaissance());
        $prenomDeNaissance = self::htmlesc($a->getPrenomDeNaissance());
        $genreArtist = self::htmlesc($a->getGenreArtist());
        $genreArtiste = self::htmlesc($a->getGenreArtist());
        $anneeDeNaissance = new DateTime(self::htmlesc($a->getAnneeDeNaissance()));
        $villeDeNaissance = self::htmlesc($a->getVilleDeNaissance());
        $paysDeNaissance = self::htmlesc($a->getPaysDeNaissance());
        $genreMusic = self::htmlesc($a->getGenreMusic());
        $year = new DateTime(self::htmlesc($a->getYear()));
        $album = self::htmlesc($a->getAlbum());
        $styleDeMusique = self::htmlesc($a->getStyleDeMusique());
        // $aclass = "artist$id";
        $adatec = self::fmtDate($a->getCreationDate());
        $adatem = self::fmtDate($a->getModificationDate());
        $text = self::htmlesc($a->getText());
        $image = "/groupe-4/filrougeArtiste/exoMVCR/images/{$a->getImage()}";
        

        $this->title = "Un artiste nommé $artist"; 

        $s = "";
        $s .= "<h3>Informations sur l'artiste</h3>";
        $s .= "<figure>\n<img class='image' src=\"$image\" alt=\"$artist\" />\n";
        $s .= "<figcaption>$artist</figcaption>\n</figure>\n";
        $s .= "$artist de son vrai nom $nomDeNaissance $prenomDeNaissance est un/une $genreArtist. Il/elle est né(e) le " . $anneeDeNaissance->format("Y-m-d") . " à $villeDeNaissance en/au $paysDeNaissance.
        Il/elle est un(e) $genreArtist de $styleDeMusique français/africain et il/elle a débuté sa carrière d'artiste le " .  $year->format("Y-m-d") . " avec le genre de musique $genreMusic. Il/elle a sorti un album nommé $album. Il/elle est doué dans sa carrière d'artiste.";
        $s .= "<p>Il a été créé " . $adatec . " et modifié " . $adatem . "</p>\n";
        $s .= "<ul>\n";
        $s .= '<li><a href="'.$this->router->getArtistModifPageURL($id).'">Modifier</a></li>'."\n";
		$s .= '<li><a href="'.$this->router->getArtistDeletionURL($id).'">Supprimer</a></li>'."\n";
		$s .= "</ul>\n";
        $s .= "<h3>Texte de l'artiste</h3>";
        $s .= "<p>$text</p>";
        $this->content = $s; 
    }

    /**
    * Méthode makeUnknownArtistPage() pour l'affichage du message d'erreur
    */

    public function makeUnknownArtistPage(){
        $this->title = "Erreur";
		$this->content = "L'artiste demandé n'existe pas.";
    }

    /**
     * Définition de la méthode makeListPage() qui génère une page de liste des animaux
     */

    public function makeListPage(array $artists, $error=False){
        $this->title = "Tous les artistes";
        $this->content = "";
        $this->content .= "<form class=\"no-border\" action={$this->router->getArtistListURL()} method=\"POST\">"; 
        $this->content .= "<input type=\"text\" id=\"search\" name=\"search\" placeholder=\"Rechercher un artiste...\">";
        $this->content .= "<button class=\"button info\" type=\"submit\">Rechercher</button>";
        $this->content.= "</form>";
        $this->content .= "<p> Cliquer sur un/une artiste pour voir les détails.</p>\n";
        if ($error){
            $this->content .= "<p style=\"text-align:center\">Aucun artiste ne correspond à votre recherche.</p>\n";
        }
        else{
            $this->content .=  "<ul class =\"gallery\">\n";

            foreach($artists as $artist => $value){
                $this->content .= $this->galleryArtist($artist, $value);
            }
            $this->content .= "</ul>\n";
        }
        
    }

    /**
     * Définition d'une méthode makeUnknownList pour le message d'erreur
     */

    public function makeUnknownList(){
        $this->title = "Erreur";
        $this->content = "Il n'y a pas de liste d'atiste";
    }

    public function makeUnknownActionPage() {
		$this->title = "Erreur";
		$this->content = "La page demandée n'existe pas.";
	}

     /* Génère une page d'erreur inattendue. Peut optionnellement
	 * prendre l'exception qui a provoqué l'erreur
	 * en paramètre, mais n'en fait rien pour l'instant. */

    public function makeUnexpectedErrorPage(Exception $e=null){
		$this->title = "Erreur";
		$this->content = "Une erreur inattendue s'est produite." . "<pre>" . var_export($e) . "</pre>";
	}


    /**
     * Définition d'une méthode pour débuger la page
     * Elle va faciliter le debug en nous permettant d'afficher le contenu d'une variable. 
     * 
     * @param variable 
     */
    public function makeDebugPage($variable) {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
    }

    /***********************************************************************************
     * Création d'une nouvelle musique 
     ***********************************************************************************/

     /**
      * Définition d'une méthode makeArtistCreationPage() qui permettra d'afficher un formulaire de création d'un Artist
      * 
      */

    public function makeArtistCreationPage(ArtistBuilder $builder){
        $this->title = "Ajouter votre artiste";
        $s = '<form action="'.$this->router->getArtistSaveURL().'" method="POST">'."\n";
        $s .= self::getFormFields($builder);
        $s .= "<button>Créer</button>";
        $s .= "</form>\n";
        $this->content = $s;
    }

    /**
     * Définition d'une méthode displayArtistCreationPage() qui utilise la méthode créée ci-dessus pour rediriger le client vers la page de l'artist dont l'identifiant est passé en paramètre
     * @param id l'identifiant de l'artist
    */
    public function displayArtistCreationSuccess($id){
        $this->router->POSTredirect($this->router->getArtistURL($id), "L'artiste a bien été créé!");
    }

    /**
     * Définition d'une méthode displayArtistCreationError() qui permet d'afficher un message d'erreur si la création de l'artist a échoué et qui nous redirige vers la page de création d'un artist
     */
    public function displayArtistCreationFailure() {
		$this->router->POSTredirect($this->router->getArtistCreationURL(), "Erreurs dans le formulaire.");
	}


    /**
     * Définition d'une méthode makeArtistDeletionPage() qui permettra d'afficher un formulaire de suppression d'un artist
     * @param id l'identifiant de l'artist
     * @param a l'objet artist
     */

    public function makeArtistDeletionPage($id, Artist $a){
        $artist = self::htmlesc($a->getArtist());

        $this->title = "Suppression de l'artiste « {$artist} »";
        $this->content = "<p>L'artiste <strong> {$artist} </strong> va être supprimé.</p>\n";
        $this->content .= '<form action="' . $this->router->getArtistAskDeletionURL($id) . '" method="POST">' . "\n";
        $this->content .= "<button>Confirmer</button>\n</form>\n";
    }   

    /**
     * Définition d'une méthode makeArtistDeletedPage() qui permettra d'afficher un message de confirmation de suppression d'un artist
     */
    public function makeArtistDeletedPage() {
		$this->router->POSTredirect($this->router->getArtistListURL(), "L'artist a bien été supprimé !");
	}

    /**
     * Définition d'une méthode makeArtistModifPage() qui permettra d'afficher un formulaire de modification d'un artist
     * @param id l'identifiant de l'artist
     * @param builder l'objet ArtistBuilder
     */
    public function makeArtistModifPage($id, ArtistBuilder $builder){
        $this->title = "Modifier l'artiste";

        $this->content = '<form action="' . $this->router->updateModifiedArtist($id) . '" method="POST">' . "\n";
        $this->content .= self::getFormFields($builder);
        $this->content .= '<button>Modifier</button>' . "\n";
        $this->content .= '</form>' . "\n";
    }

    /**
     * Définition d'une méthode displayArtistModifSuccess() qui permet d'afficher un message de confirmation de modification d'un artist
     * @param id l'identifiant de l'artist
     */
    public function displayArtistModifiedSuccess($id){
        $this->router->POSTredirect($this->router->getArtistURL($id), "L'artiste a été bien modifié !");
    }

    /**
     * Définition d'une méthode displayArtistModifFailure() qui permet d'afficher un message d'erreur si la modification de l'artist a échoué et qui nous redirige vers la page de modification d'un artist
     * @param id l'identifiant de l'artist
     */
    public function displayArtistModifiedFailure($id){
        $this->router->POSTredirect($this->router->getArtistModifPageURL($id), "Erreurs dans le formulaire. ");
    }


    /* Définition de la function makeAboutPage() */
    public function makeAboutPage() {
        $this->title = "A propos";
        $this->content = "<strong><u>Nom de L'étudiant</u> : OROU-GUIDOU</strong><br><br>";
        $this->content .= "<strong><u>Prénom de L'étudiant</u> : Amirath Fara</strong><br><br>";
        $this->content .= "<strong><u>Numéro de l'étudiant</u> : 22012235</strong><br><br>";
        $this->content .= "<strong><u>Diplôme</u> : Licence 3 Informatique</strong><br><br>";
        $this->content .= "<strong><u>Groupe TD/TP</u> : 2B</strong><br>";
        $this->content .= "<p>Le but de ce site est de gérer des objets en PHP(ici les informations sur les artistes ou la description d'un artiste, son nom , date de naissance, son genre de musique l'année de début de sa carrière
        ...) et de créer un site respectant le modèle MVCR vu en cours et en TP.<br> J'ai intégrer les fonctionnalités suivantes :</p>";
        $this->content .= "<ul>";
        $this->content .= "<li>La Liste des artistes</li>";
        $this->content .= "<li>Création d'un artiste</li>";
        $this->content .= "<li>Modification d'un artiste</li>";
        $this->content .= "<li>Utilisation d'un builder pour la validation et la création d'un objet</li>";
        $this->content .= "<li>Suppression d'un artiste</li>";
        $this->content .= "<li>Redirection POST après creation/modification/suppression réussite ou echouer avec un message feedback(gestion du feedback)</li>";
        $this->content .= "<li>Utilisation d'une base de donnée MySql</li>";
        $this->content .= "</ul>";

        $this->content.= "<br><br>";
        $this->content .= "<strong><u>Optionnels réalisés</u> :</strong><br>";
        $this->content .= "<ul>";
        $this->content .= "<li>Routage via le chemin virtuel (PATH_INFO) dans les URL plutôt qu'avec des paramètres d'URL</li>";
        $this->content .= "<li>En plus de l'optionnel du path info j'ai aussi fait l'optionnel : possibilité de filtrer la liste des objets via un champ de recherche</li>";

        $this->content .= "</ul>";

        $this->content .= "<u>Notes :</u><br><br>";
        $this->content .= "Par rapport aux optionnels je voulais aussi faire celui de upload d'image mais je n'ai pas réussi à le faire.<br>
        J'ai essayé mais j'ai pas pu le faire fonctionner.<br> Mais par rapport à l'ajout d'un artiste au niveau de l'image, j'arrive à ajouter l'image mais les images qu'il faut mettre même si cela va être télécharger 
        sur internet doit être dans le dossier images dans le répertoire <strong><u>dm-tw4b-2022/filrougeArtiste/exoMVCR/images</u></strong> sinon cela ne fonctionne pas.<br> J'ai aussi mis des images dans le dossier upload pour que vous puissiez tester.<br> 
        Mais les images qui sont dans upload sont aussi dans le dossier images car quand j'envoi l'image de upload, l'image ne s'affiche pas parce qu'il ne retrouves pas le fichier dans la base.
        <br><br>";

        $this->content .= "<p style=\"text-align:center\"><strong><u>MERCI</u></strong></p>";

    }

    /******************************************************************************/
	/* Méthodes utilitaires                                                       */
	/******************************************************************************/
    /**
     * Méthode pour la gallery des artistes c'est à dire la liste des artistes
     * @param id l'identifiant de l'Artist
     * @param a l'Artist
     */
    protected function galleryArtist($id, $a){
        $res = '<li><a href="' . $this->router->getArtistURL($id).'">';
        $res .= '<h3>' . self::htmlesc($a->getArtist()). '</h3>';
        $res .= '</a></li>'."\n";
		return $res;
    }




    /**
     * Méthode getFormFields pour la forme de la page de création d'un nouvel Artist
     */
    protected function getFormFields(ArtistBuilder $builder){
        $artistRef = $builder->getArtistRef();
        $s = "";
        $s .= '<p><label>Artiste : <input type="text" name="' . $artistRef . '" value="';
        $s .= self::htmlesc($builder->getData($artistRef));
        $s .= "\" placeholder='ex:Dadju' />";
        $err = $builder->getErrors($artistRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $nomDeNaissanceRef = $builder->getNomDeNaissanceRef();
        $s .= '<p><label>Nom de naissance : <input type="text" name="' . $nomDeNaissanceRef . '" value="';
        $s .= self::htmlesc($builder->getData($nomDeNaissanceRef));
        $s .= "\" placeholder='ex:Nsungula'/>";
        $err = $builder->getErrors($nomDeNaissanceRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $prenomDeNaissanceRef = $builder->getPrenomDeNaissanceRef();
        $s .= '<p><label>Prénom de naissance : <input type="text" name="' . $prenomDeNaissanceRef . '" value="';
        $s .= self::htmlesc($builder->getData($prenomDeNaissanceRef));
        $s .= "\" placeholder='ex:Koffi' />";
        $err = $builder->getErrors($prenomDeNaissanceRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $genreArtistRef = $builder->getGenreArtistRef();
        $s .= '<p><label>Genre : <input type="text" name="' . $genreArtistRef . '" value="';
        $s .= self::htmlesc($builder->getData($genreArtistRef));
        $s .= "\" placeholder='ex:chanteur' />";
        $err = $builder->getErrors($genreArtistRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $anneeDeNaissanceRef = $builder->getAnneeDeNaissanceRef();
        $s .= '<p><label>Année de naissance : <input type="date" name="' . $anneeDeNaissanceRef . '" value="';
        $s .= self::htmlesc($builder->getData($anneeDeNaissanceRef));
        $s .= "\" />";
        $err = $builder->getErrors($anneeDeNaissanceRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $villeDeNaissanceRef = $builder->getVilleDeNaissanceRef();
        $s .= '<p><label>Ville de naissance : <input type="text" name="' . $villeDeNaissanceRef . '" value="';
        $s .= self::htmlesc($builder->getData($villeDeNaissanceRef));
        $s .= "\" placeholder='ex:Paris'/>";
        $err = $builder->getErrors($villeDeNaissanceRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $paysDeNaissanceRef = $builder->getPaysDeNaissanceRef();
        $s .= '<p><label>Pays de naissance : <input type="text" name="' . $paysDeNaissanceRef . '" value="';
        $s .= self::htmlesc($builder->getData($paysDeNaissanceRef));
        $s .= "\" placeholder='ex:France' />";
        $err = $builder->getErrors($paysDeNaissanceRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $genreMusicRef = $builder->getGenreMusicRef();
        $s .= '<p><label>Genre musical : <input type="text" name="' . $genreMusicRef . '" value="';
        $s .= self::htmlesc($builder->getData($genreMusicRef));
        $s .= "\" placeholder='ex:Rap'/>";
        $err = $builder->getErrors($genreMusicRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $yearRef = $builder->getYearRef();
        $s .= '<p><label>Année de début Carrière : <input type="date" name="' . $yearRef . '" value="';
        $s .= self::htmlesc($builder->getData($yearRef));
        $s .= "\" />";
        $err = $builder->getErrors($yearRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $albumRef = $builder->getAlbumRef();
        $s .= '<p><label>Album : <input type="text" name="' . $albumRef . '" value="';
        $s .= self::htmlesc($builder->getData($albumRef));
        $s .= "\" placeholder='ex:Gentleman 2.0'/>";
        $err = $builder->getErrors($albumRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $styleDeMusiqueRef = $builder->getStyleDeMusiqueRef();
        $s .= '<p><label>Style de musique : <input type="text" name="' . $styleDeMusiqueRef . '" value="';
        $s .= self::htmlesc($builder->getData($styleDeMusiqueRef));
        $s .= "\" placeholder='ex:Rnb'/>";
        $err = $builder->getErrors($styleDeMusiqueRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."\n";

        $imageRef = $builder->getImageRef();
        $s .= '<p><label>Image : <input type="file" name="' . $imageRef . '" accept="image/png,image/jpeg,image/jpg""';
        $s .= self::htmlesc($builder->getData($imageRef));
        $s .= "/>";
        $err = $builder->getErrors($imageRef);
        if ($err !== null)
            $s .= ' <span class="error">'.$err.'</span>';
        $s .= '</label></p>'."<br><br>";

        return $s;
    }

    /**
     * Fonction pour le format de la date
     * @param date la date
     */
    protected static function fmtDate(DateTime $date){
        return "Le " . $date->format("Y-m-d") . " à " . $date->format("H:i:s");
    }

    /* Une fonction pour échapper les caractères spéciaux de HTML,
	* car celle de PHP nécessite trop d'options. */
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
}

