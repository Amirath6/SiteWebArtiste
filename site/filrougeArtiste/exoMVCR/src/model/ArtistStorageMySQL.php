<?php
    /** Définition de la classe ArtistStorageMySQL implementant l'interface ArtistStorage 
     * 
     * @author OROU-GUIDOU Amirath Fara, 22012235
     * 
     * @institute Universite de Caen Normandie
    */

    class ArtistStorageMySQL implements ArtistStorage {

        /* Attribut de la classe */
        private $database;
        /**
         * Constructeur de la classe ArtiststorageMySQL
         * @param pdo le PHP Data Objects 
         */
        public function __construct($pdo) {
            $this->database = $pdo;
        }

        /***************************************************************
         * Définition des méthodes de l'interface ArtistStorage
        ****************************************************************/

        /**
         * Méthode read() dont les implémentations doivent renvoyer 
         * l'instance de Artist ayant pour identifiant celui passé en argument, ou null si aucun Artist n'a cet identifiant
         * 
         * @param id l'identifiant de l'artite à lire
         */
        public function read($id){

            /* Préparation de la requête */
            $requete = "SELECT * FROM artists WHERE id=:id";

            /* Préparation de la requête */
            $stmt = $this->database->prepare($requete);

            /* Execution du statement */
            $stmt->execute(array(":id" => intval($id)));

            /* utilisation classique du fetch */
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($fetch){
                return new Artist($fetch['artist'], $fetch['nomDeNaissance'], $fetch['prenomDeNaissance'], $fetch['genreArtist'] ,$fetch['anneeDeNaissance'], $fetch['villeDeNaissance'], $fetch['paysDeNaissance'], $fetch['genreMusic'], $fetch['year'], $fetch['album'], $fetch['styleDeMusique'], $fetch['textFile'], $fetch['image']);
            }
            return null;
        }

        /**
        * Méthode readAll(), dont les implémentations doivent renvoyer un tableau associatif identifiant ⇒ Artist contenant touts les artistes de la « base ».
        */
        public function readAll(){
            $requete = 'SELECT * FROM artists';
            $stmt = $this->database->prepare($requete);
            $stmt->execute();
            $fetchAll = $stmt->fetchAll();
            $data = array();
            foreach($fetchAll as $key=>$value){
                $data[$value['id']] = new Artist($value['artist'], $value['nomDeNaissance'], $value['prenomDeNaissance'], $value['genreArtist'], $value['anneeDeNaissance'], $value['villeDeNaissance'], $value['paysDeNaissance'], $value['genreMusic'], $value['year'], $value['album'], $value['styleDeMusique'], $value['textFile'], $value['image']);
            }
            return $data;
        }

        /**
     * Insère un nouveau artiste dans la base. Renvoie l'identifiant
     * d'un nouveau artist'. 
     * @param artist l'artiste à insérer
     */
    public function create(Artist $artist){
        $requete = "INSERT INTO artists (artist, nomDeNaissance, prenomDeNaissance, genreArtist, anneeDeNaissance, villeDeNaissance, paysDeNaissance, genreMusic, year, album, styleDeMusique, image) VALUES (:artist, :nomDeNaissance, :prenomDeNaissance, :genreArtist, :anneeDeNaissance, :villeDeNaissance, :paysDeNaissance, :genreMusic, :year, :album, :styleDeMusique, :textFile, :image)";
        $stmt = $this->database->prepare($requete);
        $stmt->bindValue(':artist', $artist->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':nomDeNaissance', $artist->getNomDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':prenomDeNaissance', $artist->getPrenomDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':genreArtist', $artist->getGenreArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':anneeDeNaissance', $artist->getAnneeDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':villeDeNaissance', $artist->getVilleDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':paysDeNaissance', $artist->getPaysDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':genreMusic', $artist->getGenreMusic(), PDO::PARAM_STR);
        $stmt->bindValue(':year', $artist->getYear(), PDO::PARAM_STR);
        $stmt->bindValue(':album', $artist->getAlbum(), PDO::PARAM_STR);
        $stmt->bindValue(':styleDeMusique', $artist->getStyleDeMusique(), PDO::PARAM_STR);
        $stmt->bindValue(':textFile', $artist->getText(), PDO::PARAM_STR);
        $stmt->bindValue(':image', $artist->getImage(), PDO::PARAM_STR);
        $stmt->execute();
        return $this->database->lastInsertId();
    }

    /* Met à jour un artist dans la base. Renvoie
	 * true si la modification a été effectuée, false
	 * si l'identifiant ne correspond à aucun artist. */
	public function update($id, Artist $artist){
        $requete = "UPDATE artists SET artist=:artist, nomDeNaissance=:nomDeNaissance, 
                    prenomDeNaissance=:prenomDeNaissance, genreArtist=:genreArtist, 
                        anneeDeNaissance=:anneeDeNaissance, 
                            villeDeNaissance=:villeDeNaissance, 
                                paysDeNaissance=:paysDeNaissance, 
                                genreMusic=:genreMusic, year=:year, album=:album, 
                                styleDeMusique=:styleDeMusique, textFile=:textFile ,image=:image WHERE id=:id";
        $stmt = $this->database->prepare($requete);
        $stmt->bindValue(':artist', $artist->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':nomDeNaissance', $artist->getNomDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':prenomDeNaissance', $artist->getPrenomDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':genreArtist', $artist->getGenreArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':anneeDeNaissance', $artist->getAnneeDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':villeDeNaissance', $artist->getVilleDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':paysDeNaissance', $artist->getPaysDeNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':genreMusic', $artist->getGenreMusic(), PDO::PARAM_STR);
        $stmt->bindValue(':year', $artist->getYear(), PDO::PARAM_STR);
        $stmt->bindValue(':album', $artist->getAlbum(), PDO::PARAM_STR);
        $stmt->bindValue(':styleDeMusique', $artist->getStyleDeMusique(), PDO::PARAM_STR);
        $stmt->bindValue(':image', $artist->getImage(), PDO::PARAM_STR);
        $stmt->bindValue(':textFile', $artist->getText(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->execute();
    }

     /* Supprime un artist. Renvoie
	 * true si la suppression a été effectuée, false
	 * si l'identifiant ne correspond à aucune musique. */
	public function delete($id){
        $requete = "DELETE FROM artists WHERE id=:id";
        $stmt = $this->database->prepare($requete);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /* Vide la base */
    public function deleteAll(){
        $requete = "DELETE FROM artists";
        $stmt = $this->database->prepare($requete);
        $stmt->execute();
        return $this->database->lastInsertId();
    }

}



