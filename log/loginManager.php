<?php
/**
 * Created by PhpStorm.
 * User: penichotlucas
 * Date: 11/06/2018
 * Time: 11:01
 */
include ('pdo.php');
class loginManager
{
    private $login, $mdp;

    public function __construct()
    {
    }

    public function getUser($login, $mdp){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
        }

        if(is_string($login) && !empty($login)){
            $this->login = $login;
        }
        if(is_string($mdp) && !empty($mdp)){
            $this->mdp = $mdp;
        }

        $req = $bdd->prepare('SELECT * FROM users WHERE mail =:mail');
        $req->execute(array('mail'=> $this->login));

        $user = $req->fetch();
        if( $user['password'] == $this->mdp){
            return $user['name'];
        }
        else{
            return 'badLog';
        }
    }
}