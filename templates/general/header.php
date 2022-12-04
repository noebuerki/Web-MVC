<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="PHP-MVC developed by Noé Bürki">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <title><?= $title; ?> | Web-MVC</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <button class="navbar-toggler navbar-toggler-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                aria-label="Toggle navigation">
            <img src="/images/menu-icon.png" class="navbar-toggler-icon navbar-toggler-image" alt="Menu">
        </button>
        <a href="/user">
            <img src="/images/logo.png" data-toggle="tooltip" title="Web-MVC | Home"
                 class="navbar-brand navbar-brand-icon" alt="Web-MVC Logo">
        </a>

        <?php

        use App\Authentication\Authentication;

        if (Authentication::isAuthenticated()) {
            echo '
        <div class="d-flex flex-row position-absolute navbar-icons">

                <a href="/user/profile" class="mx-3">
                    <img src="/images/avatar.svg" data-toggle="tooltip" title="My profile" width="32" alt="Profile icon">
                </a>

                <a href="/user/doLogout">
                    <img src="/images/exit.svg" id="logoutBtn" data-toggle="tooltip" title="Logout" width="32" alt="Logout icon">
                </a>
        </div>
        ';
        }
        ?>

        <div class="collapse navbar-collapse navbar-item-div" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <?php

                if (Authentication::isAuthenticated()) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">Title</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Subtitle</a></li>
                        </ul>
                    </li>
                ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/user/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/register">Register</a>
                    </li>
                    ';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/default/about">About</a>
                </li>
                <?php
                if (Authentication::isAdmin()) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin-Panel</a>
                    </li>
                        ';
                }
                ?>
            </ul>
        </div>

    </nav>
</header>

<main class="container text-center">
    <h1><?= $heading; ?></h1>
