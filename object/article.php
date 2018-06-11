<?php

class article
{
    private $titre, $coordonnees,$photo,$commentaires,$contenu, $date;
    private $bdd;

    public function __construct($id)
    {
        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
        }

        $req = $this->bdd->prepare('SELECT * FROM articles WHERE id = :id');
        $req->execute(array('id'=> $id));

        $article = $req->fetch();
        $this->titre = $article['titre'];
        $this->contenu = $article['description'];
        $this->date = $article['date'];
        $this->photo = $article['photo'];
        $this->coordonnees = $article['coordonnees'];

        $req = $this->bdd->prepare('SELECT * FROM commentaires WHERE article_id = :id');
        $req->execute(array('article_id'=> $id));

        $this->commentaires = array();
        while($commentaire = $req->fetch()){
            $this->commentaires[$commentaire['date']] = $commentaire['texte'];
        }
    }

    public function getTitre(){
        return $this->titre;
    }
    public function getCoordonnees(){
        return $this->coordonnees;
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
}