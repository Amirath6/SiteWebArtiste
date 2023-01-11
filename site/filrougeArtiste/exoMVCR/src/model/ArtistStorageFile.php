<?php
/**
 * Définition de la classe ArtistStorageFile qui contiendra l'instance de 
 * ObjectFileDB qui va servir à enregistrer la « base ». 
 * 
 * @author OROU-GUIDOU Amirath Fara, 22012235
 * 
 * @institute Université de Caen Normandie
 */
require_once("src/lib/ObjectFileDB.php");
require_once("src/model/Artist.php");
require_once("src/model/ArtistStorage.php");


class ArtistStorageFile implements ArtistStorage{

    /* Attribut de la classe 
    * le ObjectFileDB dans lequel l'instance est enregistrée 
    */
    private $db;

    /**
     * Constructeur de la classe
     * Construit une nouvelle instance, qui utilise le fichier donné
     * en paramètre
     * @param file le nom du fichier dans lequel les données sont sérialisées
     */
    public function __construct($file){
        $this->db = new ObjectFileDB($file);
    }


    /**
     * Insère un(e) nouveau(elle) artiste dans la base. Renvoie l'identifiant
     * d'une nouvelle artiste. 
     * @param a l'artiste à insérer
     */
    public function create(Artist $a) {
        return $this->db->insert($a);
    }

    /**
     * Définition d'une méthode reinit() qui remet la base dans l'état « initial »
     * $artist, $nomDeNaissance, $prenomDeNaissance, $anneeDeNaissance, $villeDeNaissance, $genreMusic, $year, $album, $styleDeMusique, $image
     */
    public function reinit(){
        $this->db-> deleteAll();
        $artistTab = array(
            "01" => new Artist("Dadju", "Nsungula", "Dadju Djuna", "chanteur", "1991-05-02", "Bobigny", "Seine-Saint-Denis", "hip-pop", "2012-01-01", "Gentleman 2.0", "RnB Français", "daju", "dadju.jpg"),
        );
        foreach($artistTab as $key=>$value){
            $this->db->insert($value);
        }
    }

    /**
     * Méthode read() dont les implémentations doivent renvoyer 
     * l'instance de Artist ayant pour identifiant celui passé en argument, ou null si aucune artiste n'a cet identifiant
     * 
     * @param id l'identifiant de l'artiste à lire
     */
    public function read($id){
        if($this->db->exists($id)){
            return $this->db->fetch($id);
        }
        else{
            return null;
        }
    }

    /**
     * Méthode readAll(), dont les implémentations doivent renvoyer un tableau associatif identifiant ⇒ artiste contenant toutes les artistes de la « base ».
    */
    public function readAll(){
        return $this->db->fetchAll();
    }


    /* Met à jour une dans la base. Renvoie
	 * true si la modification a été effectuée, false
	 * si l'identifiant ne correspond à aucune artiste. */
	public function update($id, Artist $a) {
        if($this->db->exists($id)){
            $this->db->update($id, $a);
            return true;
        }
        return False;
    }

    /* Supprime une artiste dans la liste des artistes. Renvoie
	 * true si la suppression a été effectuée, false
	 * si l'identifiant ne correspond à aucune artiste. */
	public function delete($id){
        if ($this->db->exists($id)) {
			$this->db->delete($id);
			return true;
		}
		return false;
    }

    /* Vide la base. */
	public function deleteAll() {
        $this->db->deleteAll();
	}


}
