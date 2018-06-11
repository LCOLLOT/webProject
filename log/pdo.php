<?php
    $nomBdd='';
    try{
        $bdd = new PDO('mysql:host=localhost;dbname='.$nomBdd.';charset=utf8', 'root', '');
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
    }
?>
