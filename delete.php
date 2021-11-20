<?php
session_start();
/**
 * Remove directory
 *
 * @param [type] $dir
 * @return void
 */
 function removeDirectory(string $dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir);
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
           removeDirectory($dir. DIRECTORY_SEPARATOR .$object);
         else
           unlink($dir. DIRECTORY_SEPARATOR .$object); 
       } 
     }
     rmdir($dir); 
   } 
 }

function removeFile(string $path)
{
   if (file_exists($path)) {
   unlink($path);
}
}

if (!empty($_GET['action']) && !empty($_GET['path'])) {

    if ($_GET['action'] == 'del_dir') {
        removeDirectory($_GET['path']);
        $_SESSION['notification']['type'] = "success";
        $_SESSION['notification']['message'] = "Le dossier a été supprimé avec succès";
    }
    if ($_GET['action'] == 'del_file') {
        removeFile($_GET['path']);
        $_SESSION['notification']['type'] = "info";
        $_SESSION['notification']['message'] = "Le fichier a été supprimé avec succès";
    }
    header('Location: index.php');
    exit;
}
