<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo htmlspecialchars( $description, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars( $keywords, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    <meta name="author" content="<?php echo htmlspecialchars( $author, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars( $title, ENT_COMPAT, 'UTF-8', FALSE ); ?></title>

    <link href="/res/css/bootstrap.min.css" rel="stylesheet">
    <link href="/res/css/global.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="/res/javascript/jquery.min.js"></script>

</head>

<body>

    <nav class="container-fluid nav-area">
        <a href="/">
            <span class="material-icons md-3">aspect_ratio</span>
        </a>
        <h1 class="text-center"><?php echo htmlspecialchars( $title, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
    </nav>