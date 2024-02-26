<?php
// Trucs obligatoire pour l'envoie de mail à mettre en haut de page
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

require_once('inc/db.php');
include 'smarty.php';

if(isset($_POST['submit']))
{
    // Je vérifie si les champs ont des valeurs
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {

        //On vérifie si l'email est déjà utilisée
        $vrf = $dbh->prepare('SELECT * FROM utilisateurs WHERE email = :email LIMIT 1');
        $vrf->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $vrf->execute();

    // Je vérifie avec RowCount si je n'ai pas de résultat
    if($vrf->rowCount()==0)
    {
        echo 'Vous pouvez prendre cette adresse email';
    }
    else{
        echo 'C\'est mort, mail déjà pris !';
        return false;
    };
    // La on dit de mettre dans la bdd ce que l'utilisateur nous transmet
        $password = $dbh->quote(password_hash($_POST['password'],PASSWORD_DEFAULT));

        $sql = "INSERT INTO utilisateurs SET
                                email = :email,
                                password = :password";

        // Je prépare ma requête
        $req = $dbh->prepare($sql);
        $req->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
        $req->bindParam(':password',$password,PDO::PARAM_STR);

        // J'execute ma requête avec execute()
        if ( $req->execute() ) {
            echo 'On est good';
            require 'vendor/autoload.php';

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                $mail->isSMTP(true);                                           
                $mail->Host       = 'dwwm2324.fr';                  
                $mail->SMTPAuth   = true;                                
                $mail->Username   = 'contact@dwwm2324.fr';                   
                $mail->Password   = 'm%]E5p2%o]yc';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
                $mail->Port       = 465;                              
            
                //Recipients
                $mail->setFrom('Bienvenue@hotmail.fr', 'yes');
                $mail->addAddress($_POST['email']);    
            
                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = 'Salut';
                $mail->Body = 'ACCEPTE CE MAIL';
                $mail->AltBody = 'ACCEPTE CE MAIL';
            
                $mail->send();
                echo 'Message envoyé !';
            } catch (Exception $e) {
                echo "Message non envoyé";
            };
        } else {
            echo 'c\'est DEAD';
        }
    }
};

$file = file_get_contents('template/register.tpl');
echo $file;
?>