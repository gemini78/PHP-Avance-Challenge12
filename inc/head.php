<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FBI | X-Files archives</title>

    <link rel="stylesheet" href="assets/bootstrap.css" />

    <link rel="stylesheet" href="assets/custom.css" />
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <ul class="container-anchor">
                    <li class="<?= (isset($page) && $page === 'home') ? "active" : "" ?>">
                        <a href="index.php">
                            <h1><strong>FBI:</strong> X-files archives</h1>
                        </a>
                    </li>
                    <li class="<?= (isset($page) && $page === 'about') ? "active" : "" ?>">
                        <a href="about.php">
                            <h1><strong>About</strong></h1>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">