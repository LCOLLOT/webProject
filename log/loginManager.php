<?php
/**
 * Created by PhpStorm.
 * User: penichotlucas
 * Date: 11/06/2018
 * Time: 11:01
 */

class loginManager
{
    private $login, $mdp;

    private function __construct()
    {
        include ('pdo.php');
    }

    private function getUser($login, $mdp){

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