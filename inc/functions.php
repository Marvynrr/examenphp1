<?php
// Vos fonctions (token, traitement des fichiers etc...)

function setToken()
{
    if($_COOKIE['token'] != 1){
        $caracteres = 'azertyuiopqsdfghjklmwxcvbn1234567890AZERTYUIOPQSDFGHJKLMWXCVBN';
        $motdepasse = '';
        for($i=0;$i<25;$i++)
        {
            $motdepasse.= $caracteres[rand(0,strlen($caracteres)-1)]; 
        }
        $_SESSION['token'] = $motdepasse;
        setcookie('token',1,(time()+60));
        return $motdepasse;
    }
    else{
        return $_SESSION['token'];
    }  
}
 function getToken(){
     if($_GET['token'] == $_SESSION['token'])
         return true;
    else
        return false;
}

function uploadFiles($file = null){

    // Si je n'ai pas de fichiers
    if($file == null || !$file || !is_array($file)) return false;
    
    // Je parcours l'ensemble des fichiers de $_FILES
    $bool = [];
    for($i=0 ; $i < count($file) ; $i++){
        if(move_uploaded_file($file['tmp_name'][$i], $file['name'][$i])){
            $bool[$i] = true;
        }
        else{
            $bool[$i] = false;
        }
    }
    return $bool;
}
?>