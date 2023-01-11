<?php

    /**
     * Définition de la classe Controller
     * @author OROU-GUIDOU Amirath Fara, 22012235
     * @institute Universite de Caen Normandie
     */

    /* Inclusion des classes nécessaires */
    require_once("src/model/Artist.php");
    require_once("src/model/ArtistStorage.php");
    require_once("src/model/ArtistBuilder.php");
    require_once("src/view/View.php");


    
    class Controller{
        /* Attribut de la classe */

        protected $view;

        protected $artistStorage;

        protected $currentArtistBuilder;

        protected $modifiedArtistBuilders;

        /**
         * Constructeur de la classe
         */

        public function __construct(View $view, ArtistStorage $artistStorage){
            $this->view = $view;
            $this->artistStorage =$artistStorage;
      
            $this->currentArtistBuilder = key_exists('currentArtistBuilder', $_SESSION) ? $_SESSION['currentArtistBuilder'] : null;
            $this->modifiedArtistBuilders = key_exists('modifiedArtistBuilders', $_SESSION) ? $_SESSION['modifiedArtistBuilders'] : array();
        }

        public function __destruct() {
            $_SESSION['currentArtistBuilder'] = $this->currentArtistBuilder;
            $_SESSION['modifiedArtistBuilders'] = $this->modifiedArtistBuilders;
        }

        /**
         * Accesseur de la classe
         * Méthode getView()
         * @return view
         */

        public function getView(){
            return $this->view;
        }

        /**
         * Accesseur de la classe
         * Méthode getArtistStorage()
         * @return artistStorage
         */

        public function getArtistStorage(){
            return $this->artistStorage;
        }

        /**
         * Défintion de la méthode showInformation pour l'affichage de l'information
         * @param id l'identifiant de l'information
         */

        public function showInformation($id){
            /* Un Artist est demandé dans la base */
            $storage = $this->artistStorage->read($id);
            if ($storage === null) {
                /* La couleur n'existe pas dans la base */
                $this->view->makeUnknownArtistPage();
                //$this->view->makeDebugPage($storage);
            } else {
                $this->view->makeArtistPage($id, $storage);
            }
        }

        /**
         * Définition de la méthode showList pour l'affichage de la liste des animaux
         */

        public function showList(){
            $artists = $this->artistStorage->readAll();
            $this->view->makeListPage($artists);
        }
        
        /**
         * Définition de la méthode showListSearch pour la recherche d'un artiste
         */
        public function showListSearch($post){
            $artists = $this->artistStorage->readAll();
            $resFinal = array();
            foreach($artists as $artist => $value){
                if (preg_match("/" . $post . "/", $value->getArtist())){
                    $resFinal[$artist] = $value;
                }
            }
            $this->view->makeListPage($resFinal, count($resFinal) === 0);
        }
        /**
         * Création d'un nouvel Artist
        */
        public function newArtist() {
            /* Affichage du formulaire de création
            * avec les données par défaut. */

            if ($this->currentArtistBuilder === null) {
                $this->currentArtistBuilder = new ArtistBuilder();
            }
            $this->view->makeArtistCreationPage($this->currentArtistBuilder);
        }

        /**
         * Définition de la méthode saveNewArtist() qui se contente d'afficher son argument grâce à makeDebugPage.
         * 
         * @param data la donnée
         */
        public function saveNewArtist(array $data){
            
            $this->currentArtistBuilder = new ArtistBuilder($data);
            if($this->currentArtistBuilder->isValid()){
            exit();

                /* On contruit le nouvel Artist */
                $artist = $this->currentArtistBuilder->createArtist();

                /* On l'ajoute en BD(bases de Données) */
                $artistId = $this->artistStorage->create($artist);

                /* On détruit le builder courant */
                $this->currentArtistBuilder = null;

                /* On rédirige vers la page du nouvel Artist */
                $this->view->displayArtistCreationSuccess($artistId);
            }

            else{
                $this->view->displayArtistCreationFailure();
            }
        }

        /**
         * Définition de la méthode deleteArtist() pour la suppression de l'Artist
         * 
         * @param idA l'identifiant de l'Artist
         */
        public function deleteArtist($idA){
            /* On récupère l'Artist dans la base */
            $artist = $this->artistStorage->read($idA);
            if($artist === null){
                $this->view->makeUnknownArtistPage();
            }
            else{
                $this->view->makeArtistDeletionPage($idA, $artist);
            }
        }

        /**
         * Définition d'une méthode askArtistDeletion demandant à l'internaute de confirmer son souhait de supprimer l'Artist
         * 
         * @param idA l'identifiant de l'Artist
         */
        public function askArtistDeletion($idA){
            /* L'utilisateur confirme vouloir supprimer l'Artist*/
            $ok = $this->artistStorage->delete($idA);

            if(!$ok) {
                /* L'Artist n'existe pas dans la base */
                $this->view->makeUnknownArtistPage();
            }

            else{
                $this->view->makeArtistDeletedPage();
            }
        }

        /**
         * Définition d'une méthode pour la modification de l'Artist
         * @param artistId l'identifiant de l'Artist
         */
        public function modifyArtist($artistId){

            if(key_exists($artistId, $this->modifiedArtistBuilders)){
                /* Préparation de la Page de formulaire */
                $this->view->makeArtistModifPage($artistId, $this->modifiedArtistBuilders[$artistId]);
            }
            else{
                /* On récupère en BD l'Artist à modifier */
                $a = $this->artistStorage->read($artistId);

                if($a === null){
                    $this->view->makeUnknownArtistPage();
                }
                else{
                    $builder = ArtistBuilder::buildFromArtist($a);
                    $this->view->makeArtistModifPage($artistId, $builder);
                }
            }
        }

        /**
         * Défintion d'une méthode pour la sauvegarde de la modification de l'Artist
         * @param artistId l'identifiant de l'Artist
         * @param data la base de donnée dans laquelle on veut sauvegarder l'Artist
         */
        public function saveArtistModification($artistId, array $data){
            /* On récupère en BD l'Artist à modifier */
            $artist = $this->artistStorage->read($artistId);

            if($artist === null){
                /* L'Artist n'existe pas dans la base */
                $this->view->makeUnknownArtistPage();
            }
        else{
            $builder = new ArtistBuilder($data);

            /* Validation des données */
            if($builder->isValid()){
                $builder->updateArtist($artist);
                $ok = $this->artistStorage->update($artistId, $artist);
                if(!$ok){
                    throw new Exception("Identifier has disappeared?!");
                }

                /* Redirection vers la page d'Artist */
                unset($this->modifiedArtistBuilders[$artistId]);
                $this->view->displayArtistModifiedSuccess($artistId);
            }
            else{
                $this->modifiedArtistBuilders[$artistId] = $builder;
                $this->view->displayArtistModifiedFailure($artistId);
            }
        }
    }

}
