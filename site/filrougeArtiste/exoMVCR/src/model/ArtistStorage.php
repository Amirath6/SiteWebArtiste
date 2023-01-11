<?php

/**
 * Définition de l'interface ArtistStorage
 * 
 * @author OROU-GUIDOU Amirath Fara, 22012235
 * 
 * @institut Universite de Caen Normandie 
 * 
 */
require_once("src/model/Artist.php");

interface ArtistStorage{

   /******************************************************************************
    * Déclaration des méthodes
    *****************************************************************************/
    /**
     * Insère un/une nouveau/elle artiste dans la base. Renvoie l'identifiant
     * d'un/une nouveau/elle artiste. 
     * @param a l'artiste à insérer
     */
   public function create(Artist $a);
    
    /**
     * Méthode read() dont les implémentations doivent renvoyer 
     * l'instance de musique ayant pour identifiant celui passé en argument, ou null si aucun(e) artiste n'a cet identifiant
     * c
     * @param id l'identifiant de l'artist à lire
     */
     
   public function read($id);

    /**
     * Méthode readAll(), dont les implémentations doivent renvoyer un tableau associatif identifiant ⇒ artiste contenant tous les artistes de la « base ».
    */
   public function readAll();

    /* Met à jour un/une artiste dans la base. Renvoie
	 * true si la modification a été effectuée, false
	 * si l'identifiant ne correspond à aucun(e) artiste. */
	public function update($id, Artist $a);

    /* Supprime une musique. Renvoie
	 * true si la suppression a été effectuée, false
	 * si l'identifiant ne correspond à aucun(e) artist. */
	public function delete($id);

   /* Vide la base */
   public function deleteAll();


}

