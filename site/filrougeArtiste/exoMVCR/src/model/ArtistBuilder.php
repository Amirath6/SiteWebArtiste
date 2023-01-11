<?php
    /**
     * Définition de la classe ArtistBuider qui représente une classe pour la manipulation des artistes via des formulaires 
     * 
     * @author OROU-GUIDOU Amirath Fara, 22012235
     * 
     * @institute Université de Caen Normandie 
     * 
     */
    require_once("src/model/Artist.php");


    class ArtistBuilder{

        /* Attibuts de la classe */

        const ARTIST_REF = "artist";
        const NOM_REF = "nomDeNaissance";
        const PRENOM_REF = "prenomDeNaissance";
        const GENRE_ARTIST_REF = "genreArtist";
        const ANNEE_REF = "anneeDeNaissance";
        const VILLE_REF = "villeDeNaissance";
        const PAYS_REF = "paysDeNaissance";
        const GENRE_REF = "genreMusic";
        const YEAR_REF = "year";
        const ALBUM_REF = "album";
        const STYLE_REF = "styleDeMusique";
        const TEXT_REF = "textFile";
        const IMAGE_REF = "image";
        
        private $data;

        private $error;

        



        /**
         * Constructeur de la classe
         * @param data la donnée
         * @param error l'erreur
         */
        public function __construct($data=null){
            if($data === null){
                $data = array(
                    self::ARTIST_REF => "",
                    self::NOM_REF => "",
                    self::PRENOM_REF => "",
                    self::GENRE_ARTIST_REF => "",
                    self::ANNEE_REF => "",
                    self::VILLE_REF => "",
                    self::PAYS_REF => "",
                    self::GENRE_REF => "",
                    self::YEAR_REF => "",
                    self::ALBUM_REF => "",
                    self::STYLE_REF => "",
                    self::TEXT_REF => "",
                    self::IMAGE_REF => ""
                );
            }
            $this->data = $data;
            $this->error = array();
        }

        /* Renvoie une nouvelle instance de ArtistBuilder avec les données
 	    * modifiables de l'artist passé en argument. */
	    public static function buildFromArtist(Artist $artist) {
            return new ArtistBuilder(array(
                "artist" => $artist->getArtist(),
                "nomDeNaissance" => $artist->getNomDeNaissance(),
                "prenomDeNaissance" => $artist->getPrenomDeNaissance(),
                "genreArtist" => $artist->getGenreArtist(),
                "anneeDeNaissance" => $artist->getAnneeDeNaissance(),
                "villeDeNaissance" => $artist->getVilleDeNaissance(),
                "paysDeNaissance" => $artist->getPaysDeNaissance(),
                "genreMusic" => $artist->getGenreMusic(),
                "year" => $artist->getYear(),
                "album" => $artist->getAlbum(),
                "styleDeMusique" => $artist->getStyleDeMusique(),
                "textFile" => $artist->getText(),
                "image" => $artist->getImage(),
            ));
	    }

        /****************************************************************
         * Accesseur de la classe @GETTER
        *****************************************************************/

        /**
         * Méthode getData() qui renvoie la valeur d'un champ en fonction de la référence passée en argument.
         * @param ref la référence
         */
        public function getData($ref){
            return key_exists($ref, $this->data)? $this->data[$ref]: '';
        }

        public function setData($ref, $str){
            $this->data[$ref] = $str;
        }

        /**
        * Méthode getError() qui renvoie les erreurs associées au champ de la référence passée en argument,
 	    * ou null s'il n'y a pas d'erreur.
 	    * Nécessite d'avoir appelé isValid() auparavant.
        * @param ref la référence
        */
        public function getErrors($ref){
            return key_exists($ref, $this->error)? $this->error[$ref]: null;
        }

        /**
         * Définition d'une méthode createArtist() qui crée une nouvelle instance d'Artist en utilisant l'attribut data
         */
        public function createArtist(){
            if(!key_exists(self::ARTIST_REF, $this->data) || !key_exists(self::NOM_REF, $this->data) || !key_exists(self::PRENOM_REF, $this->data) || !key_exists(self::GENRE_ARTIST_REF, $this->data) || !key_exists(self::ANNEE_REF, $this->data) || !key_exists(self::VILLE_REF, $this->data) || !key_exists(self::PAYS_REF, $this->data) || !key_exists(self::GENRE_REF, $this->data) || !key_exists(self::YEAR_REF, $this->data) || !key_exists(self::ALBUM_REF, $this->data) || !key_exists(self::STYLE_REF, $this->data) || !key_exists(self::TEXT_REF, $this->data) ||!key_exists(self::IMAGE_REF, $this->data)){
                throw new Exception("Missing fields for Artist creation");
            }
            return new Artist($this->data[self::ARTIST_REF], $this->data[self::NOM_REF], $this->data[self::PRENOM_REF], $this->data[self::GENRE_ARTIST_REF] ,$this->data[self::ANNEE_REF], $this->data[self::VILLE_REF], $this->data[self::PAYS_REF],$this->data[self::GENRE_REF], $this->data[self::YEAR_REF], $this->data[self::ALBUM_REF], $this->data[self::STYLE_REF], $this->data[self::TEXT_REF],$this->data[self::IMAGE_REF]);
        }

        /**
         * Définition d'une méthode isValid() qui vérifie que les données de son attribut $data sont correctes
         */
        public function isValid(){
            $this->error = array();

            if(!key_exists(self::ARTIST_REF, $this->data) || $this->data[self::ARTIST_REF] === ''){
                $this->error[self::ARTIST_REF] = "Le nom de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::ARTIST_REF]) >= 50){
                $this->error[self::ARTIST_REF] = "Le nom de l'artiste doit comporter au moins 50 caractères";
            }

            if(!key_exists(self::NOM_REF, $this->data) || $this->data[self::NOM_REF] === ''){
                $this->error[self::NOM_REF] = "Le nom de naissance de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::NOM_REF]) >= 50){
                $this->error[self::NOM_REF] = "Le nom de naissance de l'artiste doit comporter au moins 50 caractères";
            }

            if(!key_exists(self::PRENOM_REF, $this->data) || $this->data[self::PRENOM_REF] === ''){
                $this->error[self::PRENOM_REF] = "Le prénom de naissance de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::PRENOM_REF]) >= 50){
                $this->error[self::PRENOM_REF] = "Le prénom de naissance de l'artiste doit comporter au moins 50 caractères";
            }

            if(!key_exists(self::GENRE_ARTIST_REF, $this->data) || $this->data[self::GENRE_ARTIST_REF] === ''){
                $this->error[self::GENRE_ARTIST_REF] = "Le genre de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::GENRE_ARTIST_REF]) >= 50){
                $this->error[self::GENRE_ARTIST_REF] = "Le genre de l'artiste doit comporter au moins 50 caractères";
            }

            if(!key_exists(self::ANNEE_REF, $this->data) || $this->data[self::ANNEE_REF] === ''){
                $this->error[self::ANNEE_REF] = "L'année de naissance de l'artiste est obligatoire";
            }
            else if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->data[self::ANNEE_REF])){
                $this->error[self::ANNEE_REF] = "L'année de naissance de l'artiste doit être au format AAAA-MM-JJ";
            }

            if(!key_exists(self::VILLE_REF, $this->data) || $this->data[self::VILLE_REF] === ''){
                $this->error[self::VILLE_REF] = "La ville de naissance de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::VILLE_REF]) >= 30){
                $this->error[self::VILLE_REF] = "La ville de naissance de l'artiste doit comporter au moins 30 caractères";
            }

            if(!key_exists(self::PAYS_REF, $this->data) || $this->data[self::PAYS_REF] === ''){
                $this->error[self::PAYS_REF] = "Le pays de naissance de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::PAYS_REF]) >= 30){
                $this->error[self::PAYS_REF] = "Le pays de naissance de l'artiste doit comporter au moins 30 caractères";
            }

            if(!key_exists(self::GENRE_REF, $this->data) || $this->data[self::GENRE_REF] === ''){
                $this->error[self::GENRE_REF] = "Le genre de musique de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::GENRE_REF]) >= 30){
                $this->error[self::GENRE_REF] = "Le genre de l'artiste doit comporter au moins 30 caractères";
            }

            if(!key_exists(self::YEAR_REF, $this->data) || $this->data[self::YEAR_REF] === ''){
                $this->error[self::YEAR_REF] = "L'année de début de carrière de l'artiste est obligatoire";
            }
            else if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->data[self::YEAR_REF])){
                $this->error[self::YEAR_REF] = "L'année de début de carrière de l'artiste doit être au format AAAA-MM-JJ";
            }

            if(!key_exists(self::ALBUM_REF, $this->data) || $this->data[self::ALBUM_REF] === ''){
                $this->error[self::ALBUM_REF] = "Le nom de l'album de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::ALBUM_REF]) >= 30){
                $this->error[self::ALBUM_REF] = "Le nom de l'album de l'artiste doit comporter au moins 30 caractères";
            }

            if(!key_exists(self::STYLE_REF, $this->data) || $this->data[self::STYLE_REF] === ''){
                $this->error[self::STYLE_REF] = "Le style de musique de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::STYLE_REF]) >= 40){
                $this->error[self::STYLE_REF] = "Le style de musique de l'artiste doit comporter au moins 40 caractères";
            }

            if(!key_exists(self::TEXT_REF, $this->data) || $this->data[self::TEXT_REF] === ''){
                $this->error[self::TEXT_REF] = "Le texte de l'album de l'artiste est obligatoire";
            }
            else if(mb_strlen($this->data[self::TEXT_REF]) >= 1000){
                $this->error[self::TEXT_REF] = "Le texte de l'album de l'artiste doit comporter au moins 1000 caractères";
            }

            if(!key_exists(self::IMAGE_REF, $this->data) || $this->data[self::IMAGE_REF] === ''){
                $this->error[self::IMAGE_REF] = "L'image de l'artiste est obligatoire";
            }
            else if(!preg_match("/^.*\.(jpg|png|jpeg)$/",$this->data[self::IMAGE_REF])){
                $this->error[self::IMAGE_REF] = "L'image doit être au format jpg, png ou jpeg";
            }
            var_dump($this->error);
            
            return count($this->error) === 0; 
        }

        /* Renvoie la référence de champs du nom de l'artiste */
        public function getArtistRef(){
            return self::ARTIST_REF;
        }

        /* Renvoie la référence de champs du nom de naissance de l'artiste */
        public function getNomDeNaissanceRef(){
            return self::NOM_REF;
        }

        /* Renvoie la référence de champs du prénom de naissance de l'artiste */
        public function getPrenomDeNaissanceRef(){
            return self::PRENOM_REF;
        }

        /* Renvoie la référence de champs du genre de l'artiste */
        public function getGenreArtistRef(){
            return self::GENRE_ARTIST_REF;
        }

        /* Renvoie la référence de champs de l'année de naissance de l'artiste */
        public function getAnneeDeNaissanceRef(){
            return self::ANNEE_REF;
        }

        /* Renvoie la référence de champs de la ville de naissance de l'artiste */
        public function getVilleDeNaissanceRef(){
            return self::VILLE_REF;
        }

        /* Renvoie la référence de champs du pays de naissance de l'artiste */
        public function getPaysDeNaissanceRef(){
            return self::PAYS_REF;
        }

        /* Renvoie la référence de champs du genre de musique de l'artiste */
        public function getGenreMusicRef(){
            return self::GENRE_REF;
        }

        /* Renvoie la référence de champs de l'année de début de carrière de l'artiste */
        public function getYearRef(){
            return self::YEAR_REF;
        }

        /* Renvoie la référence de champs du nom de l'album de l'artiste */
        public function getAlbumRef(){
            return self::ALBUM_REF;
        }

        /* Renvoie la référence de champs du style de musique de l'artiste */
        public function getStyleDeMusiqueRef(){
            return self::STYLE_REF;
        }

        /* Renvoie la référence de champs de l'image de l'artiste */
        public function getImageRef(){
            return self::IMAGE_REF;
        }
        
        /* Met à jour une instance d'Artist avec les données
	    * fournies. */
	    public function updateArtist(Artist $a) {
        
            if (key_exists(self::ARTIST_REF, $this->data))
                $a->setArtist($this->data[self::ARTIST_REF]);

            if (key_exists(self::NOM_REF, $this->data))
                $a->setNomDeNaissance($this->data[self::NOM_REF]);
            
            if (key_exists(self::PRENOM_REF, $this->data))
                $a->setPrenomDeNaissance($this->data[self::PRENOM_REF]);

            if (key_exists(self::GENRE_ARTIST_REF, $this->data))
                $a->setGenreArtist($this->data[self::GENRE_ARTIST_REF]);
            
            if (key_exists(self::ANNEE_REF, $this->data))
                $a->setAnneeDeNaissance($this->data[self::ANNEE_REF]);

            if (key_exists(self::VILLE_REF, $this->data))
                $a->setVilleDeNaissance($this->data[self::VILLE_REF]);

            if (key_exists(self::PAYS_REF, $this->data))
                $a->setPaysDeNaissance($this->data[self::PAYS_REF]);

            if (key_exists(self::GENRE_REF, $this->data))
                $a->setGenreMusic($this->data[self::GENRE_REF]);

            if (key_exists(self::YEAR_REF, $this->data))
                $a->setYear($this->data[self::YEAR_REF]);

            if (key_exists(self::ALBUM_REF, $this->data))
                $a->setAlbum($this->data[self::ALBUM_REF]);

            if (key_exists(self::STYLE_REF, $this->data))
                $a->setStyleDeMusique($this->data[self::STYLE_REF]);

            if (key_exists(self::TEXT_REF, $this->data))
                $a->setText($this->data[self::TEXT_REF]);
                
            if (key_exists(self::IMAGE_REF, $this->data))
                $a->setImage($this->data[self::IMAGE_REF]);
        }
}


