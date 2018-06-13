<?php

class Profil
{
    private $nom,$pseudo,$mail,$date,$password,$photo,$groupe,$badge;
    private $bdd;

    public function __construct($id)
    {
        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
        }

        $req = $this->bdd->prepare('SELECT * FROM users WHERE id =:id');
        $req->execute(array('id'=> $id));

        $profil = $req->fetch();
        $this->nom = $profil['name'];
        $this->pseudo = $profil['pseudo'];
        $this->mail = $profil['mail'];
        $this->date = $profil['date'];
        $this->password = $profil['password'];
        $this->photo = $profil['photo'];
        $this->groupe = $profil['groupe'];
        $this->badge = $profil['badge'];
    }

    public function getName(){
        return $this->nom;
    }
    public function getPseudo(){
        return $this->pseudo;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getDate(){
        return $this->date;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getPhoto(){
        return $this->photo;
    }
    public function getGroupe(){
        return $this->groupe;
    }
    public function getBadge(){
        return $this->badge;
    }


}