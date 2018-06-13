<?php
    session_start();
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
    }

?>
