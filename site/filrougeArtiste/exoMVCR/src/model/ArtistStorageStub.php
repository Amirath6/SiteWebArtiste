<?php

/**
 * Définition de la classe ArtistStorageStub. Une classe de démo de l'architecture. Une vraie BD ne contiendrait
 * évidemment pas directement des instances de Artist, il faudrait
 * les construire lors de la lecture en BD.
 * 
 */

class ArtistStorageStub implements ArtistStorage{

    /* Attribut de la classe */
    protected $db;    
    /**
     * Construction d'une instancee avec 4 artists
     */
    public function __construct(){
        $this->db = array(
            "01" => new Artist("Dadju", "Nsungula", "Dadju Djuna", "chanteur", "1991-05-02", "Bobigny", "Seine-Saint-Denis", "hip-pop", "2012-01-01", "Gentleman 2.0", "RnB Français", "daju", "dadju.jpg"),
        );
    }

    /**
     * Insère une nouvelle artiste dans la base. Renvoie l'identifiant
     * d'une nouvelle artiste. 
     * @param a l'artist à insérer
     */
    public function create(Artist $a){
        return $this->db = $a;
    }

    /**
     * Méthode read() dont les implémentations doivent renvoyer 
     * l'instance de artist ayant pour identifiant celui passé en argument, ou null si aucune artist n'a cet identifiant
     * c
     * @param id l'identifiant de la artist à lire
     */
     
    public function read($id){
        if (key_exists($id, $this->db)) {
			return $this->db[$id];
		}
		return null;
    }

   /**
    * Méthode readAll(), dont les implémentations doivent renvoyer un tableau associatif identifiant ⇒ artist contenant toutes les artists de la « base ».
   */
    public function readAll(){
        return $this->db;
    }

    /* Met à jour une artist dans la base. Renvoie
        * true si la modification a été effectuée, false
        * si l'identifiant ne correspond à aucune artist. */
    public function update($id, Artist $a){
    }

    /* Supprime une artist. Renvoie
        * true si la suppression a été effectuée, false
        * si l'identifiant ne correspond à aucune artist. */
    public function delete($id){
    }

    /* Vide la base */
    public function deleteAll(){
    }
}
