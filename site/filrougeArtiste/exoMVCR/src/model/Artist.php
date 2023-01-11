<?php

/**
 * Définition de la classe Artist pour la description de l'artiste
 * 
 * @author OROU-GUIDOU Amirath Fara, 22012235
 * 
 * @institute Université de Caen Normandie
 */

class Artist{

    /* Attribut de la classe */
    protected $artist;
    protected $nomDeNaissance;
    protected $prenomDeNaissance;
    protected $genreArtist;
    protected $anneeDeNaissance;
    protected $villeDeNaissance;
    protected $paysDeNaissance;
    protected $genreMusic;
    protected $year;
    protected $album;
    protected $styleDeMusique;
    protected $image;

    protected $text;
    protected $creationDate;
    protected $modifDate;

    /** Constructeur de la classe 
     * @param artist l'artiste
     * @param nomDeNaissance le nom de naissance de l'artiste
     * @param prenomDeNaissance prénom de naissance de l'artiste
     * @param genreArtist le genre de l'artiste
     * @param anneeDeNaissance de naissance année de naissance de l'artiste
     * @param villeDeNaissance ville de naissance de l'artiste
     * @param pays pays de naissance de l'artiste
     * @param genreMusic genre de musique que joue l'artiste
     * @param year l'annee de debut de carrière
     * @param album l'album sortir
     * @param styleDeMusique le style de musique
     * @param image l'image de l'artiste
     * @param creationDate date de creation initialiser à null 
     * @param modifDate date de modification initialiser à null
     * 
     */
    public function __construct($artist, $nomDeNaissance, $prenomDeNaissance, $genreArtist, $anneeDeNaissance, $villeDeNaissance, $paysDeNaissance, $genreMusic, $year, $album, $styleDeMusique, $textFile, $image, $creationDate=null, $modifDate=null){
        $this->artist = $artist;
        $this->nomDeNaissance = $nomDeNaissance;
        $this->prenomDeNaissance = $prenomDeNaissance;
        $this->genreArtist = $genreArtist;
        $this->anneeDeNaissance = $anneeDeNaissance;
        $this->villeDeNaissance = $villeDeNaissance;
        $this->paysDeNaissance = $paysDeNaissance;
        $this->genreMusic = $genreMusic;
        $this->year = $year;
        $this->album = $album;
        $this->styleDeMusique = $styleDeMusique;
        $this->image = $image;
        $this->text = file_get_contents("text/{$textFile}.frg.html", true);
        $this->creationDate = $creationDate !== null? $creationDate: new DateTime();
		$this->modifDate = $modifDate !== null? $modifDate: new DateTime();

    }

    /************************************************************************************
     * @GETTER
     ************************************************************************************/
    /**
     * Definition de la function getArtist()
     * @return artist le nom de l'artist
     */
    public function getArtist(){
        return $this->artist;
    }

    /**
     * Definition de la function getNomDeNaissance()
     * @return nomDeNaissance le nom de naissance de l'artiste
     */
    public function getNomDeNaissance(){
        return $this->nomDeNaissance;
    }

    /**
     * Definition de la function getPrenomDeNaissance()
     * @return prenomDeNaissance le prenom de naissance de l'artiste
     */
    public function getPrenomDeNaissance(){
        return $this->prenomDeNaissance;
    }

    /**
     * Definition de la function getGenreArtist()
     * @return genreArtist le genre de l'artiste
     */
    public function getGenreArtist(){
        return $this->genreArtist;
    }

    /**
     * Definition de la function getAnneeDeNaissance()
     * @return anneeDeNaissance l'année de naissance de l'artiste
     */
    public function getAnneeDeNaissance(){
        return $this->anneeDeNaissance;
    }

    /**
     * Definition de la function getVilleDeNaissance()
     * @return villeDeNaissance la ville de naissance de l'artiste
     */
    public function getVilleDeNaissance(){
        return $this->villeDeNaissance;
    }

