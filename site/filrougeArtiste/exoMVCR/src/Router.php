<?php

/*
 * Le routeur s'occupe d'analyser les requêtes HTTP
 * pour décider quoi faire et quoi afficher.
 * Il se contente de passer la main au contrôleur et
 * à la vue une fois qu'il a déterminé l'action à effectuer.
 * 
 */
 
set_include_path("view/View.php");
set_include_path("control/Controller.php");

require_once("view/View.php");
require_once("control/Controller.php");


class Router {
    protected $dir = '/groupe-4/filrougeArtiste/exoMVCR/';
    public function main($artistStorage) {
        
        session_start();
        $feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
        $_SESSION['feedback'] = '';
        $view = new View($this, $feedback);
        $controller = new Controller($view, $artistStorage);

        $action = null;
        $artistId = null;

        if (isset($_SERVER['PATH_INFO'])) {

            $artistId = strtok($_SERVER['PATH_INFO'], '/');
            $action = strtok('/');

            if(!is_numeric(($artistId))){
                $action = $artistId;
                $artistId = null;
            }

            if ($action === false){
                $action = null;
            }

            if ($action == null && $artistId == null) {
                // afficher la page d'accueil
                $view->makeHomePage();
            } 
            
            else if ($action === 'galerie') {
                // afficher la liste des artistes;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->showListSearch($_POST["search"]);
                }
                else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $controller->showList();
                }
				else{
                    $view->makeUnknownArtistPage();
                }
            } 
            
            else if ($action === 'nouveau') {
                // afficher le formulaire de création d'un nouveau artiste comme instance de la classe ArtistBuilder 
                $controller->newArtist();
            } 
            
            else if ($action === 'sauverNouveau') {
                // sauvegarder un nouveau artiste
                $controller->saveNewArtist($_POST);
            } 
            
            else if ($action === 'modifier'){
                if($artistId === null){
                    $view->makeUnexpectedErrorPage();
                }

                else{
                // afficher le formulaire de modification d'un artiste
                $controller->modifyArtist($artistId);
                }
            } 

            else if ($action === 'sauverModification'){
                // sauvegarder les modifications d'un artiste
                if($artistId === null){
                    $view->makeUnexpectedErrorPage();
                }else{
                    $controller->saveArtistModification($artistId, $_POST);
                }

            }
            
            else if ($action === 'supprimer') {
                // supprimer un artiste
                if($artistId === null){
                    $view->makeUnexpectedErrorPage();
                }else{
                    $controller->deleteArtist($artistId);
                }
            } 
            
            else if ($action === 'confirmationSuppression') {
                // afficher la page de confirmation de suppression
                if($artistId === null){
                    $view->makeUnexpectedErrorPage();
                }else{
                     $controller->askArtistDeletion($artistId);
                }
            } else if ($action === 'about') {
                // afficher la page à propos
                $view->makeAboutPage();
            } else {
                // afficher la page d'erreur
                if($artistId === null){
                    $view->makeUnexpectedErrorPage();
                }
                
                else{
                    // afficher la page d'information d'un artiste
                     $controller->showInformation($artistId);
                }
            }
        } else {
            // afficher la page d'accueil
            $view->makeHomePage();
        }

        $view->render();
    }

    /* URL de la page d'accueil */
    public function getHomeURL() {
        return $this->dir . 'artists.php';
    }

    /* URL de la page de l'affichage des listes des artists */
    public function getArtistListURL() {
        return $this->dir . 'artists.php/galerie';
    }

    /* URL de la page de l'Artist d'identifiant $id */
    function getArtistURL($id){
        return  $this->dir . 'artists.php/' . $id;
    }

    /* URL de la page pour la création  d'un Artist */
    function getArtistCreationURL(){
        return $this->dir . 'artists.php/nouveau';
    }

    /* URL de la page pour la sauvegarde de la création*/
    function getArtistSaveURL(){
        return $this->dir . 'artists.php/sauverNouveau';
    }

    /* URL de la page d'édition d'un Artist existant */
    public function getArtistModifPageURL($id){
        return $this->dir . 'artists.php/' . $id . '/modifier';
    }

    /* URL d'enregistrement des modifications sur un
	 * Artist (champ 'action' du formulaire) */
    public function updateModifiedArtist($id) {
        return $this->dir . 'artists.php/' . $id . '/sauverModification';
    }

    /* URL de la page supprimant effectivement l'Artist*/
    function getArtistDeletionURL($id){
        return $this->dir . 'artists.php/' . $id . '/supprimer';
    }

    /*  URL de la page demandant à l'internaute de confirmer son souhait de supprimer l'Artist */
    function getArtistAskDeletionURL($id){
        return $this->dir . 'artists.php/' . $id . '/confirmationSuppression';
    }

    /* URL de la page about */
    function getAboutURL(){
        return $this->dir . 'artists.php/about';
    }


    /**
     * Ajout d'une méthode POSTredirect qui envoie une réponse HTTP de type 303 See Other
     * demandant au client de se rediriger vers l'URL passée en argument
    */
    public function POSTredirect($url,$feedback){
        $_SESSION['feedback'] = $feedback;
        header("Location: ".htmlspecialchars_decode($url),true,303);
        die;
    }
}
