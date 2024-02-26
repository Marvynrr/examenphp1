<?php
// Page inaccessible si la personne est connecté

// Je vais inclure le fichier db.php pour la connexion
session_start();
require_once('inc/db.php');
include 'smarty.php';

require_once('inc/functions.php');


// Je vais vérifier si mon formulaire a été soumis
if(isset($_POST['submit']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $sql = $dbh->prepare('SELECT * FROM utilisateurs WHERE email = :email LIMIT 1');
        $sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $sql->execute();
        // Je vérifie avec RowCount si je n'ai pas de résultat
        if($sql->rowCount() == 0)
        {
            echo 'adresse email introuvable';
        }
        // Je retourne la ligne de ma requête sous un tableau associatif
        $resultat = $sql->fetch(PDO::FETCH_ASSOC);
        // Jé vérifie si le mot de passe est OK
        if(password_verify($_POST['password'], $resultat['password']))
        {
            echo "Tu es connecté";
        $_SESSION['letsgo'] = $_POST['valeur'];

        // Pour faire ton cookie
        if(isset($_POST['submit'])){
            // On vérifie avec !empty si la variable $_POST['valeur'] est rempli
            if(!empty($_POST['valeur'])){
                // Je crée un cookie pour te montrer que je sais en faire !
                setcookie('toncookie',$_POST['valeur'],(time()+3600));
            }        
        }
        // Je redirige l'utilisateur vers affichesession.php
        header('location:index.php');

        
        }
        else
        {
            echo 'le mot de passe ne correspond pas';
        }

    }
}



$fichier = file_get_contents('template/login.tpl');
echo $fichier;
?>