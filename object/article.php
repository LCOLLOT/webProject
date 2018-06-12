<?php

class article
{
    private $titre, $lattitude,$longitude,$photo,$commentaires,$contenu, $date, $id;
    private $bdd;

    public function __construct($id)
    {
        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
        }

        $req = $this->bdd->prepare('SELECT * FROM articles WHERE id = :id');
        $req->execute(array('id'=> $id));

        $article = $req->fetch();
        $this->titre = $article['titre'];
        $this->contenu = $article['description'];
        $this->date = $article['dateA'];
        $this->photo = $article['photo'];
        $this->lattitude = $article['lattitude'];
        $this->longitude = $article['longitude'];
        $this->id = $id;
        $this->like = $article['jaime'];

        $req = $this->bdd->prepare('SELECT * FROM commentaires WHERE article_id = :id');
        $req->execute(array('id'=> $id));

        $this->commentaires = array();
        while($commentaire = $req->fetch()){
            $this->commentaires[] = $commentaire['date']." : ".$commentaire['texte'];
        }
    }

    public function getTitre(){
        return $this->titre;
    }
    public function getLattitude(){
        return $this->lattitude;
    }
    public function getLongitude(){
        return $this->longitude;
    }
    public function  getPhoto(){
        return $this->photo;
    }
    public function getCommentaires(){
        return $this->commentaires;
    }
    public function getContenu(){
        return $this->contenu;
    }
    public function getDate(){
        return $this->date;
    }
    public function getLike() {
        return $this->like;
    }
    public function getId(){
        return $this->id;
    }
    public function getUniqueCommentaire(){
        return $this->commentaires[sizeof($this->commentaires)-1];
    }
}