    /**
     * Definition de la function getPaysDeNaissance()
     * @return paysDeNaissance le pays de naissance de l'artiste
     */
    public function getPaysDeNaissance(){
        return $this->paysDeNaissance;
    }

    /**
     * Definition de la function getGenreMusic()
     * @return genreMusic le genre de musique que joue l'artiste
     */
    public function getGenreMusic(){
        return $this->genreMusic;
    }

    /**
     * Definition de la function getYear()
     * @return year année de début de carrière
     */
    public function getYear(){
        return $this->year;
    }

    /**
     * Definition de la function getAlbum()
     * @return album l'album sorti
     */
    public function getAlbum(){
        return $this->album;
    }

    /**
     * Definition de la function getStyleDeMusique()
     * @return styleDeMusique le style de musique
     */
    public function getStyleDeMusique(){
        return $this->styleDeMusique;
    }

    /**
     * Definition de la function getText()
     * @return text le texte de l'artiste
     */
    public function getText(){
        return $this->text;
    }

    /**
     * Definition de la function getImage()
     * @return image l'image de l'artiste
     */
    public function getImage(){
        return $this->image;
    }

    
    public function getCreationDate(){
        return $this->creationDate;
    }

    
    public function getModificationDate(){
        return $this->modifDate;
    }

    /*********************************************************************************************************************
     * @SETTER
    *********************************************************************************************************************/

    /**
      * Définition de la function setArtist()
      * @param  artist
    */
    public function setArtist($artist){
        $this->artist = $artist;
    }

    /**
      * Définition de la function setNomDeNaissance()
      * @param nomDeNaissance
    */
    public function setNomDeNaissance($nomDeNaissance){
        $this->nomDeNaissance = $nomDeNaissance;
    }

    /**
      * Définition de la function setPrenomDeNaissance()
      * @param prenomDeNaissance
    */
    public function setPrenomDeNaissance($prenomDeNaissance){
        $this->prenomDeNaissance = $prenomDeNaissance;
    }

    /**
      * Définition de la function setGenreArtist()
      * @param genreArtist
    */
    public function setGenreArtist($genreArtist){
        $this->genreArtist = $genreArtist;
    }

    /**
      * Définition de la function setAnneeDeNaissance()
      * @param anneeDeNaissance
    */
    public function setAnneeDeNaissance($anneeDeNaissance){
        $this->anneeDeNaissance = $anneeDeNaissance;
    }

    /**
      * Définition de la function setVilleDeNaissance()
      * @param villeDeNaissance
    */
    public function setVilleDeNaissance($villeDeNaissance){
        $this->villeDeNaissance = $villeDeNaissance;
    }

    /**
      * Définition de la function setPaysDeNaissance()
      * @param paysDeNaissance
    */
    public function setPaysDeNaissance($paysDeNaissance){
        $this->paysDeNaissance = $paysDeNaissance;
    }

    /**
      * Définition de la function setGenreMusic()
      * @param genreMusic
    */
    public function setGenreMusic($genreMusic) {
        $this->genreMusic = $genreMusic;
    }

    /**
      * Définition de la function setYear()
      * @param year
    */
    public function setYear($year){
        $this->year = $year;
    }

    /**
      * Définition de la function setAlbum()
      * @param album
    */
    public function setAlbum($album){
        $this->album = $album;
    }

    /**
      * Définition de la function setStyleDeMusique()
      * @param styleDeMusique
    */
    public function setStyleDeMusique($styleDeMusique){
        $this->styleDeMusique = $styleDeMusique;
    }

    /**
      * Définition de la function setText()
      * @param text
    */
    public function setText($text){
        $this->text = $text;
    }

    /**
      * Définition de la function setImage()
      * @param image
    */
    public function setImage($image){
        $this->image = $image;
    }

    /**
      * Définition de la function setCreationDate()
      * @param creationDate
    */
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
    }

    /**
      * Définition de la function setModificationDate()
      * @param modifDate
    */
    public function setModificationDate($modifDate){
        $this->modifDate = $modifDate;
    }
}

