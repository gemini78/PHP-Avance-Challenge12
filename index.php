<?php
session_start();
function createSpace(int $nb, string $char = '-'): string
{
    $str = "";
    $i = 0;
    while ($i < ($nb * 2)) {
        $str .= $char;
        $i++;
    }
    return $str;
}

function is_dir_empty($dir)
{
    if (!is_readable($dir)) {
        return null;
    }
    return (count(scandir($dir)) == 2);
}

function managerFile(string $file, int $nbEspace = 0)
{
    if (!is_dir_empty($file)) {
        chdir($file);
        $id = opendir(".");
        while ($str = readdir($id)) {
            if ($str != "." && $str != "..") {
                if (filetype($str) === "dir") {
                    echo createSpace($nbEspace) . $str . ' <a href="?action=del_dir">Supprimer</a>';
                    echo '<br/>';
                    $newPath = $file . DIRECTORY_SEPARATOR . $str;
                    echo "Fichier: " . $newPath . " Nombre d'espaces =" . ($nbEspace + 1);
                    ++$nbEspace;
                } else if (filetype($str) === "file") {
                    echo createSpace($nbEspace) . $str . ' <a href="?action=del_file">Supprimer</a>';
                }
                echo '<br/>';
            }
        }
        closedir($id);
        return;
    }
}


function explorer($path, int $nbEspace = 0)
{
    $realPath = trim($path);
    $nbEspaceDir = $nbEspace;
    $nbEspaceFile = $nbEspace;
    if (is_dir($path)) {
        echo createSpace($nbEspace) . $path . '&nbsp' . '<a class="del" href="delete.php?action=del_dir&path=' . $realPath . '">supprimer</a><br/>';
        $id = opendir($path);
        while ($child = readdir($id)) {
            if ($child != '.' && $child != '..') {
                explorer($path . DIRECTORY_SEPARATOR . $child, ++$nbEspaceDir);
            }
        }
    } else if (is_file($path)) {
        echo createSpace($nbEspaceFile) . $path . '&nbsp' . '<a class="del" href="delete.php?action=del_file&path=' . $realPath . '">supprimer</a>' . '&nbsp' . '<a class="edit" href="edit.php?action=edit&path=' . $realPath . '">éditer</a><br/>';
    }
}

$page = 'home';
include('inc/head.php');
?>
<?php if(isset($_SESSION['notification']['message'])): ?>
    <div class="alert alert-<?= $_SESSION['notification']['type'] ?>">
        <div class="wrapper">
            <h4><?= $_SESSION['notification']['message']  ?></h4>
        </div>
    </div>
    <?php $_SESSION['notification'] = [];?>
<?php endif; ?>
<div class="content panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-uppercase">UFO's Activities report</h3>
    </div>
    <div class="panel-body">
        <?php
        explorer('files');
        ?>
    </div>
    <div class="panel-footer text-right">
        <em>Classified documents</em>
    </div>
</div>
<?php include('inc/foot.php') ?>