<?php
require_once('inc/db.php');
include 'smarty.php';
require_once('inc/functions.php');

session_start();

$autorize = ['.png','.PNG','.jpg','.JPG','.pdf','.PDF','.webp','.WEBP','.jpeg','.JPEG'];
if(isset($_POST['submit']))
{
    // Pour savoir si un fichier a été envoyé on utilise la fonction is_uploaded_files
    if(is_uploaded_file($_FILES['files']['tmp_name']))
    {
        // Je récupère l'extension du files envoyé
        $extension = strrchr($_FILES['files']['name'],'.');
        // Je vérifie si l'extension se trouve dans mon tableau
        if(in_array($extension,$autorize))
        {
            // On va renommer notre files
            $autre_nom = time().$_FILES['files']['name'];
            // Je vais deplacer le files vers le repertoire final
            move_uploaded_file($_FILES['files']['tmp_name'],$autre_nom);
            echo 'files OK';
        }
        // Si l'extension n'est pas dans autorize
        else {
            echo 'files NOT OK';
        }
    }
}
$upload = uploadFiles();
$fichier = file_get_contents('template/upload.tpl');
echo $fichier;
?>